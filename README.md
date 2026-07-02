# Gestor de Sitios Web Favoritos

Prueba técnica de PHP — **Audisoft**.

Aplicación web desarrollada con Laravel que permite gestionar una colección de sitios web favoritos organizados por categorías.

## Funcionalidades

- **Sitios**: listar, agregar y eliminar sitios web con nombre, URL (enlace clicable en nueva pestaña) y categoría.
- **Categorías**: listar, crear y eliminar categorías. Solo se pueden borrar si no tienen sitios asignados.
- Una única base de datos para sitios y categorías.

## Stack tecnológico

| Pieza            | Elección                   | Motivo                                                       |
|------------------|----------------------------|--------------------------------------------------------------|
| Framework        | Laravel 13                 | PHP moderno, Eloquent ORM, migraciones, Blade.               |
| PHP              | 8.5                        | Última versión estable con mejoras de rendimiento.            |
| Base de datos    | SQLite (por defecto)       | Cero configuración. Compatible también con MySQL/PostgreSQL.  |
| CSS              | Tailwind CSS vía CDN       | Diseño moderno sin dependencias de build (`npm`/`Vite`).     |
| Interactividad   | Alpine.js vía CDN          | Transiciones y estados sin JS a mano.                        |
| Alertas          | SweetAlert2 vía CDN        | Confirmaciones elegantes al eliminar registros.              |
| Servidor local   | `php artisan serve`        | Cero configuración de Apache/Nginx.                          |

## Requisitos previos

- **PHP** >= 8.3 con extensiones habilitadas: `pdo_sqlite`, `mbstring`, `openssl`, `tokenizer`, `xml`, `ctype`, `json`
- **Composer** >= 2.x

> No se requiere Node.js, npm ni ninguna herramienta de build frontend. Todo el CSS y JS se carga vía CDN.

## Instalación

```bash
# 1. Clonar el repositorio
git clone <url-del-repositorio> audisoft-app
cd audisoft-app

# 2. Instalar dependencias de PHP
composer install

# 3. Copiar el archivo de variables de entorno
cp .env.example .env

# 4. Generar la clave de la aplicación
php artisan key:generate

# 5. Crear la base de datos SQLite (viene configurada por defecto)
# En Windows:
New-Item database/database.sqlite -ItemType File
# En Linux/Mac:
touch database/database.sqlite

# 6. Ejecutar migraciones y sembrar datos iniciales
php artisan migrate --seed

# 7. Iniciar el servidor de desarrollo
php artisan serve
```

Abrir **http://127.0.0.1:8000** en el navegador.

## Configuración con MySQL (alternativa)

Si se prefiere MySQL en lugar de SQLite, editar el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sitios_favoritos
DB_USERNAME=root
DB_PASSWORD=
```

Crear la base de datos manualmente y luego ejecutar:

```bash
php artisan migrate --seed
```

## Estructura del proyecto (archivos relevantes)

```
app/
  Http/Controllers/
    SiteController.php         # CRUD de sitios
    CategoryController.php     # CRUD de categorías
  Models/
    Category.php               # Modelo con relación hasMany → Site
    Site.php                   # Modelo con relación belongsTo → Category
database/
  migrations/
    ..._create_categories_table.php
    ..._create_sites_table.php
  seeders/
    CategorySeeder.php         # 5 categorías iniciales
resources/views/
  layouts/app.blade.php        # Layout principal (sidebar, header, flash messages)
  sites/index.blade.php        # Listado y formulario de sitios
  categories/index.blade.php   # Grid de categorías y formulario de creación
routes/
  web.php                      # Rutas del aplicativo
```

## Rutas disponibles

| Método   | URI                    | Acción                     |
|----------|------------------------|----------------------------|
| `GET`    | `/`                    | Redirige a `/sitios`       |
| `GET`    | `/sitios`              | Listado de sitios          |
| `POST`   | `/sitios`              | Crear un sitio             |
| `DELETE` | `/sitios/{site}`       | Eliminar un sitio          |
| `GET`    | `/categorias`          | Listado de categorías      |
| `POST`   | `/categorias`          | Crear una categoría        |
| `DELETE` | `/categorias/{category}` | Eliminar una categoría   |

## Reglas de negocio

- La **URL** de un sitio debe ser una URL válida (validación `url`).
- La **categoría** asignada a un sitio debe existir en la base de datos (`exists:categories,id`).
- El **nombre de categoría** es único (`unique:categories,name`).
- Una categoría **no se puede eliminar** si tiene sitios asignados — validación en el controlador y restricción `ON DELETE RESTRICT` en la base de datos como doble seguridad.

## Comandos útiles

```bash
# Reiniciar la base de datos desde cero con datos de ejemplo
php artisan migrate:refresh --seed

# Ver las rutas registradas
php artisan route:list

# Limpiar cachés
php artisan optimize:clear
```

## Licencia

Este proyecto es software de código abierto bajo la licencia [MIT](https://opensource.org/licenses/MIT).
