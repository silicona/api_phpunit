<?php
declare(strict_types = 1);
use PHPUnit\Framework\TestCase;
require_once './helpers/base.helper.php';

class BaseTest extends TestCase {

	public static $conexion;
	public static $link;

	public static function setUpBeforeClass(): void{

		self::$conexion = BaseHelper::establecer_conexion(DB_HOST);
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

		$directorio = "/Users/nadies/typescript/api-phpunit/tests";

		$this -> assertSame( $directorio, __DIR__, 'Debería devolver el directorio del archivo.' );
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


	public function test_usort_dps(){

		$arr = array('DP-1078', 'DP-43', 'DP-234');

		function ordenar_arr_dps($a, $b){
			
			$val1 = (int) str_replace('DP-', '', $a);
			$val2 = (int) str_replace('DP-', '', $b);

			if( $val1 == $val2 ){ return 0;	}

			return $val1 < $val2 ? -1 : 1;
		}

		usort($arr, 'ordenar_arr_dps');
		//print_r($arr);
		$this -> assertSame( 'DP-43', $arr[0], 'Debería haber ordenado primero el DP menor.' );
	}


	public function test_mayor_que_0(){

		$id = 2;

		$this -> assertTrue( 2 > 0, 'El entero debería ser mayor que 0.' );

		$this -> assertTrue( '2' > 0, 'El string de número debería ser mayor que 0.' );

		$this -> assertFalse( 'abc' > 0, 'El string de letras no debería ser mayor que 0.' );
	}


	public function test_preg_match(){

		$url = 'https://www.idealista.com/login-email.htm?adId=85799834&lang=es&uri=index.htm&ident=fDFPmM0oyvStBg5YkQEMMC7l9kLDX8%2BDMmZSZV5PAeLfjoihZY%2FN4yGyFz7sdcii72l3b7jILCWR%0A455F7PwhDSnLrqliuhR%2B&xts=582065&xtor=EPR-201-[express_alerts_20190607]-20190607-[inmueble_28_77.000]-[]-20190607103902';

		preg_match( '/(adId=\d+&)/', $url, $adId );

		$this -> assertRegExp('/^adId=\d+&$/', $adId[1], 'Debería tener la adId de la url.' );

		/*
		$res = parse_url($url);
		parse_str($res['query'], $arr_res);

		print_r($arr_res['adId']);*/

		//print_r($res);
	}


	public function test_array_merge(){

		$array1    = array("color" => "red", 2, 4);
		$array2    = array("a", "b", "color" => "green", "shape" => "trapezoid", 4);
		$arr_merge = array_merge($array1, $array2);
		//print_r($resultado);

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

	/*
	public function test_sql_regexp(){


		$link = self::$conexion;
		$id_municipio = 1;
		$param = implode( ' ', array(
			'ausente = 0',
			'AND activo = 1',
			'AND id_delegacion > 0',
		) );

		$param_no = $param . ' AND disponible_zonas NOT REGEXP "(^|,)' . $id_municipio . '(,|$)"';
		$del_no = Helper::suministra_entidad_bbdd($link, 'asociado', $param_no);

		$param_si = $param . ' AND disponible_zonas REGEXP "(^|,)' . $id_municipio . '(,|$)"';
		$del_si = Helper::suministra_entidad_bbdd($link, 'asociado', $param_si);
 
		$sql = 'SELECT DISTINCT id_asociado FROM 4887_asociados
							WHERE activo = 1
								AND ausente = 0
								AND id_delegacion > 0
								AND disponible_zonas REGEXP "(^|,)' . $id_municipio . '(,|$)"';

		$res = mysqli_query($link, $sql);
		$arr_del = array();
		while( $e = mysqli_fetch_assoc($res) ){

			$arr_del[] = $e['id_asociado'];

			//print_r($e['id_asociado'] . "\n");
			//$this -> assertTrue( $e['id_asociado'] == 60, 'Ook' );
		}

		$this -> assertTrue( in_array($del_si -> id_asociado, $arr_del), 'Delegado Si debería estar en arr_del.' );

		$this -> assertFalse( in_array($del_no -> id_asociado, $arr_del), 'Delegado No no debería estar en arr_del.' );
	}
	*/
}
