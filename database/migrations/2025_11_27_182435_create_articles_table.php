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
    Schema::create('articles', function (Blueprint $table) {
        $table->id();
        $table->string('title');               // Заголовок
        $table->string('preview_image')->nullable(); // Превью
        $table->string('full_image')->nullable();    // Полное изображение
        $table->date('date')->nullable();           // Дата новости
        $table->string('shortDesc')->nullable();    // Короткое описание
        $table->text('desc')->nullable();           // Полный текст
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }   
};
