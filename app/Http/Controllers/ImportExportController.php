<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

use App\Models\banca\bancaImport as Model;
use App\Imports\BancaImports as Import;

class ImportExportController extends Controller
{
    public $table;

    public function index()
    {
        $titulos = ['id', 'Date', 'Libelle', 'EURES', 'FRANCS', 'archivo traspaso', '# movimiento'];

        $campos = ['id', 'date', 'libelle', 'montantEUROS', 'montantFRANCS', 'NomArchTras', 'IdArchMov'];
        $datas = Model::all();
        // dd($datas);
        return view('banca.import', ['datas' => $datas, 'titulos' => $titulos, 'campos' => $campos]);

        //
        // $totalImportados = Traspaso::count();
        // $totalMovimientos = Traspaso::whereNotNull('IdArchMov')->count();

        // $registrosDuplicados = DB::table('traspasos_banca')
        //     ->select(DB::raw("GROUP_CONCAT(CONCAT(Date, Libelle, MontantEUROS) SEPARATOR ', ') AS concat"))
        //     ->groupBy('Date', 'Libelle', 'MontantEUROS')
        //     ->havingRaw('COUNT(*) > 1')
        //     ->get();

        // $totalDuplicados = $registrosDuplicados->count();

        // $data = Traspaso::all();
        // // dd($data);

        // return view('banca.import', ['data' => $data, 'titulos' => $titulos, 'campos' => $campos, 'totalImportados' => $totalImportados, 'totalMovimientos' => $totalMovimientos, 'totalDuplicados' => $totalDuplicados]);
    }

    public function import(Request $request)
    {
        $mensajes = [];
        // dd($request, $request->get('nuevo'));

        // Validar el archivo enviado por el formulario
        $validado = $request->validate(
            [
                'archivo' => 'required|array',
                'archivo.*' => 'file|mimes:csv,txt,tsv|max:2048',
                'LineaEncabezado' => 'required|numeric',
                // 'nuevo' => 'boolean',
            ],
            [
                'archivo.required' => 'El campo archivo es requerido.',
                'archivo.array' => 'El campo archivo debe ser un arreglo.',
                'archivo.*.file' => 'El archivo seleccionado no es válido.',
                'archivo.*.mimes' => 'El archivo debe tener una de las siguientes extensiones: csv, txt, tsv.',
                'archivo.*.max' => 'El tamaño máximo permitido para el archivo es de 2048 KB.',
                'LineaEncabezado.required' => 'El campo encabezado es requerido.',
                'LineaEncabezado.numeric' => 'El campo encabezado debe ser numérico',
                // 'nuevo.required' => 'se debe señalar si quiere o no crear el archivo desde cero',
                // 'nuevo.boolean' => 'es un valor boleano (si/no)',
            ],
        );
        // dump($validado, $request->get('LineaEncabezado'));

        $archivos = $validado['archivo'];
        // $nuevo = $validado['nuevo'];
        // if ($nuevo) {
        //     $this->createTablaTraspasos();
        // }
        $LineaEncabezado = $validado['LineaEncabezado'];
        // dd(['archivos:' => $archivos, 'LineaEncabezado' => $LineaEncabezado, 'nuevo' => $nuevo]);

        foreach ($archivos as $archivo) {
            // Obtener el nombre original del archivo
            $nombreOriginal = $archivo->getClientOriginalName();
            // $extension = $archivo->getClientOriginalExtension();

            // dd($archivo, $nombreOriginal, $extension);

            // Verificar si el archivo ya ha sido importado
            if ($this->checkFileImported($nombreOriginal)) {
                $mensajes[] = "Archivo ya traspasado: $nombreOriginal";
                // return redirect()
                //     ->back()
                //     ->with('success', "Archivo ya traspasado: $nombreOriginal");
            } else {
                // Determinar los campos y columnas correspondientes según la extensión del archivo
                $camposTabla = [
                    0 => ['Date' => 'date'],
                    1 => ['Libelle' => 'text'],
                    2 => ['MontantEUROS' => 'decimal,2'],
                    3 => ['MontantFRANCS' => 'decimal,2'],
                    4 => ['NomArchTras' => 'text']
                ];

                // dd(['camposTabla' => $camposTabla, 'camposArchivo' => $camposArchivo]);

                // Crear una instancia de TraspasoBancaImport con los parámetros necesarios
                $importador = new Import($nombreOriginal,  $camposTabla, $LineaEncabezado);
                // Importar los datos del archivo
                // dd(['archivo' => $archivo]);
                $importador->import($archivo);
                // dd(['importador' => $importador]);

                // Redireccionar o mostrar un mensaje de éxito
                $mensajes['success'] = "El archivo ($nombreOriginal) se ha importado.";
                session()->put('success', $mensajes);
                // } catch (\Exception $e) {
                //     // dd($archivo, $e->getMessage());
                //     $mensajes['error'] = 'Ha ocurrido un error al importar el archivo: ' . $e->getMessage();
                //     session()->put('error', $mensajes);
                // }
            }
        }
        if ($mensajes) {
            session()->put('success', $mensajes);
        }
        return redirect()->back();
    }

    public function export()
    {
        dd('TODO');
    }

    //  funciones
    public function checkFileImported($nombreArchivo)
    {
        try {
            $count = Model::where('NomArchTras', $nombreArchivo)->count();
        } catch (\Throwable $th) {
            $count = 0;
        }

        return $count > 0;
    }

    public function createTablaTraspasos()
    {
        $table = new Model();
        $this->table = $table->table;
        // dd('createTablaTraspasos', Schema::hasTable($this->table));
        try {
            // Crear la tabla
            if (Schema::hasTable($this->table)) {
                DB::statement("TRUNCATE TABLE $this->table");
                return redirect()->back()->with('success', 'La tabla ha sido creada exitosamente.');
            }

            // Vaciar la tabla si tiene datos
            // if ($count > 0) {
            //     DB::table($this->table)->truncate();
            //     // echo "La tabla ha sido vaciada.<br>";
            // } elseif ($count == 0) {
            //     DB::statement('ALTER TABLE traspaso_bancas AUTO_INCREMENT = 1;');
            //     // echo 'La tabla tiene el incrementador en 1.<br>';
            // }

            // sleep(50);
            // dd($this->table);
        } catch (\Exception $e) {
            dd($e);
            echo 'Error al crear, vaciar o poner a 1 el AUTO_INCREMENT de la tabla: ' . $e->getMessage() . '<br>';
        }
        return;
    }
}
