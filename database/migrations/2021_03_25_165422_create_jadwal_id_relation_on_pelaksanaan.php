<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalIdRelationOnPelaksanaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasTable('jadwal') && Schema::hasTable('pelaksanaan')) 
        {
            Schema::table('pelaksanaan', function(Blueprint $table) {
                $table->foreignId('jadwal_id')->constrained('jadwal')->onDelete('cascade');
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
        Schema::dropIfExists('jadwal_id_relation_on_pelaksanaan');
    }
}
