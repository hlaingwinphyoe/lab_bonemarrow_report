<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinic_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->text('logo')->nullable();
            $table->timestamps();
        });

        Schema::create('clinic_phones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_info_id')->constrained()->cascadeOnDelete();
            $table->string('phone');
            $table->string('type')->nullable(); // mobile, hotline, whatsapp, etc.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clinic_infos');
        Schema::dropIfExists('clinic_phones');
    }
}
