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
        Schema::create('product_statistics', function (Blueprint $table) {
            $table->id();  
            $table->foreignId('owner')->constrained('users'); // связь с таблицей пользователей
            $table->integer('total_products'); // количество товаров за день
            $table->date('date'); // дата статистики
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_statistics');
    }
};
