<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://cdn.icon-icons.com/icons2/1727/PNG/512/3986728-online-shop-store-store-icon_112980.png" width="100"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework#v9.19.0"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Version used"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Sistema de Compras, control de stock de inventario y ventas [Backend-PHP & Frontend-Blade]

Para poder ejecutar este sistema de manera adecuada se requiere:

- Entorno de manejo de paquetes de Javascript [Node v18^](https://nodejs.org/en).
- Composer es un sistema de gestión de paquetes para programar en PHP [Composer v2.8^](https://getcomposer.org/).
- Base de datos [MySQL v8.1^](https://dev.mysql.com/downloads/mysql/).
- Un lenguaje de programación de uso general muy popular [PHP v3.1.10^](https://www.php.net/downloads)

Se deben seguir las siguientes intrucciones:

## Instalación
- Clonar el repositorio con :
```
git clone "https://github.com/alejandro-cn-dev/PrototypeProject_01"
```
-  Abrir la carpeta con Visual Studio Code
-  Cambiar el nombre de '.env.example' a '.env'
-  usar ventana de comandos (CMD) dentro de la carpeta del proyecto y ejecutar:
```
composer install
```
-  Luego, en esa misma consola, ejecutar:
```
php artisan key:generate 
```
-  usar ventana de comandos (CMD) dentro de la carpeta del proyecto y ejecutar:
```
composer install
```
-  Después ejecutar:
```
npm install
```
-  Luego, ejecutar:
```
npm run build
```
-  Para luego poder acceder a imagenes desde el proyecto, ejecutar:
```
php artisan storage:link
```
-  Ejecutar:
```
php artisan optimize:clear
```
## Base de datos
-  Debe crear una nueva base de datos con el nombre: 'wms_websystem_01'
-  Para cargar el sistema con información básica, se debe llenar la base de datos con el comando
```
php artisan migrate
```
-  Para poner en marcha el sistema, ejecutar:
```
php artisan serve
```

## Copia de seguridad
Adicionalmente, se pueden hacer copias de seguridad de la base de datos mediante la librería Spatie-Backup, debe ejecutar:
```
php artisan backup:run --only-db --disable-notifications
```
Las copias se almacenan en:
```
%project_folder%\storage\app\Laravel
```


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
