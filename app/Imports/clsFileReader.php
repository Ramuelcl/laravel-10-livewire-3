<?php

namespace App\Imports;

use Exception;

class clsFileReader
{
    private $filePath;
    private $separadorCampos;
    private $caracterString;
    private $finLinea;
    private $lineaEncabezados;
    private $saltaALinea;

    protected $file;
    protected $handle;
    protected $encoding = 'UTF-8';
    protected $fileType;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        $this->determinarOpcionesPorDefecto();
    }

    public function setConfig($cnf)
    {
        $this->letSeparadorCampos($cnf['separadorCampos']);
        $this->letCaracterString($cnf['caracterString']);
        $this->letFinLinea($cnf['finLinea']);
        $this->letLineaEncabezado($cnf['lineaEncabezados']);
    }

    public function letSeparadorCampos($valor = null, $default = ';')
    {
        if ($valor !== null) {
            $this->separadorCampos = $valor;
        }
        return $this->separadorCampos ?? $default;
    }
    public function getSeparadorCampos()
    {
        return $this->separadorCampos;
    }
    public function setSeparadorCampos($valor = ';')
    {
        $this->separadorCampos = $valor;
    }

    public function letCaracterString($valor = null, $default = '"')
    {
        if ($valor !== null) {
            $this->caracterString = $valor;
        }
        return $this->caracterString ?? $default;
    }
    public function getCaracterString()
    {
        return $this->caracterString;
    }
    public function setCaracterString($valor = '"')
    {
        $this->caracterString = $valor;
    }

    public function letFinLinea($valor = null, $default = '\r\n')
    {
        if ($valor !== null) {
            $this->finLinea = $valor;
        }
        return $this->finLinea ?? $default;
    }
    public function getFinLinea()
    {
        return $this->finLinea;
    }
    public function setFinLinea($valor = '\r\n')
    {
        $this->finLinea = $valor;
    }

    public function letLineaEncabezado($valor = 0)
    {
        // Leer el archivo línea por línea
        $paso = $this->open($filePath);
        dd($this, $paso);
        for ($i = 0; $i < 10; $i++) {
            $haystack = $this->readLines();
            $pos = Str::contains($haystack, $this->lineaEncabezados);
            if ($pos > 0) {
                $this->saltaALinea = $pos + 1;
                break;
            }
        }
        dd($this->saltaALinea);
        return $this->saltaALinea ?? $valor;
    }
    public function getLineaEncabezado()
    {
        return $this->saltaALinea;
    }
    public function setLineaEncabezado($valor = 1)
    {
        $this->saltaALinea = $valor;
    }

    public function readLines()
    {
        // dump($this->handle);

        // Obtener la siguiente línea del archivo
        $linea = fgets($this->handle);
        // Convertir el tipo MIME al encoding especificado
        // $linea = mb_convert_encoding($linea, $this->encoding); //'Windows-1252' , 'auto'

        // Verificar si se llegó al final del archivo
        if ($linea === false) {
            return false;
        }

        // Verificar si la línea está vacía
        if (empty(trim($linea))) {
            // Saltar a la siguiente iteración del bucle sin procesar la línea vacía
            // $this->readlines();
        }

        // Convertir la línea si está en formato de cadena de bytes
        try {
            $linea = fncConvertirCadenaBytes($linea);
        } catch (\Throwable $th) {
            //throw $th;
        }

        // Devolver la línea completa
        return $linea;
    }

    public function parseLine($line, $array = [])
    {
        // dd('parseLine');
        // if ($array) {
        //     dump($array);
        // }
        $arrayAsoc = [];

        $fields = fncExplode($line, $this->separadorCampos, $this->finLinea);

        $fields = $this->parseLine3($fields);
        // dd(['quitó fin de linea y caracter de string' => $fields]);
        try {
            foreach ($array as $key => $value) {
                if (isset($fields[$key])) {
                    $nombreCampo = key($array[$key]); // Obtenemos el nombre del campo
                    $tipoCampo = current($array[$key]); // Obtenemos el tipo del campo
                    $arrayAsoc[$nombreCampo] = fncTipoCampo($fields[$key], $tipoCampo);
                }
            }
            // dd(['arrayAsoc' => $arrayAsoc]);
            return $arrayAsoc;
        } catch (\Throwable $th) {
            dd($th);
            throw $th;
        }
        // dd(['asoció los datos' => $fields, $arrayAsoc]);

        return $fields;
    }
    public function parseLine3($fields)
    {
        foreach ($fields as &$field) {
            // quitar el caracter de string EXTRA
            $field = trim($field);
            $paso[] = str_replace($this->caracterString, '', $field);
        }
        // dd(['paso' => $paso]);
        return $paso;
    }

    public function determinarOpcionesPorDefecto()
    {
        $extension = pathinfo($this->filePath, PATHINFO_EXTENSION);

        switch ($extension) {
            case 'csv':
                $this->separadorCampos = ';';
                $this->caracterString = '"';
                $this->finLinea = "\r\n";
                $this->lineaEncabezados = 'Date;Libellé';
                break;
            case 'txt':
                $this->separadorCampos = '\t';
                $this->caracterString = '"';
                $this->finLinea = "\n";
                $this->lineaEncabezados = 'Date	Libellé';
                break;
            case 'tsv':
                $this->separadorCampos = '\t';
                $this->caracterString = '"';
                $this->finLinea = "\r\n";
                $this->lineaEncabezados = 'Date	Libellé';
                break;
            default:
                // Opciones por defecto en caso de extensión desconocida
                $this->separadorCampos = ';';
                $this->caracterString = '"';
                $this->finLinea = "\r\n";
                $this->lineaEncabezados = 'Date	Libellé';
                break;
        }
    }

    public function open($filePath)
    {
        // dump(realpath($filePath));

        if ($this->handle) {
            $this->close();
        }

        if (!empty($filePath)) {
            if (file_exists($filePath)) {
                // Obtener el tipo MIME del archivo
                $this->fileType = $this->getFileMimeType($filePath);

                $this->file = $filePath;
                $this->handle = fopen($this->file, 'r');

                if ($this->handle === false) {
                    // Error al abrir el archivo
                    throw new Exception('Error al abrir el archivo: ' . $filePath);
                }
            } else {
                // El archivo no existe
                throw new Exception('El archivo no existe: ' . $filePath);
            }
        } else {
            // La ruta del archivo está vacía
            throw new Exception('La ruta del archivo está vacía');
        }
    }

    public function close()
    {
        if ($this->handle) {
            fclose($this->handle);
            $this->handle = null;
            $this->file = null;
        }
    }

    protected function getFileMimeType($filePath)
    {
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $fileType = finfo_file($fileInfo, $filePath);
        finfo_close($fileInfo);

        return $fileType;
    }
}
