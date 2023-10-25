<?php

namespace Database\Seeders;

use App\Models\backend\Tabla;
use Illuminate\Database\Seeder;

class TablaSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // crea indice de tablas
        $tab_ind = [
            config('constantes.PROFESIONES') => 'Profesiones',
            config('constantes.OPCIONES_SI_NO') => 'opciones si/no',
            config('constantes.MONEDAS') => 'monedas',
            config('constantes.UNIDADES_MEDIDAS') => 'unidades medidas',
            config('constantes.CORREO_ELECTRÓNICO_PREDETERMINADO') => 'correo electrónico predeterminado',
            config('constantes.TIPO_DIRECCION') => 'tipo dirección',
            config('constantes.TIPO_TELEFONO') => 'tipo Teléfono',
            config('constantes.TIPO_EMAIL') => 'tipo eMail',
            config('constantes.TIPO_ENTIDAD') => 'tipo entidad',

            config('constantes.OTRO') => 'otro',

            config('constantes.BANCA') => 'banca',
            config('constantes.CAMPOS_A_EXPORTAR_PREDETERMINADO') => 'campos a exportar predeterminado',
            config('constantes.GASTOS') => 'gastos',

        ];

        // crea profesiones
        $tabla[config('constantes.PROFESIONES')] = [
            'Ejecutivo', 'Doctor', 'Empresario', 'Dibujante', 'Arquitecto', 'Analista', 'Programador', 'Enfermera', 'Contador', 'Profesor', 'Sin Profesion'
        ];

        //crea opciones
        $tabla[config('constantes.OPCIONES_SI_NO')] = [
            ['nombre' => 'Si', 'valor0' => 1], ['nombre' => 'No', 'valor0' => 0]
        ];
        //crea monedas
        $tabla[config('constantes.MONEDAS')] = [
            'euro', 'dolar', 'peso',
        ];

        //crea unidades medidas
        $tabla[config('constantes.UNIDADES_MEDIDAS')] = [
            ['nombre' => 'kilometro', 'valor0' => 'km'], ['nombre' => 'millas', 'valor0' => 'mi'], ['nombre' => 'Litro', 'valor0' => 'Lt'], ['nombre' => 'centímetro', 'valor0' => 'cm'], ['nombre' => 'metro cuadrado', 'valor0' => 'm2'], ['nombre' => 'metro', 'valor0' => 'mt']
        ];

        //crea correo electrónico predeterminado
        $tabla[config('constantes.CORREO_ELECTRÓNICO_PREDETERMINADO')] = [
            'ramuelcl@gmail.com',
        ];

        //crea tipo de dirección
        $tabla[config('constantes.TIPO_DIRECCION')] = [
            'Casa', 'Trabajo', 'Otro',
        ];

        //crea tipo de teléfono
        $tabla[config('constantes.TIPO_TELEFONO')] = [
            'Casa', 'Trabajo', 'Movil', 'fax', 'telecopiadora', 'otro',
        ];

        //crea tipo de email
        $tabla[config('constantes.TIPO_EMAIL')] = [
            'particular',  'empresa', 'otro',
        ];

        //crea tipo de entidad
        $tabla[config('constantes.TIPO_ENTIDAD')] = [
            'Perfil', 'Cliente', 'Vendedor', 'Cli_Vend',
        ];

        $tabla[config('constantes.OTRO')] = [
            '1', '2', '3',
        ];

        // crea datos de la banca
        $tabla[config('constantes.BANCA')] = [
            [
                'nombre' => 'REIGN',
                'valor0' => 'pagos de clientes',
                'valor0' => 1,
            ],
            [
                'nombre' => 'DIOURON',
                'valor0' => 'pagos de clientes',
                'valor0' => 2,
            ],
            [
                'nombre' => 'PUVIS',
                'valor0' => 'pagos de clientes',
                'valor0' => 9,
            ],
            [
                'nombre' => 'AC2 PRODUCTION',
                'valor0' => 'pagos de clientes',
                'valor0' => 22,
            ],
            [
                'nombre' => 'CRUCELISA ARISTIZABAL',
                'valor0' => 'movimientos personales',
                'valor0' => 69,
            ],
            [
                'nombre' => 'REGINA',
                'valor0' => 'movimientos personales',
                'valor0' => 70,
            ],
            [
                'nombre' => 'Navigo',
                'valor0' => 'proveedores',
                'valor0' => 1500,
            ],
            [
                'nombre' => 'SFR',
                'valor0' => 'proveedores',
                'valor0' => 1501,
            ],
            [
                'nombre' => 'Google YouTube',
                'valor0' => 'proveedores',
                'valor0' => 1502,
            ],
            [
                'nombre' => 'Orange',
                'valor0' => 'proveedores',
                'valor0' => 1503,
            ],
            [
                'nombre' => 'Samsung',
                'valor0' => 'proveedores',
                'valor0' => 1504,
            ],
            [
                'nombre' => 'Sosh',
                'valor0' => 'proveedores',
                'valor0' => 1503,
            ],
            [
                'nombre' => 'Free',
                'valor0' => 'proveedores',
                'valor0' => 1506,
            ],
            [
                'nombre' => 'FORMULE DE COMPTE ',
                'valor0' => 'La Poste',
                'valor0' => 1600,
            ],
            [
                'nombre' => 'DIRECTION GENERAL',
                'valor0' => 'IMPOTS',
                'valor0' => 1601,
            ],
            [
                'nombre' => 'MUNOZ ALBUERNO',
                'valor0' => 'movimientos personales',
                'valor0' => 99,
            ],
            [
                'nombre' => 'FORFAITAIRE TRIMESTRIEL',
                'valor0' => 'La Poste',
                'valor0' => 1600,
            ],
            [
                'nombre' => 'ACHAT CB',
                'valor0' => 'Compras Carte Blue',
                'valor0' => 1700,
            ],
            [
                'nombre' => 'AMAZON',
                'valor0' => 'Compras Carte Blue',
                'valor0' => 1700,
            ],
            [
                'nombre' => 'CDISCOUNT',
                'valor0' => 'Compras Carte Blue',
                'valor0' => 1700,
            ],
        ];
        //crea campos a exportar predeterminado
        $tabla[config('constantes.CAMPOS_A_EXPORTAR_PREDETERMINADO')] = [
            ['nombre' => 'tiempos', 'valor0' => 1], ['nombre' => 'pausa', 'valor0' => 1], ['nombre' => 'proyecto', 'valor0' => 1], ['nombre' => 'Tiempo Extra', 'valor0' => 1], ['nombre' => 'Monto', 'valor0' => 1], ['nombre' => 'Tarifa', 'valor0' => 1], ['nombre' => 'Trabajo', 'valor0' => 1], ['nombre' => 'Cliente', 'valor0' => 1], ['nombre' => 'Estado', 'valor0' => 1], ['nombre' => 'Etiqueta', 'valor0' => 1], ['nombre' => 'Nota', 'valor0' => 1], ['nombre' => 'Gastos', 'valor0' => 1], ['nombre' => 'Kilometraje', 'valor0' => 1],
        ];
        //crea gastos
        $tabla[config('constantes.GASTOS')] = [
            ['nombre' => 'Compras', 'valor0' => 'gasto', 'valor1' => '+'], ['nombre' => 'saldo anterior a descontar', 'valor0' => 'descuenta', 'valor1' => '-'], ['nombre' => 'saldo anterior a sumar', 'valor0' => 'agrega', 'valor1' => '+']
        ];

        foreach ($tab_ind as $indice => $titulo) {
            $id = 0;
            Tabla::create([
                'tabla' => $indice,
                'tabla_id' => $id,
                'nombre' => $titulo,
                'is_active' => false,
                'valor0' => null,
                'valor1' => null,
                'valor2' => null,
                'valor3' => null,
            ]);
            foreach ($tabla[$indice] as $key => $value) {

                $id = $id + 10;
                // dump([$key, $value]);
                if (is_array($value)) {
                    $nombre = $value['nombre'];
                    $is_active = true;
                    $val0 = isset($value['valor0']) ? $value['valor0'] : null;
                    $val1 = isset($value['valor1']) ? $value['valor1'] : null;
                    $val2 = isset($value['valor2']) ? $value['valor2'] : null;
                    $val3 = isset($value['valor3']) ? $value['valor3'] : null;
                } else {
                    $nombre =  $value;
                    $is_active =  true;
                    $val0 = null;
                    $val1 = null;
                    $val2 = null;
                    $val3 = null;
                }

                Tabla::create([
                    'tabla' => $indice,
                    'tabla_id' => $id,
                    'nombre' => $nombre,
                    'is_active' => $is_active,
                    'valor0' => $val0,
                    'valor1' => $val1,
                    'valor2' => $val2,
                    'valor3' => $val3,
                ]);
            }
        }
    }
}
