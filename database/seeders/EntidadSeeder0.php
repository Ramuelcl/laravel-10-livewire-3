<?php

use Illuminate\Database\Seeder;
use App\Models\backend\Entidad;
use Illuminate\Support\Facades\DB;

class EntidadSeeder extends Seeder
{
    public function run()
    {
        // SELECT  `id`,  `Name`,  `Given Name`,  `Additional Name`,  `Family Name`,  `Birthday`,  `Gender`,  `Location`,  `E-mail 1 - Type`,  `E-mail 1 - Value`,  `E-mail 2 - Type`,  `E-mail 2 - Value`,  `E-mail 3 - Type`,  `E-mail 3 - Value`,  `Phone 1 - Type`,  `Phone 1 - Value`,  `Phone 2 - Type`,  `Phone 2 - Value`,  `Address 1 - Type`,  `Address 1 - Formatted`,  `Address 1 - Street`,  `Address 1 - City`,  `Address 1 - PO Box`,  `Address 1 - Region`,  `Address 1 - Postal Code`,  `Address 1 - Country`,  `Address 1 - Extended Address`,  `Address 2 - Type`,  `Address 2 - Formatted`,  `Address 2 - Street`,  `Address 2 - City`,  `Address 2 - PO Box`,  `Address 2 - Region`,  `Address 2 - Postal Code`,  `Address 2 - Country`,  `Address 2 - Extended Address`,  `Organization 1 - Name`,  `Organization 1 - Title`,  `Website 1 - Type`,  `Website 1 - Value`

        $imports = DB::table('import');

        foreach ($imports as $import) {
            dd($import);
            // genera la entidad
            $id = Entidad::create([
                'cliente_id' => $import->Given_Name,
            ]);
        }
    }
}
