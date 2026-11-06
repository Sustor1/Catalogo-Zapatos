# Zapatería | Administración

Aplicación web para administrar el catálogo de una zapatería. Permite registrar, consultar, editar y eliminar zapatos (CRUD), buscar por marca o modelo, filtrar por categoría y ver indicadores del inventario: total de zapatos, productos con pocas existencias (5 o menos) y productos agotados (0 existencias).

Proyecto desarrollado como prueba técnica.

## Tecnologías utilizadas

- **Backend:** Laravel 12 (PHP 8.2 o superior)
- **Base de datos:** MySQL / MariaDB
- **Frontend:** HTML, CSS, JavaScript y Bootstrap 5.3 con Bootstrap Icons (cargados por CDN)
- **Plantillas:** Laravel Blade
- **Arquitectura:** MVC de Laravel

No se usa Node.js, Vue ni React: los estilos y scripts propios están en `public/css/app.css` y `public/js/app.js`.

## Requisitos

- PHP 8.2 o superior con las extensiones `pdo_mysql`, `mbstring`, `openssl` y `fileinfo`
- Composer 2
- MySQL 8 o MariaDB 10.4+ (por ejemplo, el que incluye XAMPP)
- Conexión a internet para cargar Bootstrap desde el CDN

## Instalación y configuración

```bash
# 1. Clonar el repositorio y entrar a la carpeta
git clone https://github.com/Sustor1/Catalogo-Zapatos.git CatalogoZapatos
cd CatalogoZapatos

# 2. Instalar dependencias de PHP
composer install

# 3. Crear el archivo de entorno y la llave de la aplicación
cp .env.example .env
php artisan key:generate
```

Revisa la conexión a la base de datos en `.env` (por defecto, usuario `root` sin contraseña, como en XAMPP):

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=zapateria_db
DB_USERNAME=root
DB_PASSWORD=
```

## Creación de la base de datos

Hay dos opciones; usa **solo una**.

### Opción A: script SQL (base de datos, tabla y registros en un paso)

El archivo [`database/sql/zapateria_db.sql`](database/sql/zapateria_db.sql) crea la base de datos `zapateria_db`, la tabla `zapatos` e inserta 10 zapatos de ejemplo.

```bash
C:\xampp\mysql\bin\mysql.exe -u root < database\sql\zapateria_db.sql
```

También puede importarse desde phpMyAdmin, en la pestaña **Importar**. Con esta opción no es necesario ejecutar las migraciones ni los seeders.

### Opción B: migraciones y seeders de Laravel

Con MySQL en ejecución, crea la base de datos vacía desde la consola de MySQL o phpMyAdmin:

```sql
CREATE DATABASE zapateria_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

En XAMPP también puede hacerse desde la terminal:

```bash
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE zapateria_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

Después ejecuta las migraciones y los seeders:

```bash
# Crea la tabla `zapatos`
php artisan migrate

# Inserta 10 zapatos de ejemplo
php artisan db:seed

# O todo junto, borrando y recreando las tablas
php artisan migrate:fresh --seed
```

## Estructura de la tabla `zapatos`

| Campo | Tipo | Reglas |
|---|---|---|
| id | BIGINT | Autoincremental, llave primaria |
| marca | VARCHAR(50) | Obligatorio, máximo 50 caracteres |
| modelo | VARCHAR(80) | Obligatorio, máximo 80 caracteres |
| categoria | VARCHAR(20) | Obligatorio: Deportivo, Casual, Formal o Botas |
| talla | DECIMAL(3,1) | Obligatorio, entre 22.0 y 31.0, en pasos de 0.5 |
| color | VARCHAR(50) | Obligatorio |
| precio | DECIMAL(10,2) | Obligatorio, mayor a 0 |
| existencias | INT | Obligatorio, 0 o mayor |
| descripcion | TEXT | Opcional |
| created_at | TIMESTAMP | Fecha y hora de registro (automática) |
| updated_at | TIMESTAMP | Fecha y hora de la última edición (automática) |

## Iniciar el servidor

```bash
php artisan serve
```

Abre en el navegador: **http://127.0.0.1:8000** (redirige al catálogo en `/zapatos`).

## Estructura principal

```
app/Models/Zapato.php                    Modelo (tabla, campos asignables, categorías)
app/Http/Controllers/ZapatoController.php  Controlador CRUD + búsqueda, filtro e indicadores
app/Http/Requests/ZapatoRequest.php      Reglas de validación y mensajes en español
database/migrations/..._create_zapatos_table.php  Migración de la tabla
database/seeders/ZapatoSeeder.php        Zapatos de ejemplo
database/sql/zapateria_db.sql            Script SQL alternativo (base de datos + tabla + registros)
routes/web.php                           Rutas (Route::resource)
bootstrap/app.php                        Manejo de zapatos inexistentes (redirige con mensaje)
resources/views/layouts/app.blade.php    Plantilla general (navbar, alertas)
resources/views/zapatos/                 index, create, edit, show y parciales (_form, _existencias)
public/css/app.css, public/js/app.js     Estilos y JavaScript (confirmación y validación)
```

## Decisiones

1. Seguí el MVC estándar de Laravel con un solo modelo (`Zapato`) y un controlador de recursos (`Route::resource`), porque cubre las 7 acciones del CRUD con rutas convencionales y fáciles de explicar.
2. Puse la validación en un Form Request (`ZapatoRequest`), compartido por registrar y editar, para no repetir reglas en el controlador; el navegador valida de forma complementaria con atributos HTML5.
3. Registrar y editar comparten la vista parcial `_form.blade.php`, que usa `old()` para conservar lo que escribió el usuario cuando hay errores.
4. Si se pide un zapato inexistente, se vuelve al catálogo con un mensaje en lugar de un error 404; esto se resuelve en un solo lugar (`bootstrap/app.php`).
5. Para no complicar el proyecto, Bootstrap se carga por CDN (sin Node.js) y las sesiones se guardan en archivos, así la base de datos solo contiene la tabla `zapatos`.

## Uso de IA y documentación

### Herramientas

- **Claude Code** (asistente de programación de Anthropic, en Visual Studio Code): generación de código, ejecución de comandos y pruebas.
- **Documentación oficial:** [Laravel 12](https://laravel.com/docs/12.x) (validación, Form Requests, Eloquent, Blade, rutas de recursos, manejo de excepciones) y [Bootstrap 5.3](https://getbootstrap.com/docs/5.3/) (componentes, validación de formularios e iconos).

### Para qué partes se usó la IA

- Verificar el entorno (PHP, Composer, MySQL), crear el proyecto Laravel 12 y configurar `.env` y la base de datos.
- Generar la migración, el modelo, el controlador, el Form Request, el seeder, el script SQL, las rutas y las vistas Blade.
- Diseñar la interfaz con Bootstrap 5 siguiendo la paleta de colores indicada.
- Probar de punta a punta, contra el servidor real, el CRUD, las validaciones, la protección CSRF y los registros inexistentes, comprobando los datos en MySQL.
- Redactar este README y subir el proyecto a GitHub.

### Qué se tuvo que corregir

- **Mensaje de error en inglés:** el mensaje de longitud máxima se definió con la clave `max.string`, que Laravel no aplica en un Form Request, y aparecía "The marca field must not be greater than 50 characters". Las pruebas lo detectaron y se cambió la clave a `max`.
- **Acentos dañados en el script SQL:** al importar el script desde la consola de Windows, "Café" se guardaba con caracteres corruptos. Se agregó `SET NAMES utf8mb4;` al inicio y se comprobó en una base de datos de prueba.
- **Nombre de la tabla:** Laravel pluraliza los modelos con reglas del inglés, así que se definió `protected $table = 'zapatos'` en el modelo para no depender de ellas.
- **Archivos innecesarios:** Laravel crea por defecto migraciones de usuarios, caché y colas, y archivos de Vite/Node. Se eliminaron porque el proyecto no los usa.
- **Primer requerimiento ajustado:** la primera versión de la especificación tenía otras categorías (incluía "Sandalia") y no tenía campo de color. El desarrollo se detuvo y se rehizo con la tabla definitiva, que tiene los tipos y reglas exactos de la prueba.
