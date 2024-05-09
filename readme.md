# Readme
Test de PHPUnit y codeception, creada con composer.
Actualizada para dar soporte de Jenkins

## Instalacion
  - Desde la carpeta phpunit, ejecutar en consola `composer install`.
  - Desde la carpeta codeception, ejecutar en consola `composer install`.
  - Ejecutar los tests con `composer run test`.

## Ejecución
  - Desde la carpeta root de la suite, ejecutar en consola (Ajustar el total de las suites en phpunit-xml, etiqueta testsuites):
    - Todas las suites: `phpunit`
    - Solo una clase: `phpunit tests/path/a/ClaseTest.php`
    - Solo un test: `phpunit tests/path/a/ClaseTest.php --filter test_a_probar`

  - Ver [Codeception Docs](https://codeception.com/docs/reference/Commands) para saber ejecutar los test

### Jenkins
  - Instalar Jenkins en tu sistema y configurar proyecto MultiBranch Pipeline sobre este repositorio
  - Realiza un build del proyecto

### Flags
Flags para ejecutar desde la consola:
  - `--testdox`: Muestra en consola una relacion de los tests de la suite.
  - `--filter`: Ejecuta el test que se corresponda con el nombre (si hay varios en distintos archivos los ejecutará, asi como los tests que comiencen por el mismo nombre).
Ver mas flags con `phpunit -h`
