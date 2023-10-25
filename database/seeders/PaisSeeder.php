<?php

namespace Database\Seeders;

use App\Models\backend\Pais;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaisSeeder extends Seeder
{
    protected $table = 'paises';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pais::factory()->make();
        $paises = fncGlob_Files('C:\\laragon\\www\\lib\\images\\heroicons\\flags\\', "*", "jpeg");
        // dd($paises);

        foreach ($paises as  $value) {
            // dump([$value, $value['name']]);
            // dump([$value['filename'], $value['name']]);
            $name = str_replace($search = '_', $replace = ' ', $subject = $value['name']);
            DB::table($this->table)->insert([
                'nombre' => $name,
                'bandera' => $value['filename'],
                // 'idioma' => $value['name'],
            ]);
        }
    }
}
