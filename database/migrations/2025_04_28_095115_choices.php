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
        Schema::create('choices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->integer('chapter_id')->unsigned();
            $table->foreign('chapter_id')
                ->references('id')
                ->on('chapters')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->integer('confiance');
            $table->integer('ressources');
            $table->integer('impact');
            $table->integer('crise');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choices');
    }
};
