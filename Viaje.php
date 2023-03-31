<?php

class Viaje
{
    private $codigo;
    private $destino;
    private $cantMaximaPasajeros;
    private $pasajeros;

    //Metodo constructor
    public function __construct($codigo, $destino, $cantMax, $pasajeros)
    {
        $this->codigo = $codigo;
        $this->destino = $destino;
        $this->cantMaximaPasajeros = $cantMax;
        $this->pasajeros = $pasajeros;
    }

    //Metodos de acceso
    public function getCodigo()
    {
        return $this->codigo;
    }
    public function getDestino()
    {
        return $this->destino;
    }
    public function getCantMaxPasajeros()
    {
        return $this->cantMaximaPasajeros;
    }
    public function getPasajeros()
    {
        return $this->pasajeros;
    }

    public function setCodigo($valor)
    {
        $this->codigo = $valor;
    }
    public function setDestino($valor)
    {
        $this->destino = $valor;
    }
    public function setCantMaxPasajeros($valor)
    {
        $this->cantMaximaPasajeros = $valor;
    }
    public function setPasajeros($valor)
    {
        $this->pasajeros = $valor;
    }

    /**
     * Funcion que dado un dni busca el pasajero cuyo dni coincida y retorna la posicion del array de pasajeros donde se encuentra.
     * En caso de no encontrarlo se retorna -1
     * @param int $dniPasajero
     * @return int
     */
    public function buscarPasajeroPorDocumento($docPasajero)
    {
        $pos = 0;
        $largoArreglo = sizeOf($this->getPasajeros());
        $encontrado = false;
        while ($pos < $largoArreglo && !$encontrado) {
            if ($this->getPasajeros()[$pos]["documento"] == $docPasajero) {
                $encontrado = true;
            } else {
                $pos++;
            }
        }
        if (!$encontrado) {
            $pos = -1;
        }
        return $pos;
    }


    /**
     * Funcion que retorna una cadena de texto con todos los atributos del objeto
     * @return String
     */
    public function __toString()
    {
        $cadena = "Codigo: " . $this->getCodigo() .
            "\nDestino: " . $this->getDestino() .
            "\nCantidad maxima de pasajeros: " . $this->getCantMaxPasajeros() .
            "\nPasajeros:";
        if ($this->getPasajeros() == null) {
            $cadena = $cadena . "No hay pasajeros.\n";
        } else {
            foreach ($this->getPasajeros() as $pasajero) {
                $infoPasajero = "Nombre: " . $pasajero["nombre"] . ". Apellido: " . $pasajero["apellido"] . ". Nro Documento: " . $pasajero["documento"] . "\n";
                $cadena = $cadena . $infoPasajero;
            }
        }
        return $cadena;
    }
}
