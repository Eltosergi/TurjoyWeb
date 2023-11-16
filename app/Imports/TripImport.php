<?php

namespace App\Imports;

use App\Models\Trip;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Session;

class TripImport implements ToCollection, WithHeadingRow
{
    protected $validRows = [];
    protected $invalidRows = [];
    protected $duplicatedRows = [];
    protected $existingOriginsDestinations = [];
    const ORIGIN_COLUMN = 'origen';
    const DESTINATION_COLUMN = 'destino';
    const SEATS_COLUMN = 'cantidad_de_asientos';
    const BASE_RATE_COLUMN = 'tarifa_base';

    /**
     * Importar una colección de filas desde el archivo Excel.
     *
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {        
        foreach ($rows as $row) {
            try{
            $origin = $row[self::ORIGIN_COLUMN];
            $destination = $row[self::DESTINATION_COLUMN];
            $baseRate = $row[self::BASE_RATE_COLUMN];
            $seats = $row[self::SEATS_COLUMN];
            }
           catch(\Exception $e)
           {
                Session::flash('error');
                return;
           }
            // Validación: Verifica si la combinación origen y destino ya existe en el archivo
            if ($this->hasDuplicateOriginDestination($origin, $destination)) {
                // Si ya existe, marca la fila como duplicada
                $this->duplicatedRows[] = $row;
            } else {

                // Validación: Verifica que los campos "orige" "destino" "stock" y "mount" sean numéricos y requeridos.
                if (isset($row['origen']) && isset($row['destino']) && isset($row['cantidad_de_asientos']) && isset($row['tarifa_base']) && is_numeric($row['cantidad_de_asientos']) && is_numeric($row['tarifa_base']) && $row['tarifa_base'] > 0 && $row['cantidad_de_asientos'] > 0){
                    // Filas válidas
                    $this->validRows[] = $row;
                    // Registra la combinación origen y destino
                    $this->existingOriginsDestinations[] = $origin . '-' . $destination;
                } else {
                    // Filas inválidas
                    $this->invalidRows[] = $row;
                }
            }
        }
    
    }

    /**
     * Verifica si la combinación origen y destino ya existe en el archivo.
     *
     * @param string $origin
     * @param string $destination
     * @return bool
     */
    private function hasDuplicateOriginDestination($origin, $destination)
    {
        $key = $origin . '-' . $destination;
        return in_array($key, $this->existingOriginsDestinations);
    }

    /**
     * Obtener filas válidas.
     *
     * @return array
     */
    public function getValidRows()
    {
        return $this->validRows;
    }

    /**
     * Obtener filas inválidas.
     *
     * @return array
     */
    public function getInvalidRows()
    {
        return $this->invalidRows;
    }

    /**
     * Obtener filas duplicadas.
     *
     * @return array
     */
    public function getDuplicatedRows()
    {   
        return $this->duplicatedRows;
    }
    private function hasRequiredColumns(Collection $rows)
{
    $requiredColumns = [self::ORIGIN_COLUMN, self::DESTINATION_COLUMN, self::SEATS_COLUMN, self::BASE_RATE_COLUMN];

    foreach ($requiredColumns as $column) {
        if (!$rows->first()->has($column)) {
            return false;
        }
    }

    return true;
}

private function handleImportError($errorMessage)
{
    // Aquí puedes utilizar tu MyHelper o simplemente lanzar una excepción, según tus necesidades
    // Ejemplo usando MyHelper:
    makeMessages($errorMessage);

    // Si prefieres lanzar una excepción:
    // throw new \Exception($errorMessage);
}
}