<?php

declare(strict_types = 1);

namespace Tests\Class;

use PHPUnit\Framework\TestCase;
use Helpers\BaseHelper;
use App\Class\Calculadora;
// Clase Calculadora importada en BaseHelper
//require_once './helpers/base.helper.php';

class CalculadoraTest extends TestCase {

    public $calc;

    public function setUp(): void
    {
        $this -> calc = new Calculadora();
    }

    public function testSumarDosNumeros() 
    {
        $this->assertEquals(5, $this -> calc -> sumar(2, 3), 'Debería sumar 2 + 3 = 5');
    }

    public function testSumarDosNumerosKO() 
    {
        $this->assertNotEquals(4, $this -> calc -> sumar(2, 3), 'No debería sumar 2 + 3 = 4');
    }
}