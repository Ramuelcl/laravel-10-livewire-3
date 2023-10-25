<?php
// database\migrations\entidades

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'entidades';

    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->string('tipo_entidad', 2)->nullable()->default(null);
            $table->string('razonSocial', 128)->nullable()->default(null);
            $table->string('website', 128)->nullable()->default(null);
            $table->string('titulo', 64)->nullable()->default(null);
            $table->string('nombres', 80)->nullable()->default(null);
            $table->string('apellidos', 80)->nullable()->default(null);
            $table->boolean('is_active')->nullable()->default(true);
            $table->date('aniversario')->nullable()->default(null);
            $table->boolean('sexo')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::enableForeignKeyConstraints(); // Deja esta línea como está
    }

    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists($this->table);
        Schema::enableForeignKeyConstraints();
    }
};
