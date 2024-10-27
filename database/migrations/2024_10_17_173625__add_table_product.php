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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Автоинкрементный ID
            $table->string('name');
            $table->decimal('price', 10, 2); // Поле для цены
            $table->text('description'); // Поле для описания
            $table->string('image'); // Поле для хранения имени файла изображения
            $table->foreignId('owner')->constrained('users'); // Внешний ключ для связи с таблицей пользователей
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
