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
git clone <url-del-repositorio> CatalogoZapatos
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

Con MySQL en ejecución, crea la base de datos desde la consola de MySQL o phpMyAdmin:

```sql
CREATE DATABASE zapateria_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

En XAMPP también puede hacerse desde la terminal:

```bash
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE zapateria_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

## Migraciones y seeders

```bash
# Crea la tabla `zapatos`
php artisan migrate

# Inserta 10 zapatos de ejemplo
php artisan db:seed

# O todo junto, borrando y recreando las tablas
php artisan migrate:fresh --seed
```

### Estructura de la tabla `zapatos`

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
routes/web.php                           Rutas (Route::resource)
bootstrap/app.php                        Manejo de zapatos inexistentes (redirige con mensaje)
resources/views/layouts/app.blade.php    Plantilla general (navbar, alertas)
resources/views/zapatos/                 index, create, edit, show y parciales (_form, _existencias)
public/css/app.css, public/js/app.js     Estilos y JavaScript (confirmación y validación)
```

## Decisiones

- Se usó un único controlador de recursos (`Route::resource`) porque cubre exactamente las 7 acciones del CRUD con rutas y nombres estándar de Laravel.
- La validación está en un Form Request (`ZapatoRequest`) que se reutiliza al registrar y al editar; el navegador valida también con atributos HTML5 (`required`, `min`, `max`, `step`), pero Laravel es la validación obligatoria.
- Los formularios de registro y edición comparten la vista parcial `_form.blade.php`, que usa `old()` para conservar los datos si hay errores.
- Si se consulta, edita o elimina un id inexistente, se regresa al catálogo con un mensaje en lugar de mostrar un error 404.
- Bootstrap se carga por CDN y las sesiones se guardan en archivos, para que la base de datos solo contenga la tabla `zapatos` y el proyecto no dependa de Node.js.

## Uso de IA y documentación

Este proyecto se desarrolló con apoyo de **Claude Code** (asistente de programación de Anthropic), usado para:

- Verificar el entorno (PHP, Composer, MySQL), crear el proyecto Laravel 12 y configurar `.env` y la base de datos.
- Generar la migración, el modelo, el controlador, el Form Request, el seeder, las rutas y las vistas Blade.
- Diseñar la interfaz con Bootstrap 5 siguiendo la paleta de colores indicada.
- Probar de punta a punta el CRUD, las validaciones, la protección CSRF y el manejo de registros inexistentes contra el servidor real, y comprobar los datos en MySQL.
- Redactar este README.

Sugerencias que se tuvieron que corregir durante el desarrollo:

- **Mensaje de longitud máxima en inglés:** el mensaje personalizado se registró como `max.string`, pero en un Form Request esa clave no se aplica y Laravel mostraba "The marca field must not be greater than 50 characters". Las pruebas lo detectaron y se cambió la clave a `max`.
- **Nombre de la tabla:** Laravel pluraliza los modelos en inglés, así que se definió `protected $table = 'zapatos'` en el modelo para no depender de esa regla.
- **Estructura del proyecto:** se quitaron las migraciones por defecto de Laravel (usuarios, caché y colas) y los archivos de Vite/Node, que el proyecto no necesita, para que la base de datos y el código queden enfocados en el catálogo.

Documentación consultada: [Laravel 12](https://laravel.com/docs/12.x) (validación, Eloquent, Blade, rutas de recursos) y [Bootstrap 5](https://getbootstrap.com/docs/5.3/).
