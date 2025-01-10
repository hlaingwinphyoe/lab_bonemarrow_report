<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aspirate_photos', function (Blueprint $table) {
            $table->dropForeign(['aspirate_id']);
            // $table->dropForeign('aspirate_photos_aspirate_id_foreign');
            // $table->foreign('aspirate_id')->references('id')->on('aspirates');
        });
        Schema::table('trephine_photos', function (Blueprint $table) {
            $table->dropForeign(['trephine_id']);
        });
        Schema::table('histo_photos', function (Blueprint $table) {
            $table->dropForeign(['histo_id']);
        });
        Schema::table('cyto_photos', function (Blueprint $table) {
            $table->dropForeign(['cyto_id']);
        });
        Schema::table('histo_grosses', function (Blueprint $table) {
            $table->dropForeign(['histo_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
