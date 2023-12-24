<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $table = 'banca_imports';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table
                ->string('cuenta', 12)
                ->nullable()
                ->default('5578733W020');
            $table
                ->string('tipo', 3)
                ->nullable()
                ->default('CCP');
            $table
                ->string('dateMouvement')
                ->nullable()
                ->default(null);
            $table->text('libelle');
            $table->decimal('montant', 8, 2);
            $table
                ->decimal('francs', 8, 2)
                ->nullable()
                ->default(0);
            $table
                ->string('NomArchTras')
                ->nullable()
                ->default(null);
            $table
                ->string('idMovimientos')
                ->nullable()
                ->default(null);
            $table->index(['cuenta', 'dateMouvement']);
            $table->timestamps();
            $table->softDeletes();
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
