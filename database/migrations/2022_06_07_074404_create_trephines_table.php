<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrephinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trephines', function (Blueprint $table) {
            $table->id();
            $table->date('sc_date');
            $table->integer('lab_access');
            $table->string('patient_name');
            $table->string('slug');
            $table->integer('age');
            $table->char('age_type',2);
            $table->char('gender',7);
            $table->longText('contact_detail')->nullable();
            $table->string('physician_name');
            $table->string('doctor');
            $table->longText('clinical_history')->nullable();
            $table->longText('bmexamination')->nullable();
            $table->char('pro_perform',20);
            $table->longText('anatomic_site_trephine')->nullable();
            $table->longText('biopsy_core')->nullable();
            $table->longText('ade_macro_appearance')->nullable();
            $table->longText('percentage_cellularity')->nullable();
            $table->longText('bone_architecture')->nullable();
            $table->longText('path')->nullable();
            $table->integer('tre_number')->nullable();
            $table->longText('erythroid')->nullable();
            $table->longText('myeloid')->nullable();
            $table->longText('megaka')->nullable();
            $table->longText('lymphoid')->nullable();
            $table->longText('plasma_cell')->nullable();
            $table->longText('macrophages')->nullable();
            $table->longText('abnormal_cell')->nullable();
            $table->longText('reticulin_stain')->nullable();
            $table->longText('immunohistochemistry')->nullable();
            $table->longText('histochemistry')->nullable();
            $table->longText('investigation')->nullable();
            $table->longText('conclusion')->nullable();
            $table->longText('disease_code')->nullable();
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
        Schema::dropIfExists('trephines');
    }
}
