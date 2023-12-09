<# Sistema Turjoy
Turjoy es una empresa especializada en la venta de pasajes de autobús, y para facilitar este proceso, se ha desarrollado un sistema eficiente.

TurjoyWeb es una plataforma que simplifica la reserva de pasajes de autobús, permitiendo a nuestros clientes reservar y buscar viajes de manera eficiente mediante un código proporcionado.

El sistema incluye un sofisticado panel administrativo diseñado para brindar a Turjoy un control total sobre los viajes disponibles y ofrecer la capacidad de generar un reporte detallado sobre las reservas realizadas.
 
Este panel administrativo proporciona a la empresa una herramienta integral para gestionar y optimizar la disponibilidad de viajes, así como para obtener una visión clara y actualizada de todas las reservas efectuadas. Con funcionalidades intuitivas y una interfaz fácil de usar, el sistema facilita la administración diaria de las operaciones de Turjoy, permitiendo un flujo de trabajo eficiente y una atención al cliente de alta calidad.

## Panel Administrativo

Puedes acceder al panel administrativo utilizando las siguientes credenciales predeterminadas:
- Usuario: italo@ucn.cl
- Contraseña: Turjoy91

Tecnologías Utilizadas
================================================================================================================
Hemos seleccionado cuidadosamente las siguientes tecnologías para garantizar un desarrollo eficiente y escalable:

Base de Datos:
- MySQL Workbench
  
Backend y Frontend:
- Laravel 10
  


Descarga del proyecto
================================================================================================================
## Programas a instalar
Antes de comenzar, asegúrate de tener instalados los siguientes programas:

Instala [GIT](https://git-scm.com/downloads)

Instala [XAMPP](https://www.apachefriends.org/es/index.html) con PHP V8.1.

Instala [Composer](https://getcomposer.org/download/) V2.6.5.

Instala [Nodejs](https://nodejs.org/en) V18.17.

Luego de instalado los programas, deber abrir XAMPP Control Panel, ahí debes presionar el boton "config" de Apache y luego seleciona la opcion "PHP (php.ini)", esta abrira un .txt en el cual buscaras "extension=zip", a este le borras el ";" que se encuentra delante.

Todo esto es para habilitar la instalacion del composer desde la misma maquina, evitando que tenga que descargarlo directamente de internet.

Luego guardas el .txt y continuas con los siguientes pasos.

- Clona este repositorio en tu máquina local: 

		git clone https://github.com/Eltosergi/TurjoyWeb


## Instalación de dependencias

Ejecuta estos comandos en una terminal en el siguiente orden para instalar las dependencias y configurar el proyecto:
```bash

cd TurjoyWeb

composer install

npm install

copy .env.example .env

php artisan key:generate

composer dump-autoload

```
Después de copiar el archivo .env.example a .env, configura las siguientes variables:
- DB_PORT: Puerto de la base de datos (por defecto 3306).
- DB_DATABASE: Nombre de la base de datos.
- DB_PASSWORD: Contraseña del proveedor de la base.

Antes de ejecutar las migraciones, asegúrate de tener un entorno de base de datos MySQL activo.

Luego continua con estas instrucciones:
```bash

php artisan migrate

php artisan db:seed

php artisan serve
```
Al utilizar el comando php artisan serve, debe de aceptar el crear una nueva base de datos con el nombre ingresado en las preferencias del .ENV, teclear "y" y presionar enter.
La url del backend deberia de desplegarse en la terminal.

espués de ejecutar `php artisan serve`, puedes acceder a la aplicación web desde la URL generada en la terminal.
