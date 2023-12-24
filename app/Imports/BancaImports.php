<?php
namespace App\Imports;

use App\Models\banca\bancaImport;
use App\Imports\clsFileReader;

use DateTime;
use Exception;

class BancaImports extends clsFileReader
{
    public $fileReader;

    public $nombreOriginal;

    public $camposTabla;

    public $LineaEncabezado, $force;

    public $table;

    public function __construct($nombreArchivo, $camposTabla = null, $LineaEncabezado = 8)
    {
        // dd($table, $this->table);

        // Crear una instancia de clsFileReader y configurar opciones personalizadas
        $this->fileReader = new clsFileReader($nombreArchivo);

        $this->nombreOriginal = $nombreArchivo;
        $this->camposTabla = $camposTabla;
        $this->fileReader->letLineaEncabezado();
    }

    public function import($file)
    {
        // dd(['file' => $file]);
        $row = [];
        $asArray = true;
        // Leer el archivo línea por línea
        $this->fileReader->open($file);

        $lineas = 0;
        while (($line = $this->fileReader->readLines()) !== false) {
            $lineas++;
            // dump(['file:' => $file, 'leyó linea:' => $line, 'linea:' => $lineas, 'separador:' => $this->fileReader->getSeparadorCampos(), 'string:' => $this->fileReader->getCaracterString(), 'FinLinea:' => $this->fileReader->getFinLinea()]);
            // Obtener datos de la línea actual
            if ($lineas <= $this->fileReader->getLineaEncabezado()) {
                continue;
            }

            // recupera la linea particionada en un arreglo
            try {
                // dump(['file:' => $file, 'camposTabla:' => $this->camposTabla]);
                if ($this->camposTabla) {
                    $row = $this->fileReader->parseLine($line, $this->camposTabla);
                }
                //para ser asociativos, asigno nombres
                else {
                    $row = $this->fileReader->parseLine($line);
                } //para ser asociativos, asigno nombres
            } catch (\Throwable $th) {
                dd([$th, $row, $this->camposTabla]);
                throw $th;
            }
            // dd(['separó linea: ' => $row, 'campos tabla' => $this->camposTabla]);

            // if (sizeof($row) < sizeof($this->camposTabla)) {
            //     // debo reconocer cual es el que falta
            //     $row['MontantFRANCS'] = 0;
            // }

            // dd($row);

            // Crear una nueva instancia del modelo y guardar en la base de datos
            // dump(['camposTabla' => $this->camposTabla, 'row' => $row]);
            // $libelle = $this->fncConvertirCadenaBytes($row[$this->camposTabla[1]]);
            // try {
            $modelo = new bancaImport();
            // dd(['row' => $row]);
            if ($this->camposTabla) {
                $modelo->dateMouvement = $row['Date'];
                $modelo->Libelle = $row['Libelle'];
                $modelo->montant = (float) $row['MontantEUROS'];
                // $modelo->francs = (float) $row['MontantFRANCS'] ?? null;
            } else {
                $modelo->dateMouvement = $row[0];
                $modelo->Libelle = $row[1];
                $modelo->montant = $row[2];
                // $modelo->francs = $row[3] ?? null;
            }
            $modelo->NomArchTras = $this->nombreOriginal ?? null;
            // } catch (\Throwable $th) {
            // dd([$row, $modelo]);
            // throw $th;
            // }

            // $modelo->Date_Libelle_montantEUROS_montantFRANCS =
            //     $row[$this->camposTabla[0]]             .
            //     $libelle .
            //     $row[$this->camposTabla[2]] .
            //     $row[$this->camposTabla[3]];
            $modelo->save();
            // dump("crea registro");
        }

        $this->fileReader->close();
        return;
    }

    //     public function store(Request $request)
    // {
    //     // dump($request);
    //     $request->validate([
    //         'nombre' => 'required|unique:colors',
    //         'hexa' => 'required|unique:colors',
    //     ]);
    //     $request->merge([
    //         'slug' => Str::slug($request->nombre),
    //     ]);
    //     $color = Color::create($request->all());
    //     return redirect()
    //         ->route('backend.colores.edit', $color)
    //         ->with('info', 'Registro creado');
    // }

    function fncConvertirCadenaBytes($string, $default = 'UTF-8')
    {
        $encodings = ['UTF-8', 'ISO-8859-1', 'Windows-1251'];
        $validEncoding = false;
        foreach ($encodings as $encoding) {
            if (mb_check_encoding($string, $encoding)) {
                $validEncoding = true;
                echo "La cadena está codificada en $encoding";
                $string = mb_convert_encoding($string, $default, $encoding);
                break;
            }
        }
        if (!$validEncoding) {
            echo 'La cadena no está codificada en ninguna de las codificaciones admitidas';
        }
        return $string;
    }

    private function fncTransfiereDato($valor, $tipoDato = 0)
    {
        // dump(['fncTransfiereDato' => $valor, $tipoDato]);
        if ($tipoDato === 'integer') {
            $value = (int) $valor;
            // dump($value);
            return $value;
        } elseif ($tipoDato === 'date') {
            $value = date('Y/d/m', strtotime($valor));
            // dump($value);
            return $value;
        } elseif (strpos($tipoDato, 'decimal') !== false) {
            $precision = explode(',', $tipoDato)[1] ?? 2;
            $value = number_format((float) $valor, $precision, '.', '');
            // dump($value);
            return $value;
        } else {
            $value = (string) $valor;
            // dump($value);
            return $value;
        }
    }
}
