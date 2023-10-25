<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'marcadores';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::create($this->table, function (Blueprint $table) {
            $table->id();

            $table->string('nombre', 32)->unique();
            $table->string('babosa', 32)->nullable()->default(null);
            $table->string('hexa', 7)->unique()->default('#');
            $table->string('rgb', 20)->nullable()->default(null);
            $table->json('metadata')->nullable();
            $table->boolean('is_active')->nullable()->default(true);

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
