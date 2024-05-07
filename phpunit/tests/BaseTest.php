<?php

declare(strict_types = 1);

namespace Tests;
use PHPUnit\Framework\TestCase;
use Helpers\BaseHelper;

//require_once './helpers/base.helper.php';

class BaseTest extends TestCase {

	public static $conexion;
	public static $link;

	public static function setUpBeforeClass(): void{

		self::$conexion = BaseHelper::establecer_conexion();
		//print_r('Jarjar: ' . getenv('DB_HOST'));
		//print_r('Jarjar: ' . DB_HOST);
        //self::assertTrue( DB_HOST == 'localhost' || DB_HOST == '127.0.0.1', 'DB_HOST NO apunta a local. ' . DB_HOST );
	}

	public static function tearDownAfterClass(): void{

		self::$conexion = NULL;
	}

	public function setUp(): void {

		//$this -> assertTrue( BaseHelper::transaction_test(self::$conexion), 'La transacción de Test no se ha abierto' );
	}

	public function tearDown(): void {

		//$this -> assertTrue( BaseHelper::transaction_test_fin(self::$conexion), 'No se ha realizado el rollback de Test.' );

		//$this -> assertTrue( Helper::borrar_datos_test_guardado($this), 'Los datos del test no se han borrado de la bbdd.' );
	}


	public function test_date_dia_semana(){

		$fecha_mysql = '2019-11-06'; // Miercoles

		$dia = date( 'w', strtotime($fecha_mysql) );

		$this -> assertSame( '3', $dia, 'Debería ser 3 como string, por miércoles.' );

		$fecha_mysql = '2019-11-03'; // Domingo

		$dia = date( 'w', strtotime($fecha_mysql) );

		$this -> assertSame( '0', $dia, 'Debería ser 0 como string, por domingo.' );
	}

	public function test_dir(){

		$endDir = "api_phpunit\\phpunit\\tests";

		$this -> assertStringEndsWith($endDir, __DIR__, 'Debería devolver el directorio del archivo.' );
	}

	public function test_zlib_instalada(){

		$this -> assertTrue( function_exists('gzwrite'), 'La libreria Zlib no esta instalada.' );
	}


	public function test_minusculas(){

		$str = 'ÁvIla';

		$this -> assertNotSame('ávila', strtolower($str));
		$this -> assertSame('ávila', mb_strtolower($str));
	}


	public function test_switch(){

		$id_tipo = 7;

		switch( $id_tipo ){
			
			case 7:
			case 9:
				$arr_extras = array( '0' => 'aire_acondicionado', '1' => 'alarma', '3' => 'armarios_empotrados', '4' => 'ascensor', '23' => 'jardin', '30' => 'piscina', '37' => 'trastero', '39' => 'video_protero', '40' => 'camaras_seguridad');
				break;

			case ( $id_tipo == 4 || $id_tipo == 5 ):
				$arr_extras = array( '0' => 'aire_acondicionado', '1' => 'alarma', '3' => 'armarios_empotrados', '4' => 'ascensor', '23' => 'jardin', '30' => 'piscina', '37' => 'trastero', '39' => 'video_protero', '40' => 'camaras_seguridad');
				break;
		}

		$this -> assertNotNull( $arr_extras );
	}


	public function test_usort(){

		$arr = array('DP-1078', 'DP-43', 'DP-234');

		$func = function($a, $b){
			
			$val1 = (int) str_replace('DP-', '', $a);
			$val2 = (int) str_replace('DP-', '', $b);

			if( $val1 == $val2 ){ return 0;	}

			return $val1 < $val2 ? -1 : 1;
		};

		usort($arr, $func);

		$this -> assertSame( 'DP-43', $arr[0], 'Debería haber ordenado primero el DP menor.' );
	}


	public function test_mayor_que_0()
	{

		$this -> assertTrue( 2 > 0, 'El entero debería ser mayor que 0.' );

		$this -> assertTrue( '2' > 0, 'El string de número debería ser mayor que 0.' );

		$this -> assertTrue( 'abc' > 0, 'El string de letras debería ser mayor que 0.' );
	}


	public function test_preg_match()
	{

		$url = 'https://www.idealista.com/login-email.htm?adId=000000&lang=es&uri=index.htm&ident=fDFPmM0oyvStBg5YkQEMMC7l9kLDX8%2BDMmZSZV5PAeLfjoihZY%2FN4yGyFz7sdcii72l3b7jILCWR%0A455F7PwhDSnLrqliuhR%2B&xts=582065&xtor=EPR-201-[express_alerts_20190607]-20190607-[inmueble_28_77.000]-[]-20190607103902';

		preg_match( '/(adId=\d+&)/', $url, $adId );

		$this->assertMatchesRegularExpression('/^adId=\d+&$/', $adId[1], 'Debería tener la adId de la url.' );
	}


	public function test_array_merge(){

		$array1    = array("color" => "red", 2, 4);
		$array2    = array("a", "b", "color" => "green", "shape" => "trapezoid", 4);
		$arr_merge = array_merge($array1, $array2);

		$res = array(
			'color' => 'green',
			'0' => 2,
			'1' => 4,
			'2' => 'a',
			'3' => 'b',
			'shape' => 'trapezoid',
			'4' => 4,
		);

		$this -> assertSame($res, $arr_merge, 'Debería ser el mismo array.' );
	}

}
