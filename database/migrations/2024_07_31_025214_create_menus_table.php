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
        Schema::disableForeignKeyConstraints();
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('menu');
            $table->enum('type', ["P", "C"])->comment('Parent , Children');
            $table->boolean('sub')->comment('Punya Sub-Menu atau tidak');
            $table->string('route')->comment('Halaman Tujuan');
            $table->string('icon');
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('menus');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
