<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKelasIdRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('kelas')) {
            Schema::table('murid', function(Blueprint $table) {
                $table->bigInteger('kelas_id', false)->unsigned()->nullable();

                $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('set null');
            });
        }
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
