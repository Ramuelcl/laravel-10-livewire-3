<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $table = 'banca_movimientos';
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
            $table->date('dateMouvement')->nullable();
            $table->text('libelle');
            $table->decimal('montant', 8, 2);
            $table->decimal('francs', 8, 2);
            $table
                ->bigInteger('cliente_id')
                ->nullable()
                ->default(null);
            $table
                ->bigInteger('releve')
                ->nullable()
                ->default(null);
            $table->date('dateReleve')->nullable();
            $table
                ->tinyInteger('estado')
                ->nullable()
                ->default(0);
            $table
                ->tinyInteger('conciliada')
                ->nullable()
                ->default(0);
            $table
                ->string('NomArchTras')
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
