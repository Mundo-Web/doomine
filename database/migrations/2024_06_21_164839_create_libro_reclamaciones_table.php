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
        Schema::create('libro_reclamaciones', function (Blueprint $table) {
            $table->id();
            
            $table->string('fullname')->nullable();
            $table->string('type_document')->nullable();
            $table->string('number_document')->nullable();
            $table->integer('cellphone')->nullable();
            $table->string('email')->nullable();
            $table->string('department')->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('address')->nullable();
            $table->string('typeitem')->nullable();
            $table->decimal('amounttotal', 12, 2)->default(0);
            $table->string('category_product_service')->nullable();
            $table->string('description')->nullable();
            $table->string('type_claim')->nullable();
            $table->string('date_incident')->nullable();
            $table->string('address_incident')->nullable();
            $table->text('detail_incident')->nullable();
            $table->string('archivo')->nullable();
            
            $table->boolean('is_read')->default(false);
            $table->boolean('status')->default(true);
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libro_reclamaciones');
    }
};
