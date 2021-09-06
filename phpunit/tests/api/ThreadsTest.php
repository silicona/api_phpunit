<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once './helpers/base.helper.php';

class ThreadsTest extends TestCase
{
    public function setUp(): void {
        $this -> threader = new ThreadController();
    }

    public function testSeguimientoDeHilos(): void
    {
        $this -> markTestIncomplete('Necesaria función pcntl_fork de php para ejecutarlo');
        /*
        define('MY_PATH', '/var/www/truckenin');
        include(MY_PATH . '/config/config.php');
        include(MY_PATH . '/class/Controller.php');
        */
        $fp = array();

        # Registra el inicio del proceso padre.
        /*
        if (MODE_WRITE) {
            $fp["father"] = fopen(MY_PATH . "/logs/father-day-" . date("d") . ".log", "a");
            fwrite($fp["father"], "> Begin father: " . date("Y-m-d H:i:s ") . "\r\n");
        }
        # Abrir la conexión a la base de datos
        $mysqli = new PDO(MY_TYPE . ':host=' . MY_HOST . ';dbname=' . MY_BDD . ';charset=' . MY_CHARSET, MY_USER, MY_PASS);

        # Obtener los camiones de la base de datos
        $controller = new Controller();
        $truck_enabled = $controller->get_trucks();
        
        # Cerrar la conexión a la base de datos
        unset($mysqli);
        */
        $fp["father"] = array("> Begin father: " . date("Y-m-d H:i:s "));

        $trucks = ["uno", "dos", " tres"];

        foreach ($trucks as $key => $truck) {

            $pids = null;

            # Comprobar que el proceso para el camión no esté activo
            exec("ps aux | grep -i 'truck-" . $key . "i' | grep -v grep", $pids);
            if (!empty($pids)) continue;
            $fp[$truck] = Array();

            # Registrar que se crea un proceso paralelo
            //fwrite($fp["father"], "> Create truck -> truck-" . $key . "i : " . date("Y-m-d H:i:s ") . "\r\n");
            $fp["father"][] = "> Create truck -> truck-" . $key . "i : " . date("Y-m-d H:i:s ");

            # Se crea el proceso hijo
            //$pid = pcntl_fork();
            $pid = $this->threader -> fork();

            if (!$pid) {

                # Se pone el nombre el proceso hijo
                cli_set_process_title("truck-" . $key . "i");
                
                $fp[$truck][] = "> Execution: " . date("Y-m-d H:i:s ");

                /*
                # Abrir la conexión a la base de datos
                $mysqli = new PDO(MY_TYPE . ':host=' . MY_HOST . ';dbname=' . MY_BDD . ';charset=' . MY_CHARSET, MY_USER, MY_PASS);

                # Registrar el inicio del camión
                if (MODE_WRITE) {
                    $fp[$key] = fopen(MY_PATH . "/logs/truck-" . $key . "-day-" . date("d") . ".log", "a");
                    fwrite($fp[$key], "> Execution: " . date("Y-m-d H:i:s ") . "\r\n");
                }

                ## MAIN ##

                ## END MAIN ##

                # Cerrar conexión 
                unset($mysqli);

                # Registrar el final del camión
                if (MODE_WRITE) {
                    fwrite($fp[$key], "> End: " . date("Y-m-d H:i:s ") . "\r\n");
                    fwrite($fp[$key], "  ------------------------------------------" . "\r\n");
                    fclose($fp[$key]);
                }
                */

                # Matar el proceso hijo
                exit;
            }
        }
        /*
        # Registrar el final del proceso padre.
        if (MODE_WRITE) {
            fwrite($fp["father"], "> End: " . date("Y-m-d H:i:s ") . "\r\n");
            fwrite($fp["father"], "  ------------------------------------------" . "\r\n");
            fclose($fp["father"]);
        }
        */

        print(implode("\n", $fp["father"]));
        print(implode("\n", $fp["uno"]));
        print(implode("\n", $fp["dos"]));
        print(implode("\n", $fp["tres"]));
        

        
    }
}
