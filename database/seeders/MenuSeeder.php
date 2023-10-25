<?php
// database/seeders/menuSeeder.php
namespace Database\Seeders;

use App\Models\backend\Tabla;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public $menu = 1000;
    static public $ind = 0;
    static public $saltoInd = 100;
    static public $ultimoInd;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createMenuItems(null);
    }

    public function createMenuItems($parentId, $subMenu = null)
    {
        if ($parentId === null) { // la primera vez que entra
            // carga menu si existe, si no, genera Inicio por defecto
            $menuItems = config('app_settings.menus', [
                'nombre' => 'Inicio',
                'url' => '/',
                'is_active' => true,
                'icon' => 'home',
            ]);

            $menu = Tabla::create([
                'tabla' => $this->menu,
                'tabla_id' => 0,
                'nombre' => 'menus del sistema',
                'is_active' =>  false,
                'valor0' => null,
                'valor1' => null,
                'valor2' => null,
                'valor3' => null,
            ]);
        }
        $menuItems = $subMenu ?: $menuItems;
        $saltoInd = $subMenu ? 50 : 1000;

        foreach ($menuItems as $menuItem) {
            static::$ind += $saltoInd;

            $menu = Tabla::create([
                'tabla' => $this->menu,
                'tabla_id' => $menuItem['id'] ?? static::$ind,
                'nombre' => $menuItem['nombre'],
                'is_active' => $menuItem['is_active'] ?? false,
                'valor0' => $menuItem['url'] ?? null,
                'valor1' => $parentId,
                'valor2' => $menuItem['icon'] ?? null,
                'valor3' => null,
            ]);

            // carga subMenu si existe, lectura recursiva
            if (isset($menuItem['submenu'])) {
                $this->createMenuItems($menu->tabla_id, $menuItem['submenu']);
                static::$ind = $menu->tabla_id;
            }
        }
    }
}
