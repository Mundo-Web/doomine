<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('detalle_ordens', function (Blueprint $table) {
            // Eliminar las columnas 'talla' y 'color'
            $table->dropColumn(['talla', 'color']);

            // Agregar la columna 'combinacion_id'
            $table->unsignedBigInteger('combinacion_id')->nullable();

            // Si 'combinacion_id' hace referencia a otra tabla, puedes agregar la relación
            $table->foreign('combinacion_id')->references('id')->on('combinaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detalle_ordens', function (Blueprint $table) {
            // Agregar las columnas 'talla' y 'color' de nuevo
            $table->string('talla')->nullable();
            $table->string('color')->nullable();

            // Eliminar la columna 'combinacion_id'
            $table->dropColumn('combinacion_id');

            // Si habías agregado una relación, elimínala también
            // $table->dropForeign(['combinacion_id']);
        });
    }
};
