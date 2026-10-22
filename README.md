# ConexBase — Backend (API REST)

![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?logo=mysql&logoColor=white)
![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?logo=docker&logoColor=white)
![Docs](https://img.shields.io/badge/Docs-Scribe-6C47FF)
![Estado](https://img.shields.io/badge/estado-en%20desarrollo-orange)

Sistema de información integrado para **Basecamas y Colchones El Dormilón** (Fontibón, Bogotá). Este repositorio contiene el **backend**: una API REST hecha con Laravel que gestiona clientes, productos, pedidos, pagos, producción y trabajos de tapicería.

Proyecto académico del **Tecnólogo en Análisis y Desarrollo de Software** (ficha 3177445), SENA — Centro de Diseño y Metrología, Bogotá, 2025.

## Tabla de contenido

1. [Descripción](#descripción-qué-problema-resuelve)
2. [Qué incluye hoy y qué falta](#qué-incluye-hoy-y-qué-falta)
3. [Tecnologías usadas](#tecnologías-usadas)
4. [Requisitos previos](#requisitos-previos)
5. [Instalación](#instalación)
6. [Configuración](#configuración)
7. [Uso](#uso)
8. [Estructura del proyecto](#estructura-del-proyecto)
9. [Cómo contribuir](#cómo-contribuir)
10. [Licencia](#licencia)
11. [Contacto o autores](#contacto-o-autores)
12. [Diccionario de datos](#diccionario-de-datos--sistema-de-pedidos-y-producción-laravel)

---

## Descripción: ¿qué problema resuelve?

Hoy la empresa maneja pedidos, producción y pagos por **WhatsApp y Excel**. Eso causa errores de transcripción, información duplicada o perdida, y no hay forma de saber en qué etapa va cada pedido.

ConexBase centraliza todo en una sola base de datos y sigue el recorrido completo de un pedido:

**Ventas → Confirmación → Producción → Tapicería / Esqueletería → Control de calidad → Entrega**

Objetivos principales:

- Eliminar errores de digitación al tener una única fuente de datos.
- Calcular automáticamente la liquidación por destajo de los tapiceros y las comisiones de los asesores.
- Dar trazabilidad al pedido y mejorar la comunicación entre áreas.
- Entregar reportes para que la gerencia tome decisiones.
- Mantener un diseño modular para adaptarlo en el futuro a otras empresas del mismo sector en Bogotá.

## Qué incluye hoy y qué falta

| Módulo (según la documentación) | Estado en este backend |
|---|---|
| Datos base: roles, usuarios, clientes, categorías, productos | CRUD listo |
| Ventas: pedidos, detalle de pedido, historial de pedidos | CRUD listo |
| Pagos | CRUD listo |
| Producción y trabajos de tapicería | CRUD listo |
| Inicio de sesión, bloqueo por intentos y recuperación de contraseña | Pendiente (la API aún **no tiene autenticación**) |
| Control de acceso por rol | Pendiente |
| Cálculo de comisiones y liquidación de tapiceros | Pendiente |
| Finanzas (ingresos y reportes) | Pendiente |

Cada entidad ofrece listar, crear, ver, actualizar y eliminar. La eliminación es **lógica** (el registro se marca como borrado, no se pierde).

## Tecnologías usadas

- **PHP 8.3** y **Laravel 12**
- **MySQL** (base de datos `ConexBase`) y **phpMyAdmin** para consultarla
- **Docker y Docker Compose** para levantar todo sin instalar nada más
- **Scribe** para generar la documentación de la API
- **PHPUnit 11** para pruebas
- Patrón por capas: Controlador → Servicio → Repositorio → Modelo

## Requisitos previos

La forma más simple es con Docker:

- [Docker](https://www.docker.com/) y Docker Compose
- [Git](https://git-scm.com/)

Libres en tu equipo: los puertos **8000** (API), **3308** (MySQL) y **8881** (phpMyAdmin).

## Instalación

**1. Clonar el repositorio**

```bash
git clone https://github.com/Julian-Gomez-L/ConexBase-back.git
cd ConexBase-back
git checkout develop
```

**2. Crear el archivo `.env`**

Crea el archivo `.env` en la raíz del proyecto con los valores de la sección [Configuración](#configuración).

**3. Levantar los contenedores**

```bash
docker compose up -d --build
```

**4. Generar la clave de la aplicación y crear las tablas con datos de prueba**

```bash
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate --seed
```

**5. Verificar**

Abre <http://localhost:8000/api/roles>. Si ves los cuatro roles en formato JSON, todo quedó funcionando.

| Servicio | Dirección |
|---|---|
| API | <http://localhost:8000/api> |
| Documentación de la API | <http://localhost:8000/docs> |
| phpMyAdmin | <http://localhost:8881> (servidor `db`, usuario `root`, clave `1234`) |
| MySQL desde tu equipo | `localhost:3308` |

## Configuración

### Variables de entorno

El repositorio no trae `.env.example`, así que crea un archivo llamado `.env` en la raíz con este contenido:

```env
APP_NAME=ConexBase
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000
APP_KEY=

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=ConexBase
DB_USERNAME=root
DB_PASSWORD=1234
```

| Variable | Para qué sirve |
|---|---|
| `APP_KEY` | Clave de cifrado de Laravel. Déjala vacía y genérala con `php artisan key:generate`. |
| `APP_URL` | Dirección base de la API; Scribe la usa en la documentación. |
| `DB_HOST` | Dentro de Docker es `db` (el nombre del servicio de MySQL). Si corres Laravel fuera de Docker, usa `127.0.0.1` y el puerto `3308`. |
| `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` | Deben coincidir con el servicio `db` de `docker-compose.yml`. |

> Estos valores son solo para desarrollo. Nunca subas el `.env` al repositorio (ya está en `.gitignore`).

### Otros archivos de ajustes

| Archivo | Qué configura |
|---|---|
| `docker-compose.yml` | Servicios `app`, `db` (MySQL) y `phpmyadmin`, con sus puertos y credenciales. |
| `Dockerfile` | Imagen de PHP 8.3 con las extensiones necesarias y `composer install`. |
| `config/scribe.php` | Documentación automática de la API (ruta `/docs`, Postman y OpenAPI). |
| `phpunit.xml` | Pruebas con SQLite en memoria, sin tocar la base de datos real. |
| `.editorconfig` | Formato de código: UTF-8, 4 espacios y saltos de línea LF. |

## Uso

### Endpoints

Todos siguen el mismo formato (`GET` listar, `POST` crear, `GET /{id}` ver, `PUT/PATCH /{id}` actualizar, `DELETE /{id}` eliminar):

| Recurso | Ruta |
|---|---|
| Roles | `/api/roles` |
| Usuarios | `/api/usuarios` |
| Clientes | `/api/clientes` |
| Categorías | `/api/categorias` |
| Productos | `/api/productos` |
| Pedidos | `/api/pedidos` |
| Detalle de pedidos | `/api/detalle-pedidos` |
| Pagos | `/api/pagos` |
| Producciones | `/api/producciones` |
| Trabajos de tapiceros | `/api/trabajos-tapiceros` |
| Historial de pedidos | `/api/historial-pedidos` |

### Ejemplo: registrar un pago

```bash
curl -X POST http://localhost:8000/api/pagos \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "pedido_id": 1,
    "usuario_id": 2,
    "monto": 150000,
    "metodo": "Transferencia",
    "fecha_pago": "2026-10-21",
    "comprobante": "comp-001.jpg"
  }'
```

Respuesta correcta:

```json
{
  "success": "El pago se creó correctamente",
  "data": { "id": 2, "pedido_id": 1, "monto": "150000.00" }
}
```

### Errores

| Situación | Código | Ejemplo de respuesta |
|---|---|---|
| El registro no existe | 404 | `{"success": false, "message": "El pago no existe.", "error": "PAGO_NOT_FOUND", "status": 404}` |
| El ID no es válido | 422 | `{"success": false, "message": "El identificador del pago no es válido.", "error": "INVALID_ID", "status": 422}` |
| Faltan datos o son inválidos | 422 | Laravel devuelve el detalle por campo |

Envía siempre el encabezado `Accept: application/json` para recibir los errores de validación en JSON.

### Datos de prueba

El *seeder* crea 4 roles, 4 usuarios (uno por rol), 3 clientes, 3 categorías, 5 productos y varios pedidos, pagos, producciones y trabajos de tapicería.

| Rol | Correo | Contraseña |
|---|---|---|
| Administrador | `admin@conexbase.com` | `123456` |
| Vendedor | `vendedor@conexbase.com` | `123456` |
| Encargado de Producción | `produccion@conexbase.com` | `123456` |
| Tapicero | `tapicero@conexbase.com` | `123456` |

Son solo para desarrollo; no los uses en producción.

### Comandos útiles

```bash
# Regenerar la documentación de la API (Scribe)
docker compose exec app php artisan scribe:generate

# Reiniciar la base de datos con los datos de prueba
docker compose exec app php artisan migrate:fresh --seed

# Ejecutar las pruebas
docker compose exec app php artisan test

# Ver los logs del contenedor
docker compose logs -f app

# Apagar todo
docker compose down
```

## Estructura del proyecto

```text
app/
├── Http/
│   ├── Controllers/    # Reciben la petición y devuelven JSON
│   └── Requests/       # Validaciones (Store y Update por entidad)
├── Services/           # Reglas de negocio y validación de IDs
├── Repositories/       # Acceso a datos (BaseRepository + uno por entidad)
├── Interfaces/         # Contratos de los repositorios
├── Models/             # Modelos Eloquent con borrado lógico
├── Exceptions/         # Errores propios (no encontrado, ID inválido)
└── Providers/          # Enlace interfaz → repositorio
database/
├── migrations/         # 11 tablas, numeradas en orden de dependencia
└── seeders/            # Datos de prueba
routes/api.php          # Rutas de la API
```

El recorrido de una petición es siempre el mismo:

```text
Ruta → Controlador → Servicio → Repositorio → Modelo → Base de datos
```

## Cómo contribuir

1. Trabaja desde la rama `develop` y crea una rama propia: `feat/nombre-de-la-funcionalidad`.
2. Respeta el patrón por capas: no pongas lógica de negocio en el controlador ni consultas en el servicio.
3. Si agregas una entidad nueva, crea su modelo, migración, interfaz, repositorio, servicio, controlador, *requests* y registra el enlace en `AppServiceProvider`.
4. Usa nombres en español y en el mismo estilo del resto del proyecto.
5. Antes de subir, corre `php artisan test` y, si cambiaste endpoints, `php artisan scribe:generate`.
6. Abre un *Pull Request* hacia `develop` con una descripción clara de qué cambió.

## Licencia

El `composer.json` declara licencia **MIT** (la del esqueleto de Laravel). El repositorio no incluye un archivo `LICENSE`; conviene agregarlo cuando el equipo defina cómo se compartirá el proyecto.

## Contacto o autores

Proyecto desarrollado por aprendices del **Tecnólogo en Análisis y Desarrollo de Software** (ficha 3177445), SENA — Centro de Diseño y Metrología, Bogotá.

- Duvan Felipe Sanchez Villamil
- David Sneyder Rodríguez Pulido
- Cristian Camilo Páez Guerrero
- Julian David Gómez Ladino

Para dudas, errores o sugerencias, abre un *issue* en <https://github.com/Julian-Gomez-L/ConexBase-back/issues> o escribe a cualquiera de los autores.

---

## Diccionario de Datos — Sistema de Pedidos y Producción (Laravel)

**Proyecto:** ConexBase
**Framework:** Laravel (migraciones Eloquent)
**Cantidad de entidades:** 11 version 1
**Fecha:** 22 de Agosto de 2026

> Las entidades están numeradas en el **orden de creación de migraciones** (padre → hija) para evitar errores de foreign key.

> **Nota:** este diccionario es la versión 1 y se conserva tal cual. Las migraciones actuales agregan además la columna `deleted_at` (borrado lógico) en todas las tablas, y las tablas reales se llaman `detalle_pedidos` y `trabajos_tapiceros`. Ante cualquier diferencia, mandan las migraciones de `database/migrations/`.

---

### Resumen (orden de creación)

| # | Entidad | Tabla | Depende de | Encargado |
|---|---------|-------|------------|-----------|
| 1 | Rol | `roles` | — | Dev 1 |
| 2 | Usuario | `usuarios` | `roles` | Dev 1 |
| 3 | Cliente | `clientes` | — | Dev 2 |
| 4 | Categoría | `categorias` | — | Dev 2 |
| 5 | Producto | `productos` | `categorias` | Dev 2 |
| 6 | Pedido | `pedidos` | `clientes`, `usuarios` | Dev 3 |
| 7 | Detalle de pedido | `detalle_pedido` | `pedidos`, `productos` | Dev 3 |
| 8 | Pago | `pagos` | `pedidos`, `usuarios` | Dev 3 |
| 9 | Producción | `producciones` | `pedidos`, `productos`, `usuarios` | Dev 4 |
| 10 | Trabajo de tapicero | `trabajos_tapicero` | `producciones`, `usuarios` | Dev 4 |
| 11 | Historial de pedido | `historial_pedidos` | `pedidos`, `usuarios` | Dev 4 |

---

### 1. Rol — `roles`

**Encargado:** Dev 1
**Descripción:** Define los roles que determinan las funciones y permisos que puede realizar un usuario dentro del sistema.
**Depende de:** ninguna

| Campo | Tipo Laravel | Tipo BD | Longitud | PK | FK | Único | Nulo | Descripción |
|-------|--------------|---------|----------|----|----|-------|------|-------------|
| id | bigIncrements | BIGINT | — | Sí | No | Sí | No | Identificador único del rol |
| nombre | string | VARCHAR | 50 | No | No | Sí | No | Nombre del rol |
| descripcion | text | TEXT | — | No | No | No | Sí | Descripción del rol |
| estado | boolean | TINYINT | 1 | No | No | No | No | Indica si el rol está activo |
| created_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de creación |
| updated_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de actualización |

**Relaciones:** Un rol tiene muchos usuarios (`hasMany`).

---

### 2. Usuario — `usuarios`

**Encargado:** Dev 1
**Descripción:** Almacena los usuarios que pueden ingresar y operar en el sistema, asociados a un rol.
**Depende de:** `roles`

| Campo | Tipo Laravel | Tipo BD | Longitud | PK | FK | Único | Nulo | Descripción |
|-------|--------------|---------|----------|----|----|-------|------|-------------|
| id | bigIncrements | BIGINT | — | Sí | No | Sí | No | Identificador único del usuario |
| documento | string | VARCHAR | 20 | No | No | Sí | No | Documento de identidad |
| nombre | string | VARCHAR | 100 | No | No | No | No | Nombre del usuario |
| apellido | string | VARCHAR | 100 | No | No | No | No | Apellido del usuario |
| correo | string | VARCHAR | 150 | No | No | Sí | No | Correo electrónico |
| password | string | VARCHAR | 255 | No | No | No | No | Contraseña cifrada |
| rol_id | foreignId | BIGINT | — | No | Sí | No | No | Rol asignado al usuario |
| estado | boolean | TINYINT | 1 | No | No | No | No | Indica si el usuario está activo |
| created_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de creación |
| updated_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de actualización |

**Relaciones:**
- Un usuario pertenece a un rol (`belongsTo`).
- Un usuario puede registrar muchos pedidos (`hasMany`).
- Un usuario puede registrar muchos pagos (`hasMany`).
- Un usuario puede estar encargado de muchas producciones (`hasMany`).
- Un usuario puede realizar muchos trabajos de tapicería (`hasMany`).
- Un usuario puede registrar muchos historiales de pedidos (`hasMany`).

---

### 3. Cliente — `clientes`

**Encargado:** Dev 2
**Descripción:** Almacena la información de los clientes que realizan pedidos a la empresa.
**Depende de:** ninguna

| Campo | Tipo Laravel | Tipo BD | Longitud | PK | FK | Único | Nulo | Descripción |
|-------|--------------|---------|----------|----|----|-------|------|-------------|
| id | bigIncrements | BIGINT | — | Sí | No | Sí | No | Identificador único del cliente |
| documento | string | VARCHAR | 20 | No | No | Sí | No | Documento de identidad del cliente |
| nombre | string | VARCHAR | 150 | No | No | No | No | Nombre completo del cliente |
| telefono | string | VARCHAR | 20 | No | No | No | No | Número telefónico |
| correo | string | VARCHAR | 150 | No | No | Sí | No | Correo electrónico |
| direccion | string | VARCHAR | 255 | No | No | No | Sí | Dirección del cliente |
| estado | boolean | TINYINT | 1 | No | No | No | No | Indica si el cliente está activo |
| created_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de creación |
| updated_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de actualización |

**Relaciones:** Un cliente tiene muchos pedidos (`hasMany`).

---

### 4. Categoría — `categorias`

**Encargado:** Dev 2
**Descripción:** Clasifica los productos disponibles en diferentes categorías para facilitar su organización y consulta.
**Depende de:** ninguna

| Campo | Tipo Laravel | Tipo BD | Longitud | PK | FK | Único | Nulo | Descripción |
|-------|--------------|---------|----------|----|----|-------|------|-------------|
| id | bigIncrements | BIGINT | — | Sí | No | Sí | No | Identificador único de la categoría |
| nombre | string | VARCHAR | 100 | No | No | Sí | No | Nombre de la categoría |
| descripcion | text | TEXT | — | No | No | No | Sí | Descripción de la categoría |
| estado | boolean | TINYINT | 1 | No | No | No | No | Indica si la categoría está activa |
| created_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de creación |
| updated_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de actualización |

**Relaciones:** Una categoría tiene muchos productos (`hasMany`).

---

### 5. Producto — `productos`

**Encargado:** Dev 2
**Descripción:** Contiene los productos que pueden ser incluidos en los pedidos de los clientes.
**Depende de:** `categorias`

| Campo | Tipo Laravel | Tipo BD | Longitud | PK | FK | Único | Nulo | Descripción |
|-------|--------------|---------|----------|----|----|-------|------|-------------|
| id | bigIncrements | BIGINT | — | Sí | No | Sí | No | Identificador único del producto |
| nombre | string | VARCHAR | 150 | No | No | No | No | Nombre del producto |
| descripcion | text | TEXT | — | No | No | No | Sí | Descripción del producto |
| precio | decimal | DECIMAL | 12,2 | No | No | No | No | Precio del producto |
| categoria_id | foreignId | BIGINT | — | No | Sí | No | No | Categoría a la que pertenece |
| estado | boolean | TINYINT | 1 | No | No | No | No | Indica si el producto está activo/disponible |
| created_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de creación |
| updated_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de actualización |

**Relaciones:**
- Un producto pertenece a una categoría (`belongsTo`).
- Un producto tiene muchos detalles de pedido (`hasMany`).
- Un producto tiene muchas producciones (`hasMany`).

---

### 6. Pedido — `pedidos`

**Encargado:** Dev 3
**Descripción:** Representa la solicitud de compra realizada por un cliente y gestionada por un usuario, desde su creación hasta su entrega.
**Depende de:** `clientes`, `usuarios`

| Campo | Tipo Laravel | Tipo BD | Longitud | PK | FK | Único | Nulo | Descripción |
|-------|--------------|---------|----------|----|----|-------|------|-------------|
| id | bigIncrements | BIGINT | — | Sí | No | Sí | No | Identificador único del pedido |
| cliente_id | foreignId | BIGINT | — | No | Sí | No | No | Cliente que realiza el pedido |
| usuario_id | foreignId | BIGINT | — | No | Sí | No | No | Usuario que registra el pedido |
| fecha | date | DATE | — | No | No | No | No | Fecha de creación del pedido |
| metodo_pago | string | VARCHAR | 50 | No | No | No | No | Método de pago seleccionado |
| estado | string | VARCHAR | 50 | No | No | No | No | Estado actual del pedido |
| total | decimal | DECIMAL | 12,2 | No | No | No | No | Valor total del pedido |
| created_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de creación del registro |
| updated_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de actualización |

**Relaciones:**
- Un pedido pertenece a un cliente (`belongsTo`).
- Un pedido pertenece al usuario que lo registró (`belongsTo`).
- Un pedido tiene muchos detalles de pedido (`hasMany`).
- Un pedido tiene muchos pagos (`hasMany`).
- Un pedido tiene muchas producciones (`hasMany`).
- Un pedido tiene muchos registros de historial (`hasMany`).

---

### 7. Detalle de pedido — `detalle_pedido`

**Encargado:** Dev 3
**Descripción:** Almacena los productos incluidos dentro de cada pedido, junto con sus cantidades y valores.
**Depende de:** `pedidos`, `productos`

| Campo | Tipo Laravel | Tipo BD | Longitud | PK | FK | Único | Nulo | Descripción |
|-------|--------------|---------|----------|----|----|-------|------|-------------|
| id | bigIncrements | BIGINT | — | Sí | No | Sí | No | Identificador único del detalle |
| pedido_id | foreignId | BIGINT | — | No | Sí | No | No | Pedido al que pertenece |
| producto_id | foreignId | BIGINT | — | No | Sí | No | No | Producto incluido |
| cantidad | unsignedInteger | INT UNSIGNED | — | No | No | No | No | Cantidad de unidades |
| precio_unitario | decimal | DECIMAL | 12,2 | No | No | No | No | Precio del producto al momento de la venta |
| subtotal | decimal | DECIMAL | 12,2 | No | No | No | No | Cantidad multiplicada por precio unitario |
| created_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de creación |
| updated_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de actualización |

**Relaciones:**
- Un detalle de pedido pertenece a un pedido (`belongsTo`).
- Un detalle de pedido pertenece a un producto (`belongsTo`).

---

### 8. Pago — `pagos`

**Encargado:** Dev 3
**Descripción:** Registra los pagos realizados por los clientes asociados a un pedido.
**Depende de:** `pedidos`, `usuarios`

| Campo | Tipo Laravel | Tipo BD | Longitud | PK | FK | Único | Nulo | Descripción |
|-------|--------------|---------|----------|----|----|-------|------|-------------|
| id | bigIncrements | BIGINT | — | Sí | No | Sí | No | Identificador único del pago |
| pedido_id | foreignId | BIGINT | — | No | Sí | No | No | Pedido asociado al pago |
| usuario_id | foreignId | BIGINT | — | No | Sí | No | No | Usuario que registra el pago |
| monto | decimal | DECIMAL | 12,2 | No | No | No | No | Valor del pago |
| metodo | string | VARCHAR | 50 | No | No | No | No | Método utilizado para realizar el pago |
| fecha_pago | date | DATE | — | No | No | No | No | Fecha en que se realizó el pago |
| comprobante | string | VARCHAR | 255 | No | No | No | Sí | Referencia o ruta del comprobante |
| created_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de creación |
| updated_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de actualización |

**Relaciones:**
- Un pago pertenece a un pedido (`belongsTo`).
- Un pago pertenece al usuario que registró el pago (`belongsTo`).

---

### 9. Producción — `producciones`

**Encargado:** Dev 4
**Descripción:** Representa el proceso de fabricación de los productos asociados a un pedido y permite asignar un usuario encargado de la producción.
**Depende de:** `pedidos`, `productos`, `usuarios`

| Campo | Tipo Laravel | Tipo BD | Longitud | PK | FK | Único | Nulo | Descripción |
|-------|--------------|---------|----------|----|----|-------|------|-------------|
| id | bigIncrements | BIGINT | — | Sí | No | Sí | No | Identificador único de la producción |
| pedido_id | foreignId | BIGINT | — | No | Sí | No | No | Pedido al que pertenece |
| producto_id | foreignId | BIGINT | — | No | Sí | No | No | Producto que se fabricará |
| usuario_id | foreignId | BIGINT | — | No | Sí | No | No | Usuario encargado de la producción |
| fecha_inicio | date | DATE | — | No | No | No | No | Fecha de inicio de producción |
| fecha_fin | date | DATE | — | No | No | No | Sí | Fecha de finalización |
| estado | string | VARCHAR | 50 | No | No | No | No | Estado actual de la producción |
| observaciones | text | TEXT | — | No | No | No | Sí | Observaciones del proceso |
| created_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de creación |
| updated_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de actualización |

**Relaciones:**
- Una producción pertenece a un pedido (`belongsTo`).
- Una producción pertenece a un producto (`belongsTo`).
- Una producción pertenece al usuario encargado (`belongsTo`).
- Una producción tiene muchos trabajos de tapicería (`hasMany`).

---

### 10. Trabajo de tapicero — `trabajos_tapicero`

**Encargado:** Dev 4
**Descripción:** Registra las actividades de tapicería realizadas sobre una producción y el usuario encargado de ejecutarlas.
**Depende de:** `producciones`, `usuarios`

| Campo | Tipo Laravel | Tipo BD | Longitud | PK | FK | Único | Nulo | Descripción |
|-------|--------------|---------|----------|----|----|-------|------|-------------|
| id | bigIncrements | BIGINT | — | Sí | No | Sí | No | Identificador único del trabajo |
| produccion_id | foreignId | BIGINT | — | No | Sí | No | No | Producción a la que pertenece |
| usuario_id | foreignId | BIGINT | — | No | Sí | No | No | Usuario/tapicero asignado |
| descripcion | text | TEXT | — | No | No | No | No | Descripción del trabajo |
| fecha_inicio | date | DATE | — | No | No | No | No | Fecha de inicio |
| fecha_fin | date | DATE | — | No | No | No | Sí | Fecha de finalización |
| estado | string | VARCHAR | 50 | No | No | No | No | Estado del trabajo |
| observaciones | text | TEXT | — | No | No | No | Sí | Observaciones del trabajo |
| created_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de creación |
| updated_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de actualización |

**Relaciones:**
- Un trabajo de tapicería pertenece a una producción (`belongsTo`).
- Un trabajo de tapicería pertenece al usuario/tapicero (`belongsTo`).

---

### 11. Historial de pedido — `historial_pedidos`

**Encargado:** Dev 4
**Descripción:** Registra los cambios de estado realizados sobre un pedido, indicando qué usuario realizó el cambio y cuándo ocurrió.
**Depende de:** `pedidos`, `usuarios`

| Campo | Tipo Laravel | Tipo BD | Longitud | PK | FK | Único | Nulo | Descripción |
|-------|--------------|---------|----------|----|----|-------|------|-------------|
| id | bigIncrements | BIGINT | — | Sí | No | Sí | No | Identificador único del historial |
| pedido_id | foreignId | BIGINT | — | No | Sí | No | No | Pedido cuyo estado cambió |
| usuario_id | foreignId | BIGINT | — | No | Sí | No | No | Usuario que realizó el cambio |
| estado_anterior | string | VARCHAR | 50 | No | No | No | Sí | Estado que tenía el pedido anteriormente |
| estado_nuevo | string | VARCHAR | 50 | No | No | No | No | Nuevo estado del pedido |
| observacion | text | TEXT | — | No | No | No | Sí | Motivo u observación del cambio |
| fecha | dateTime | DATETIME | — | No | No | No | No | Fecha y hora del cambio |
| created_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de creación |
| updated_at | timestamp | TIMESTAMP | — | No | No | No | Sí | Fecha de actualización |

**Relaciones:**
- Un registro del historial pertenece a un pedido (`belongsTo`).
- Un registro del historial pertenece al usuario que realizó el cambio (`belongsTo`).
