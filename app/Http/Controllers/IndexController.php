<?php

namespace App\Http\Controllers;

use App\Models\Aspirate;
use App\Models\Cyto;
use App\Models\Histo;
use App\Models\SpecimenType;
use App\Models\Trephine;
use App\Models\User;
use App\Notifications\CytoApproveResultNotification;
use App\Notifications\HistoApproveResultNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:access approve report'], ['only' => ['toApprove']]);
        $this->middleware(['permission:edit approve report'], ['only' => ['histoApproved', 'cytoApproved']]);
    }

    public function index(Request $request)
    {
        // Get date filters from request or use defaults (current month)
        $startDate = $request->input('start_date')
            ? Carbon::parse($request->input('start_date'))->startOfDay()
            : Carbon::now()->startOfMonth();

        $endDate = $request->input('end_date')
            ? Carbon::parse($request->input('end_date'))->endOfDay()
            : Carbon::now()->endOfDay();

        // For filtered data
        $aspirates = Aspirate::whereBetween('created_at', [$startDate, $endDate])->count();
        $trephines = Trephine::whereBetween('created_at', [$startDate, $endDate])->count();
        $histos = Histo::whereBetween('created_at', [$startDate, $endDate])->count();
        $cytos = Cyto::whereBetween('created_at', [$startDate, $endDate])->count();

        $first = $startDate->format('d-m-Y');
        $currentDate = $endDate->format('d-m-Y');

        $specimens = SpecimenType::withCount(['aspirates', 'trephines', 'histos', 'cytos'])->get();

        $dateArr = [];
        $aspirateRate = [];
        $trephineRate = [];
        $histoRate = [];
        $cytoRate = [];

        // Calculate the number of days between dates (max 30 days for chart)
        $daysDiff = min($startDate->diffInDays($endDate), 30);

        for ($i = $daysDiff; $i >= 0; $i--) {
            $currentDay = $endDate->copy()->subDays($i);
            $dateArr[] = $currentDay->format('j M');

            $aspirateRate[] = Aspirate::whereDate('created_at', $currentDay->toDateString())->count();
            $trephineRate[] = Trephine::whereDate('created_at', $currentDay->toDateString())->count();
            $histoRate[] = Histo::whereDate('created_at', $currentDay->toDateString())->count();
            $cytoRate[] = Cyto::whereDate('created_at', $currentDay->toDateString())->count();
        }

        return view('index', compact(
            'aspirateRate',
            'trephineRate',
            'histoRate',
            'cytoRate',
            'dateArr',
            'aspirates',
            'trephines',
            'histos',
            'cytos',
            'specimens',
            'first',
            'currentDate',
            'startDate',
            'endDate'
        ));
    }

    public function toapproveHisto()
    {
        $histos = Histo::with('specimenType')->search()
            ->where('is_complete', '0')
            ->where('is_approve', '1')
            ->latest('id')
            ->paginate(10);

        $specimens = SpecimenType::all();

        return view('approve.histo', ['histos' => $histos, 'specimens' => $specimens]);
    }

    public function toapproveCyto()
    {
        $cytos = Cyto::with('specimenType')->search()
            ->where('is_complete', '0')
            ->where('is_approve', '1')
            ->latest('id')
            ->paginate(10);

        $specimens = SpecimenType::all();
        return view('approve.cyto', ['cytos' => $cytos, 'specimens' => $specimens]);
    }


    public function histoApproved($id)
    {
        $histo = Histo::findOrFail($id);
        if ($histo->is_approve == '1') {
            $histo->is_approve = '0';
        }
        $users = User::role(['Admin', 'User'])->get();
        Notification::send($users, new HistoApproveResultNotification($histo));
        $histo->update();

        return response()->json([
            'status' => 'success',
            'create' => $histo->name . ' report အား Authorized Person မှ အတည်ပြုပြီးဖြစ်ပါသည်။',
            'info' => $histo
        ]);
    }

    public function cytoApproved($id)
    {
        $cyto = Cyto::findOrFail($id);
        if ($cyto->is_approve == '1') {
            $cyto->is_approve = '0';
        }

        $users = User::role(['Admin', 'User'])->get();
        Notification::send($users, new CytoApproveResultNotification($cyto));
        $cyto->update();

        return response()->json([
            'status' => 'success',
            'create' => $cyto->name . ' report အား Authorized Person မှ အတည်ပြုပြီးဖြစ်ပါသည်။',
            'info' => $cyto
        ]);
    }

    public function histo()
    {
        $histos = Histo::with('specimenType')->search()
            ->where('is_approve', '0')
            ->latest('id')
            ->paginate(10);
        $specimens = SpecimenType::all();
        return view('histo', ['histos' => $histos, 'specimens' => $specimens]);
    }

    public function cyto()
    {
        $cytos = Cyto::with('specimenType')->search()
            ->where('is_approve', '0')
            ->latest('id')
            ->paginate(10);
        $specimens = SpecimenType::all();

        return view('cyto', ['cytos' => $cytos, 'specimens' => $specimens]);
    }
}
