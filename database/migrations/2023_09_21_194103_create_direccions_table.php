<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'direcciones';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->foreignId('entidad_id')->constrained('entidades')->cascadeOnDelete()->cascadeOnUpdate()->default(0);
            $table->string('tipo', 2);
            $table->string('direccion', 128);
            $table->string('codigo_postal', 6)->nullable()->default('0');
            $table->unsignedBigInteger('ciudad_id')->nullable()->default(null);
            $table->string('region', 64)->nullable()->default(null);
            //
            $table->foreign('ciudad_id')->references('id')->on('ciudades')->cascadeOnDelete()->cascadeOnUpdate();
            //
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
