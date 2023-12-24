<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//
use App\Models\immo\Option;
use App\Models\immo\Property;

return new class extends Migration {
    protected $table = 'option_property';
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table
                ->foreignIdFor(Option::class)
                ->contrained()
                ->cascadeOnDelete();
            $table
                ->foreignIdFor(Property::class)
                ->contrained()
                ->cascadeOnDelete();
            $table->primary(['option_id', 'property_id']);
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
