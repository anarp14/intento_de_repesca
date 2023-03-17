<?php

namespace App\Tablas;

use App\Tablas\Modelo;

class Etiqueta extends Modelo
{
    protected static string $tabla = 'etiquetas';

    public $id;
    public $etiqueta;

    public function __construct(array $campos)
    {
        $this->id = $campos['id'];
        $this->etiqueta = $campos['etiqueta'];
    }

}
