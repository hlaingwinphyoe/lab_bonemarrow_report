<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->integer('day');
            $table->integer('month');
            $table->integer('year');
            $table->char('gender',7);
            $table->string('doctor');
            $table->longText('specimen')->nullable();
            $table->date('bio_receive_date');
            $table->date('bio_cut_date');
            $table->date('bio_report_date');
            $table->longText('gross')->nullable();
            $table->longText('description')->nullable();
            $table->longText('remark')->nullable();
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
        Schema::dropIfExists('histos');
    }
}
