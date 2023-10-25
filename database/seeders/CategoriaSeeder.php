<?php
// database/seeders/CategoriaSeeder.php
namespace Database\Seeders;

use App\Models\backend\Tabla;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public $categoria = 2000;
    public $niveles = 2;
    static public $ind = 0;
    static public $saltoInd = 10;
    static public $ultimoInd;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->categoria = config(
            'app_settings.codigo_categorias',
            2000
        );
        $this->niveles = config(
            'app_settings.niveles_categorias',
            2
        );
        $this->createCategoriaItems(null);
    }

    public function createCategoriaItems($parentId, $subCategoria = null)
    {
        if ($parentId === null) {
            // la primera vez que entra
            // carga categoria si existe, si no, genera por defecto

            // $this->niveles = config('app_settings.niveles_categorias');
            // if (config('app_settings.niveles_categorias') > $this->niveles) {
            //     $this->niveles = config('app_settings.niveles_categorias');
            //     for ($i = 1; $i < $this->niveles; $i++) {
            //         $Items =  [
            //             'nombre' => 'Categoría $i',
            //             'is_active' => true,
            //         ];
            //     }
            // } else {
            $Items = config(
                'app_settings.categorias',
                [
                    'nombre' => 'Categoría 1',
                    'is_active' => true,
                    'subcategoria' => [
                        'nombre' => 'SubCategoría 2',
                        'is_active' => true,
                        'subcategoria' => [
                            'nombre' => 'SubCategoría 3',
                            'is_active' => true,
                        ],
                    ]
                ]
            );
            // };

            $categoria = Tabla::create([
                'tabla' => $this->categoria,
                'tabla_id' => static::$ind,
                'nombre' => 'categorias',
                'is_active' =>  false,
                'valor0' => null,
                'valor1' => null,
                'valor2' => null,
                'valor3' => null,
            ]);
        }
        // dd($Items, $categoria);

        $Items = $subCategoria ?: $Items;
        $saltoInd = $subCategoria ? 5 : 100;

        // dd($Items);

        foreach ($Items as $Item) {
            static::$ind += $saltoInd;
            $categoria = Tabla::create([
                'tabla' => $this->categoria,
                'tabla_id' => $Item['id'] ?? static::$ind,
                'nombre' => $Item['nombre'],
                'is_active' => $Item['is_active'] ?? false,
                'valor0' => $parentId,
                'valor1' => null,
                'valor2' => null,
                'valor3' => null,
            ]);

            dump(static::$ind, $categoria);

            // carga subCategoria si existe, lectura recursiva
            if (isset($Item['subcategoria'])) {
                $this->createCategoriaItems($categoria->tabla_id, $Item['subcategoria']);
                static::$ind = $categoria->tabla_id;
            }
        }
    }
}
