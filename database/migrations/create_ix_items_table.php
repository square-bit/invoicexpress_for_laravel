<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ix_items', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();

            $table->string('name');
            $table->string('description')->nullable();
            $table->float('unit_price')->nullable();
            $table->float('quantity')->nullable();
            $table->string('unit')->nullable();
            $table->json('tax');

            $table->timestamps();
        });
    }
};
