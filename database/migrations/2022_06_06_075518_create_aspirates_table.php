<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAspiratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aspirates', function (Blueprint $table) {
            $table->id();
            $table->date('sc_date')->nullable();
            $table->integer('lab_access');
            $table->string('patient_name');
            $table->string('slug');
            $table->integer('day');
            $table->integer('month');
            $table->integer('year');
            $table->char('gender',7);
            $table->longText('contact_detail')->nullable();
            $table->string('physician_name');
            $table->string('doctor');
            $table->longText('clinical_history')->nullable();
            $table->longText('bmexamination')->nullable();
            $table->char('pro_perform',20);
            $table->longText('anatomic_site_aspirate')->nullable();
            $table->longText('ease_diff_aspirate')->nullable();
            $table->longText('blood_count')->nullable();
            $table->longText('blood_smear')->nullable();
            $table->longText('cellular_particles')->nullable();
            $table->longText('nucleated_differential')->nullable();
            $table->longText('total_cell_count')->nullable();
            $table->longText('myeloid')->nullable();
            $table->longText('erythropoiesis')->nullable();
            $table->longText('myelopoiesis')->nullable();
            $table->longText('megakaryocytes')->nullable();
            $table->longText('lymphocytes')->nullable();
            $table->longText('plasma_cell')->nullable();
            $table->longText('haemopoietic_cell')->nullable();
            $table->longText('abnormal_cell')->nullable();
            $table->longText('iron_stain')->nullable();
            $table->longText('cytochemistry')->nullable();
            $table->longText('investigation')->nullable();
            $table->longText('flow_cytometry')->nullable();
            $table->longText('conclusion')->nullable();
            $table->longText('classification')->nullable();
            $table->longText('disease_code')->nullable();
            $table->foreignId('specimen_type_id')->constrained()->cascadeOnDelete()->cascadeOnDelete();
            $table->foreignId('hospital_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('aspirates');
    }
}
