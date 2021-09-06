# Readme
Test de PHPUnit. Suite creada con composer.
[Docs](https://phpunit.readthedocs.io/en/9.5/textui.html)

# Creación
  - Crea el archivo composer.json
  - Ejecuta `composer require --dev phpunit/phpunit`: Dependencia principal
  - Ejecuta `composer require --dev nelmio/alice`: Dependencia de mocks 
  - Ejecuta `composer require --dev fzaninotto/faker`: Dependencia de semillas

## Instalacion
  - Ejecutar en consola `composer install`.

## Ejecución
  - Desde la carpeta root de la suite, ejecutar en consola (Ajustar el total de las suites en phpunit-xml, etiqueta testsuites):
    - Todas las suites: `phpunit`
    - Solo una clase: `phpunit tests/path/a/ClaseTest.php`
    - Solo un test: `phpunit tests/path/a/ClaseTest.php --filter test_a_probar`

### Flags
Flags para ejecutar desde la consola:
  - `--testdox`: Muestra en consola una relacion de los tests de la suite.
  - `--filter`: Ejecuta el test que se corresponda con el nombre (si hay varios en distintos archivos los ejecutará, asi como los tests que comiencen por el mismo nombre).
Ver mas flags con `phpunit -h`
