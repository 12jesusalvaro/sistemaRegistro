<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Deposito;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DatosVoucher implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $fecha= $row['fecha'];
        $fechaConGuiones = str_replace('/', '-', $fecha);
        $fechaFormateada = date("Y-m-d", strtotime($fechaConGuiones));

        return new Deposito([
            /*'id_tdeposito' => $row['id_tdeposito'],
            'id_tcomprobante' => $row['id_tcomprobante'],
            'serie' => $row['serie'],*/
            'numero' => $row['numero'],
            'operacion' => $row['operacion'],
            'importe' => $row['importe'],
            /*'id_moneda' => $row['id_moneda'],
            'tipo_cambio' => $row['tipo_cambio'],
            'id_concepto' => $row['id_concepto'],
            'id_tasa' => $row['id_tasa'],
            'id_usuario' => $row['id_usuario'],*/
            'codigo_usuario' => $row['cod_usuario'],
            /*'id_programa' => $row['id_programa'],
            'id_mencion' => $row['id_mencion'],*/
            'fecha' => $fechaFormateada,
            /*'fecha_registro' => $row['fecha_registro'],
            'disponible' => $row['disponible'],
            'notas' => $row['notas'],
            'cuenta' => $row['cuenta'],
            'id_sysuser' => $row['id_sysuser'],
            'ip_sysuser' => $row['ip_sysuser'],
            'id_impresion' => $row['id_impresion'],
            'id_estado' => $row['id_estado'],
            'id_oficio' => $row['id_oficio'],
            'id_agencia' => $row['id_agencia'],
            'conciliado' => $row['conciliado'],*/
            // ... Mapea otras columnas si es necesario
        ]);
    }

    public function delimiter(): string
    {
        return ','; // Establece el delimitador de coma
    }
}
