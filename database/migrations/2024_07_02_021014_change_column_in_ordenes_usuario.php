<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        try {
          Schema::table('ordenes', function (Blueprint $table) {
            $table->dropForeign('user_id'); // Elimina la clave foránea
        });
        } catch (Exception $e) {
          //
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ordenes', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('ordenes')
                  ->onDelete('cascade'); // Vuelve a crear la clave foránea
        });
    }
};
