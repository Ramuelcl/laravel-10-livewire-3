<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'tablas';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create($this->table, function (Blueprint $table) {
            $table->bigInteger('tabla');
            $table->bigInteger('tabla_id');
            $table->string('nombre', 45);
            $table->boolean('is_active')->nullable()->default(true);
            $table->string('valor0')->nullable()->default(null);
            $table->string('valor1')->nullable()->default(null);
            $table->string('valor2')->nullable()->default(null);
            $table->string('valor3')->nullable()->default(null);
            $table->primary(['tabla', 'tabla_id']);
            $table->index('nombre');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists($this->table);
        Schema::enableForeignKeyConstraints();
    }
};
