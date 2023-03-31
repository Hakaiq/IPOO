<?php
include "Viaje.php";

/**
 * Muestra por pantalla las opciones del menu principal
 */
function mostrarMenuPrincipal()
{
    echo "------------Menu-------------:
        1) Cargar informacion del viaje.
        2) Modificar datos del viaje.
        3) Ver datos del viaje.
        4) Cargar informacion de prueba.
        0) Salir.
    Elija una opcion: ";
}

/**
 * Muestra por pantalla las opciones del menu de modificaciones
 */
function mostrarMenuModificaciones()
{
    echo "------------Modificaciones-------------:
        1) Cambiar codigo.
        2) Cambiar destino.
        3) Cambiar cantidad maxima de pasajeros.
        4) Cambiar informacion de pasajeros.
        0) Volver a menu principal.
    Elija una opcion: ";
}

function modificaciones($viaje)
{
    do {
        mostrarMenuModificaciones();
        $opcion = trim(fgets(STDIN));
        switch ($opcion) {
            case 1: //Cambiar codigo
                echo "Ingrese el nuevo codigo: ";
                $nuevoCodigo = trim(fgets(STDIN));
                $viaje->setCodigo($nuevoCodigo);
                break;
            case 2: //Cambiar destino
                echo "Ingrese el nuevo destino: ";
                $nuevoDestino = trim(fgets(STDIN));
                $viaje->setDestino($nuevoDestino);
                break;
            case 3: //Cambiar cantidad maxima de pasajeros
                echo "Ingrese la nueva cantidad maxima: ";
                $nuevaCant = trim(fgets(STDIN));
                $viaje->setCantMaxPasajeros($nuevaCant);
                break;
            case 4: //Cambiar informacion de pasajeros
                echo "    1) Cambiar todos los pasajeros.
                2)Cambiar la informacion de un pasajero segun su documento.
                Elija una opcion: ";
                $rta = trim(fgets(STDIN));
                if($rta==1){//Modifica todo el array de pasajeros
                    $nuevoArrayPasajeros = cargarPasajeros($viaje->getCantMaxPasajeros());
                    $viaje->setPasajeros($nuevoArrayPasajeros);
                } elseif ($rta == 2){ //Modifica un pasajero especifico
                    modificarUnPasajero($viaje);
                } else {
                    echo "Opcion incorrecta.\n";
                }
                break;
            case 0;
                break;
            default:
                echo "Opcion incorrecta.\n";
        }
    } while ($opcion != 0);
}

/**
 * Funcion que pide los datos de los pasajeros hasta que el usuario quiera parar o se llegue a la cantidad maxima de pasajeros
 * y retorna un arreglo multidimensional que contiene los datos ingresados.
 * @param int $cantMax
 * @return array
 */
function cargarPasajeros($cantMax)
{
    $i = 0;
    $array = [];
    $seguir = true;
    do {
        echo "Ingrese los datos de los pasajeros:\n";
        echo "Nombre: ";
        $nombre = trim(fgets(STDIN));
        echo "Apellido: ";
        $apellido = trim(fgets(STDIN));
        echo "Documento: ";
        $doc = trim(fgets(STDIN));
        $array[$i] = [
            "nombre" => $nombre,
            "apellido" => $apellido,
            "documento" => $doc
        ];
        $i++;
        echo "Desea insertar otro pasajero? (s/n): ";
        $rta = trim(fgets(STDIN));
        if ($rta == "n") {
            $seguir = false;
        }
        if ($i == $cantMax) {
            echo "Limite de pasajeros alcanzado, no se pueden agregar mas.\n";
            $seguir = false;
        }
    } while ($seguir);
    return $array;
}

$arrayPasajerosPrueba = [
    ["nombre" => "Graciela", "apellido" => "Mendez", "documento" => 42969186],
    ["nombre" => "Ester", "apellido" => "Cross", "documento" => 22349753],
    ["nombre" => "Maria", "apellido" => "Fill", "documento" => 31794186],
    ["nombre" => "Simon", "apellido" => "Gartel", "documento" => 49148531],
    ["nombre" => "Roberto", "apellido" => "Pautemon", "documento" => 20486153],
    ["nombre" => "Walter", "apellido" => "Casemiro", "documento" => 46750275]
];


    /**
     * Funcion que pide el documento de un pasajero a modificar, en caso de que exista en el array se ofrecen opciones para cambiar sus datos,
     * se pide el nuevo valor a asignar y se actualiza el dato, en caso de que no exista se muestra un mensaje de error.
     */
     function modificarUnPasajero($viaje)
    {
        echo "Ingrese el documento del pasajero que desea modificar: ";
        $doc = trim(fgets(STDIN));
        $posPasajero = $viaje -> buscarPasajeroPorDocumento($doc);
        if ($posPasajero == -1) {
            echo "No se ha encontrado un pasajero con el documento n°: " . $doc . ".\n";
        } else {
            do {
                echo "Dato a modificar: 
                    1) Nombre.
                    2) Apellido. 
                    3) Documento.
                    0) Volver atras.
                Elija una opcion: ";
                $opcion = trim(fgets(STDIN));
                switch ($opcion) {
                    case 1:
                        echo "Ingrese el nuevo nombre: ";
                        $nuevoNombre = trim(fgets(STDIN));
                        $viaje -> getPasajeros()[$posPasajero]["nombre"] = $nuevoNombre;                       
                        break;
                    case 2:
                        echo "Ingrese el nuevo apellido: ";
                        $nuevoApellido = trim(fgets(STDIN));
                        $viaje -> getPasajeros()[$posPasajero]["apellido"] = $nuevoApellido;
                        break;
                    case 3:
                        echo "Ingrese el nuevo documento: ";
                        $nuevoDoc = trim(fgets(STDIN));
                        $viaje -> getPasajeros()[$posPasajero]["documento"] = $nuevoDoc;
                        break;
                    case 0:
                        break;
                    default:
                        echo "Opcion incorrecta.\n";
                }
            } while ($opcion != 0);
        }
    }

do {

    mostrarMenuPrincipal();
    $opcion = trim(fgets(STDIN));

    switch ($opcion) {
        case 1: //Cargar datos del viaje
            echo "Ingrese el codigo del viaje: ";
            $codigo = trim(fgets(STDIN));
            echo "Ingrese el destino: ";
            $destino = trim(fgets(STDIN));
            echo "Ingrese la cantidad maxima de pasajeros: ";
            $cantMax = trim(fgets(STDIN));
            $pasajeros = cargarPasajeros($cantMax);
            $viaje = new Viaje($codigo, $destino, $cantMax, $pasajeros);
            break;
        case 2: //Modificar datos
            if(isset($viaje)){
                modificaciones($viaje);
            } else {
                echo "Todavia no se han cargado datos al viaje.\n";
            }
            
            break;
        case 3:
            if(isset($viaje)){
                echo $viaje;
            } else {
                echo "Todavia no se han cargado datos al viaje.\n";
            }
            break;
        case 4:
            $viaje = new Viaje(1, "Cordoba", 10, $arrayPasajerosPrueba);
            echo "Datos de prueba cargados.\n";
            break;
        case 0:
            break;
        default:
            echo "Opcion incorrecta.\n";
    }
} while ($opcion != 0);