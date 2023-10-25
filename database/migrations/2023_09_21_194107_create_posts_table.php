<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'posts';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('titulo', 32)->nullable()->default(null);
            $table->string('babosa', 32)->nullable()->default(null);
            $table->longText('contenido')->nullable()->default(null);
            $table->string('image_path')->nullable()->default(null);
            $table->foreignId('categoria_id')
                ->constrained()
                ->onDelete('cascade');

            $table->timestamp('publicado')->nullable()->default(null);
            $table->timestamp('actualizado')->nullable()->default(null)->useCurrentOnUpdate();

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
