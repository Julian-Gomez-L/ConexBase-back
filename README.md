# Diccionario de Datos — Sistema de Pedidos y Producción (Laravel)

**Proyecto:** ConexBase
**Framework:** Laravel (migraciones Eloquent)
**Cantidad de entidades:** 11 version 1
**Fecha:** 22 de Agosto de 2026

> Las entidades están numeradas en el **orden de creación de migraciones** (padre → hija) para evitar errores de foreign key.

---

## Resumen (orden de creación)

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

## 1. Rol — `roles`

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

## 2. Usuario — `usuarios`

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

## 3. Cliente — `clientes`

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

## 4. Categoría — `categorias`

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

## 5. Producto — `productos`

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

## 6. Pedido — `pedidos`

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

## 7. Detalle de pedido — `detalle_pedido`

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

## 8. Pago — `pagos`

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

## 9. Producción — `producciones`

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

## 10. Trabajo de tapicero — `trabajos_tapicero`

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

## 11. Historial de pedido — `historial_pedidos`

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
