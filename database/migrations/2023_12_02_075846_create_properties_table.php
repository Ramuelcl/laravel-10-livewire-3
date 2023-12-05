<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'properties';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->longText('description');
            $table->integer('surface');
            $table->integer('rooms');
            $table->integer('bedrooms');
            $table->integer('floor');
            $table->integer('price');
            $table->string('city');
            $table->string('address');
            $table->string('postal_code');
            $table->boolean('sold');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
