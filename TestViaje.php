<?php
include "Viaje.php";

/**
 * Muestra por pantalla las opciones del menu principal
 */
function mostrarMenuPrincipal()
{
    echo "\n------------Menu-------------:
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
                2) Cambiar la informacion de un pasajero segun su documento.
                Elija una opcion: ";
                $rta = trim(fgets(STDIN));
                if ($rta == 1) { //Modifica todo el array de pasajeros
                    $nuevoArrayPasajeros = cargarPasajeros($viaje->getCantMaxPasajeros());
                    $viaje->setPasajeros($nuevoArrayPasajeros);
                } elseif ($rta == 2) { //Modifica un pasajero especifico
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


$arrayPasajerosPrueba = [
    new Pasajero("Graciela", "Mendez", 42969186, 52453541),
    new Pasajero("Ester", "Cross", 22349753, 80123483),
    new Pasajero("Maria", "Fill", 31794186, 982344433),
    new Pasajero("Simon", "Gartel", 49148531, 143356774),
    new Pasajero("Roberto", "Pautemon", 20486153, 114156764),
    new Pasajero("Walter", "Casemiro", 46750275, 114451312),
];

$responsablePrueba =  new ResponsableV(1110, 88837, 'Carlos', 'Timba');

/**
 * Funcion que carga los pasajeros
 */
function cargarPasajeros($cantMax)
{
    $i = 0;
    $seguir = true;
    do {
        echo "Ingrese los datos de los pasajeros:\n";
        echo "Nombre: ";
        $nombre = trim(fgets(STDIN));
        echo "Apellido: ";
        $apellido = trim(fgets(STDIN));
        echo "Documento: ";
        $doc = trim(fgets(STDIN));
        echo 'Numero de Telefono: ';
        $tel = trim(fgets(STDIN));
        $array[$i] = new Pasajero($nombre, $apellido, $doc, $tel);
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

function cargarResponsable()
{
    echo 'Ingrese los datos del responsable del viaje: ';
    echo "Nombre: ";
    $nombre = trim(fgets(STDIN));
    echo "Apellido: ";
    $apellido = trim(fgets(STDIN));
    echo "Numero de empleado : ";
    $empleado = trim(fgets(STDIN));
    echo 'Numero de Licencia: ';
    $lic = trim(fgets(STDIN));

    return new ResponsableV($nombre, $apellido, $empleado, $lic);
}
/**
 * Funcion que pide el documento de un pasajero a modificar, en caso de que exista en el array se ofrecen opciones para cambiar sus datos,
 * se pide el nuevo valor a asignar y se actualiza el dato, en caso de que no exista se muestra un mensaje de error.
 */
function modificarUnPasajero($viaje)
{
    echo "Ingrese el documento del pasajero que desea modificar: ";
    $doc = trim(fgets(STDIN));
    $posPasajero = $viaje->buscarPasajeroPorDocumento($doc);
    if ($posPasajero == -1) {
        echo "No se ha encontrado un pasajero con el documento n°: " . $doc . ".\n";
    } else {
        do {
            echo "Dato a modificar: 
                    1) Nombre.
                    2) Apellido. 
                    3) Documento.
                    4) Telefono.
                    0) Volver atras.
                Elija una opcion: ";
            $opcion = trim(fgets(STDIN));
            switch ($opcion) {
                case 1:
                    echo "Ingrese el nuevo nombre: ";
                    $nuevoNombre = trim(fgets(STDIN));
                    $viaje->getPasajeros()[$posPasajero]->setNombre($nuevoNombre);
                    break;
                case 2:
                    echo "Ingrese el nuevo apellido: ";
                    $nuevoApellido = trim(fgets(STDIN));
                    $viaje->getPasajeros()[$posPasajero]->setApellido($nuevoApellido);
                    break;
                case 3:
                    echo "Ingrese el nuevo documento: ";
                    $nuevoDoc = trim(fgets(STDIN));
                    $viaje->getPasajeros()[$posPasajero]->setNumeroDocumento($nuevoDoc);
                    break;

                case 4:
                    echo 'Ingrese el nuevo telefono: ';
                    $nuevoTel = trim(fgets(STDIN));
                    $viaje->getPasajeros()[$posPasajero]->setTelefono($nuevoTel);
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
            $resp = cargarResponsable();
            $viaje = new Viaje($codigo, $destino, $cantMax, $pasajeros, $resp);
            break;
        case 2: //Modificar datos
            if (isset($viaje)) {
                modificaciones($viaje);
            } else {
                echo "Todavia no se han cargado datos al viaje.\n";
            }

            break;
        case 3:
            if (isset($viaje)) {
                echo $viaje;
            } else {
                echo "Todavia no se han cargado datos al viaje.\n";
            }
            break;
        case 4:
            $viaje = new Viaje(76851, "Cordoba", 10, $arrayPasajerosPrueba, $responsablePrueba);
            echo "Datos de prueba cargados.\n";
            break;
        case 0:
            break;
        default:
            echo "Opcion incorrecta.\n";
    }
} while ($opcion != 0);
