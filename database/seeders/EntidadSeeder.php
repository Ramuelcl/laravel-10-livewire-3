<?php
// database\seeder\EntidadSeeder.php

namespace Database\Seeders;

use App\Models\backend\Ciudad;
use App\Models\backend\Direccion;
use App\Models\backend\Email;
use App\Models\backend\Entidad;
use App\Models\backend\Pais;
use App\Models\backend\Tabla;
use App\Models\backend\Telefono;
//
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EntidadSeeder extends Seeder
{
    /**
     * Este seeder toma datos de la tabla 'import' y los inserta en la tabla 'entidades'.
     */
    public function run(): void
    {
        // SELECT  `id`,  `Name`,  `Given Name`,  `Additional Name`,  `Family Name`,  `Birthday`,  `Gender`,  `Location`,  `E-mail 1 - Type`,  `E-mail 1 - Value`,  `E-mail 2 - Type`,  `E-mail 2 - Value`,  `E-mail 3 - Type`,  `E-mail 3 - Value`,  `Phone 1 - Type`,  `Phone 1 - Value`,  `Phone 2 - Type`,  `Phone 2 - Value`,  `Address 1 - Type`,  `Address 1 - Formatted`,  `Address 1 - Street`,  `Address 1 - City`,  `Address 1 - PO Box`,  `Address 1 - Region`,  `Address 1 - Postal Code`,  `Address 1 - Country`,  `Address 1 - Extended Address`,  `Address 2 - Type`,  `Address 2 - Formatted`,  `Address 2 - Street`,  `Address 2 - City`,  `Address 2 - PO Box`,  `Address 2 - Region`,  `Address 2 - Postal Code`,  `Address 2 - Country`,  `Address 2 - Extended Address`,  `Organization 1 - Name`,  `Organization 1 - Title`,  `Website 1 - Type`,  `Website 1 - Value`

        // Borra todos los registros existentes en la tabla 'entidades'

        // Antes de insertar nuevos registros, elimina los registros existentes en telefonos
        // DB::table('telefonos')->truncate();
        // DB::table('entidades')->truncate();

        $rows = DB::table('import')->get();
        foreach ($rows as $row) {
            // $entidad = new Entidad();
            // Inserta el registro en la tabla 'entidades'
            $entidad_id = DB::table('entidades')->insertGetId([
                'tipo_entidad' => 10, // Ajusta según tus necesidades
                'razonSocial' => $row->{'Organization 1 - Name'} ?: null,
                'website' => $row->{'Website 1 - Value'} ?: null,
                'titulo' => $row->{'Organization 1 - Title'} ?: null,
                'nombres' => $row->{'Given Name'} . ' ' . $row->{'Additional Name'},
                'apellidos' => $row->{'Family Name'},
                'is_active' => true, // Ajusta según tus necesidades
                'aniversario' => $this->parseDate($row->Birthday),
                'sexo' => $row->Gender,
            ]);
            // dd($row, $entidad_id);

            ///////////////////////////////////////////////
            // procesa y agrega los EMAILS a la entidad
            ///////////////////////////////////////////////
            for ($i = 1; $i <= 3; $i++) { // Suponiendo que hay hasta 3 correos electrónicos por entidad
                $emailTypeKey = $this->determinarTipoKey($i);
                $emailToCheck = $row->{"E-mail {$i} - Value"};

                if ($emailToCheck && filter_var($emailToCheck, FILTER_VALIDATE_EMAIL)) {

                    // Realiza una consulta para buscar el correo electrónico
                    $existingEmail = Email::where('eMail', $emailToCheck)->first();

                    if ($existingEmail) {
                        // El correo electrónico ya existe en la base de datos
                        // Puedes manejar la lógica aquí, como mostrar un mensaje de error
                    } else {
                        // El correo electrónico no existe en la base de datos, puedes insertarlo
                        // Email::create([
                        //     'entidad_id' => $entidad_id,
                        //     'tipo' => $emailTypeKey, // Ajusta esto según tus necesidades
                        //     'eMail' => $emailToCheck,
                        // ]);
                        $this->insertEmail($entidad_id, $emailTypeKey, $emailToCheck);
                    }
                }
            }
            ///////////////////////////////////////////////
            // procesa y agrega los TELEFONOS a la entidad
            ///////////////////////////////////////////////
            for ($i = 1; $i <= 2; $i++) { // Cambia esto según la cantidad de teléfonos que esperas
                $phoneType = $row->{"Phone {$i} - Type"};
                $phoneValue = $row->{"Phone {$i} - Value"};

                // Verifica si se proporciona un tipo y un valor de teléfono
                if ($phoneType && $phoneValue && strlen($phoneValue) > 5) {
                    // Determina el tipo de teléfono basado en $phoneType
                    $phoneType = $this->determinarTipoIndice(config('constant.TIPO_TELEFONO'), $phoneType);

                    // Inserta el teléfono en la tabla 'telefonos'
                    // Telefono::insert([
                    //     'entidad_id' => $entidad_id, // El ID de la entidad a la que pertenece este teléfono
                    //     'tipo' => $phoneType,
                    //     'numero' => $phoneValue,
                    // ]);
                    $this->insertTelefono($entidad_id, $phoneType, $phoneValue);
                }
            }

            ///////////////////////////////////////////////
            // procesa y agrega las DIRECCIONES a la entidad
            ///////////////////////////////////////////////
            for ($i = 1; $i <= 2; $i++) { // Cambia esto según la cantidad de direcciones que esperas
                // Determina el tipo de dirección basado en $phoneType
                $addressType = $this->determinarTipoKey($i);
                // $formattedAddress = $row->{"Address {$i} - Formatted"};
                $street = $row->{"Address {$i} - Street"};
                if (!$street)
                    continue;

                $city = $row->{"Address {$i} - City"};
                $postalCode = $row->{"Address {$i} - Postal Code"};
                $country = $row->{"Address {$i} - Country"};
                $direccionId = $this->insertDireccion($entidad_id, $addressType, $street, $postalCode);

                // Inserta la ciudad si existe
                if (!empty($city)) {
                    // Realiza una consulta para buscar la ciudad
                    $ciudadId = Ciudad::where('nombre', $city)->first();

                    if ($ciudadId) {
                        $ciudadId = $ciudadId->id;
                        // La ciudad ya existe en la base de datos
                        // Puedes manejar la lógica aquí, como mostrar un mensaje de error
                    } else {
                        $ciudadId = $this->insertCiudad($city);
                    }
                    // Asocia la ciudad a la dirección
                    DB::table('direcciones')->where('id', $direccionId)->update(['ciudad_id' => $ciudadId]);

                    // Inserta el país si existe
                    if ($country == '') $country = 'France';
                    if (!empty($country)) {
                        // Realiza una consulta para buscar la ciudad
                        $paisId = Pais::where('nombre', $country)->first();

                        if ($paisId) {
                            $paisId = $paisId->id;
                            // La ciudad ya existe en la base de datos
                            // Puedes manejar la lógica aquí, como mostrar un mensaje de error
                        } else {
                            $paisId = $this->insertPais($country);
                        }
                        // Asocia el país a la ciudad
                        DB::table('ciudades')->where('id', $ciudadId)->update(['pais_id' => $paisId]);
                    }
                }


                // dd($pais);

                // dump($paisId, $i, $addressType, $street);
            }
        }
    }

    private function determinarTipoIndex($tabla, $key)
    {
        // Convierte a minúsculas para realizar una comparación insensible a mayúsculas/minúsculas
        $key = strtolower($key);
        $existe = null;
        $existe = Tabla::where('tabla', $tabla)
            ->Where('nombre', $key)
            ->first('tabla_id');
        return $existe;
    }

    private function determinarTipoKey($key)
    {
        if ($key == 1) {
            return 10;
        } elseif ($key == 2) {
            return 20;
        } elseif ($key == 3) {
            return 30;
        } else {
            // En caso de que no coincida con ninguno de ellos.
            return 90;
        }
    }

    private function determinarTipoIndice($key)
    {
        // Convierte a minúsculas para realizar una comparación insensible a mayúsculas/minúsculas
        $key = strtolower($key);

        // Verifica si contiene 'home' o 'work' y asigna el tipo adecuado
        if (strpos($key, 'home') !== false) {
            return 10;
        } elseif (strpos($key, 'work') !== false) {
            return 20;
        } elseif (strpos($key, 'mobile') !== false) {
            return 30;
        } else {
            // En caso de que no coincida con ninguno de los dos, podrías devolver un valor por defecto o manejarlo de otra manera.
            return 90;
        }
    }
    private function insertTelefono($entidad_id, $tipo, $numero)
    {
        DB::table('telefonos')->insert([
            'entidad_id' => $entidad_id,
            'tipo' => $tipo,
            'numero' => $numero,
        ]);
    }

    private function insertEmail($entidad_id, $tipo, $valor)
    {
        DB::table('emails')->insert([
            'entidad_id' => $entidad_id,
            'tipo' => $tipo,
            'email' => $valor,
        ]);
    }

    private function insertDireccion($entidad_id, $tipo, $street, $postalCode)
    {
        return DB::table('direcciones')->insertGetId([
            'entidad_id' => $entidad_id,
            'tipo' => $tipo,
            'direccion' => $street,
            'codigo_postal' => $postalCode,
        ]);
    }

    private function insertCiudad($nombre)
    {
        return DB::table('ciudades')->insertGetId([
            'nombre' => $nombre,
        ]);
    }

    private function insertPais($nombre)
    {
        return DB::table('paises')->insertGetId([
            'nombre' => $nombre,
        ]);
    }

    private function parseDate($date)
    {
        return $date ? Carbon::createFromFormat('Y-m-d', $date)->toDateString() : null;
    }
}
