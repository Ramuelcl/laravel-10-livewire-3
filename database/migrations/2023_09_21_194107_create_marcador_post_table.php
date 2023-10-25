<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $table = 'marcador_post';
    protected $table1 = 'posts';
    protected $table2 = 'marcadores';

    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create($this->table, function (Blueprint $table) {
            $table->id();

            $table->foreignId('post_id')
                ->constrained($this->table1)  // Cambio aquí para especificar la tabla relacionada
                ->onDelete('cascade');
            $table->foreignId('marcador_id')
                ->constrained($this->table2)  // Cambio aquí para especificar la tabla relacionada
                ->onDelete('cascade');

            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    public function down()
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists($this->table);

        Schema::enableForeignKeyConstraints();
    }
};
