<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('address_users', function (Blueprint $table) {
            // Asegúrate de que la columna 'user_id' exista y sea del tipo adecuado antes de agregar la clave foránea
            if (!Schema::hasColumn('address_users', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable();
            }

            // Agrega la clave foránea que referencia a la tabla 'user_details'
            $table->foreign('user_id')->references('id')->on('user_details')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('address_users', function (Blueprint $table) {
            // Elimina la clave foránea
            $table->dropForeign(['user_id']);
        });
    }
};
