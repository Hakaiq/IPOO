<?php

class Pasajero
{
    private $nombre;
    private $apellido;
    private $numeroDocumento;
    private $telefono;

    public function __construct($nombre, $apellido, $numeroDocumento, $telefono)
    {
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->numeroDocumento = $numeroDocumento;
        $this->telefono = $telefono;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setNumeroDocumento($numeroDocumento)
    {
        $this->numeroDocumento = $numeroDocumento;
    }

    public function getNumeroDocumento()
    {
        return $this->numeroDocumento;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function __toString()
    {
        $cadena = "\n------------Pasajero-------------" .
            "\nNombre: " . $this->getNombre() .
            "\nApellido: " . $this->getApellido() .
            "\nNumero de Documento: " . $this->getNumeroDocumento() .
            "\nNumero de Telefono: " . $this->getTelefono();
        return $cadena;
    }
}
