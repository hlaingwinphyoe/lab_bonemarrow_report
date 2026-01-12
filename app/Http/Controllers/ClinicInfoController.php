<?php

namespace App\Http\Controllers;

use App\Models\ClinicInfo;
use App\Models\ClinicPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClinicInfoController extends Controller
{
    public function index()
    {
        $clinicInfo = ClinicInfo::with('clinic_phones')->first();

        return view('clinic-infos.index', [
            'clinicInfo' => $clinicInfo,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phones' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->name,
                'address' => $request->address,
            ];

            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('logos', 'public');
                $data['logo'] = $logoPath;
            }

            $clinicInfo = ClinicInfo::create($data);

            // Handle phones
            if ($request->phones) {
                $phones = json_decode($request->phones, true) ?? [];
                foreach ($phones as $phone) {
                    if (!empty($phone['phone'])) {
                        ClinicPhone::create([
                            'clinic_info_id' => $clinicInfo->id,
                            'phone' => $phone['phone'],
                            'type' => $phone['type'] ?? 'mobile',
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('clinic-infos.index')
                ->with('success', 'Clinic information created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to create clinic information: ' . $e->getMessage()]);
        }
    }

    public function update(Request $request, ClinicInfo $clinicInfo)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'phones' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->name,
                'address' => $request->address,
            ];

            // Handle logo removal
            if ($request->boolean('remove_logo')) {
                if ($clinicInfo->logo) {
                    Storage::disk('public')->delete($clinicInfo->logo);
                }
                $data['logo'] = null;
            }

            // Handle new logo upload
            if ($request->hasFile('logo')) {
                // Delete old logo if exists
                if ($clinicInfo->logo) {
                    Storage::disk('public')->delete($clinicInfo->logo);
                }

                $logoPath = $request->file('logo')->store('logos', 'public');
                $data['logo'] = $logoPath;
            }

            $clinicInfo->update($data);

            // Delete existing phones and recreate
            $clinicInfo->clinic_phones()->delete();

            // Handle phones
            if ($request->phones) {
                $phones = json_decode($request->phones, true) ?? [];
                foreach ($phones as $phone) {
                    if (!empty($phone['phone'])) {
                        ClinicPhone::create([
                            'clinic_info_id' => $clinicInfo->id,
                            'phone' => $phone['phone'],
                            'type' => $phone['type'] ?? 'mobile',
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('clinic-infos.index')
                ->with('success', 'Clinic information updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to update clinic information: ' . $e->getMessage()]);
        }
    }

    public function destroy(ClinicInfo $clinicInfo)
    {
        if ($clinicInfo->logo) {
            Storage::disk('public')->delete($clinicInfo->logo);
        }

        $clinicInfo->delete();

        return redirect()->route('clinic-infos.index')
            ->with('success', 'Clinic information deleted successfully.');
    }
}
