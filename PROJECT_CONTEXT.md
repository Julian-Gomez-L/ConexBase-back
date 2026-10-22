# Project Context — ConexBase (backend)

Contexto del proyecto para asistentes de IA (Claude Code, Copilot, Cursor). Responde a la pregunta: *¿en qué situación existe este proyecto y qué lo rodea?* Léelo completo antes de generar o modificar código. El `README.md` es la versión para personas.

---

## 1. Propósito y problema de negocio

**Basecamas y Colchones El Dormilón** (Fontibón, Bogotá) fabrica y vende camas, colchones, cabeceros y muebles. Hoy gestiona pedidos, producción y pagos por **WhatsApp y Excel**, lo que causa:

- Errores de transcripción y datos duplicados o perdidos.
- Falta de trazabilidad: no se sabe en qué etapa está cada pedido.
- Mala comunicación entre ventas, confirmación, producción y administración.
- Cálculo manual de comisiones de asesores y pago por destajo a tapiceros.
- Retrasos en entregas y decisiones sin información centralizada.

**ConexBase** centraliza todo en una sola base de datos y sigue el recorrido completo del pedido:

`Ventas → Confirmación → Producción → Tapicería / Esqueletería → Control de calidad → Entrega`

Objetivos específicos: eliminar el error humano en los datos, automatizar comisiones y destajo, estandarizar el ciclo de vida del pedido, generar reportes para la gerencia y mantener una arquitectura modular y adaptable.

## 2. Alcance y límites

**Dentro del alcance**

- Procesos internos de ventas, confirmación de pedidos, producción, pagos, comisiones de asesores y liquidación de tapiceros, y control financiero básico.
- Solo para Basecamas y Colchones El Dormilón. A futuro podría adaptarse a empresas afines del sector en Bogotá.

**Implementado hoy en este repositorio**

- CRUD con borrado lógico de 11 entidades: roles, usuarios, clientes, categorías, productos, pedidos, detalle de pedidos, pagos, producciones, trabajos de tapiceros e historial de pedidos.
- Documentación de la API con Scribe y datos de prueba (seeder).

**Pendiente (no lo asumas implementado ni lo inventes sin que se pida)**

- Autenticación (inicio de sesión, bloqueo por intentos, recuperación de contraseña) y control de acceso por rol.
- Cálculo de comisiones y liquidación de tapiceros (RF017–RF019).
- Flujo de confirmación con aprobar/rechazar, cancelación con motivo y reglas de cambio de estado.
- Módulo de finanzas (RF020) y reportes.

**Fuera del alcance**

- Otros sectores o negocios distintos a fabricación de camas y colchones.
- Funciones no definidas en la fase de requerimientos; cualquier novedad se planea para etapas futuras.
- Inventarios: se mencionan en los beneficios de la documentación, pero no existe ninguna entidad de inventario.

## 3. Stakeholders

| Quién | Relación con el proyecto |
|---|---|
| Gerencia / administración de la empresa | Patrocina y usa el sistema; recibe reportes y paga comisiones y destajo. |
| Asesores comerciales (ventas) | Registran pedidos; reciben comisión. |
| Confirmadores | Revisan y aprueban o rechazan pedidos. |
| Operarios y encargados de producción | Fabrican y reportan avance. |
| Tapiceros y esqueleteros | Ejecutan trabajos; se les liquida por destajo. |
| Contabilidad | Ingresos, pagos y control financiero. |
| Equipo desarrollador (4 aprendices SENA) | Duvan Felipe Sanchez Villamil, David Sneyder Rodríguez Pulido, Cristian Camilo Páez Guerrero, Julian David Gómez Ladino. |
| SENA — Centro de Diseño y Metrología | Entidad formadora; el proyecto es académico (Tecnólogo en Análisis y Desarrollo de Software, ficha 3177445). |

## 4. Usuarios y casos de uso generales

Roles del sistema: Administrador, Vendedor/Asesor, Confirmador, Encargado de Producción, Tapicero (y Contabilidad según la documentación). El seeder crea los cuatro primeros.

| Módulo | Casos de uso principales (RF) |
|---|---|
| Usuario | Registrar usuario (RF001), inicio de sesión (RF002), gestión de usuarios (RF003), recuperación de contraseña (RF004), asignar rol (RF005) |
| Venta | Registrar pedido (RF006), editarlo mientras esté pendiente (RF007), confirmarlo (RF008), historial (RF009), cancelarlo (RF010), revisar rechazados (RF011) |
| Producción | Recibir pedidos confirmados (RF012), iniciar (RF013), registrar avance (RF014), finalizar (RF015), ver estado (RF016) |
| Pagos y comisiones | Calcular comisión por venta (RF017), pagar comisiones (RF018), historial de pagos (RF019) |
| Finanzas | Registrar ingresos (RF020) |
| Nómina de tapiceros | Liquidación por destajo (figura en la documentación; sus requerimientos aún no están detallados) |

Estados del pedido en la documentación: Registrado/Pendiente → Confirmado → En producción → Finalizado → Entregado. Un pedido solo se edita o cancela mientras esté **Pendiente**.

## 5. Sistemas externos e integraciones

- **Ninguna integración activa.** La API no consume ni expone servicios de terceros.
- **Frontend:** aplicación web en React + Vite, en un repositorio aparte; consume esta API REST.
- **Sistemas que se reemplazan:** WhatsApp y Excel. La migración de sus datos es un riesgo declarado (datos inconsistentes).
- **Correo electrónico:** necesario para la recuperación de contraseña (RF004); aún no configurado.
- **Medios de pago:** efectivo, transferencia, Nequi, Daviplata y otros. Hoy son solo un texto (`metodo`), sin pasarela de pago.
- **Herramientas de apoyo:** Scribe (documentación en `/docs`, Postman y OpenAPI), phpMyAdmin (puerto 8881).

## 6. Restricciones

- Recursos tecnológicos y capacidades del entorno académico y de un equipo estudiantil.
- Instalación y pruebas sin interrumpir la operación diaria de la empresa.
- Personal con poca experiencia digital y sin soporte técnico: documentación y capacitación sencillas.
- Depende de una conectividad estable en la sede.
- Cumplir la normativa colombiana de protección de datos personales (Habeas Data).
- Solo se implementan las funciones definidas en los requerimientos.
- Idioma: dominio, mensajes de la API y comentarios en **español**.

## 7. Supuestos y dependencias

- Se asume que la empresa seguirá el flujo Ventas → Confirmación → Producción → Entrega descrito en la documentación.
- Los datos históricos de WhatsApp y Excel se limpiarán y migrarán de forma asistida.
- El frontend depende del contrato de esta API; no cambies rutas ni formatos de respuesta sin avisar.
- Comisiones y destajo se calcularán con reglas y porcentajes que debe definir la empresa; aún no están en el código.
- Dependencias técnicas: Docker, PHP 8.3, Laravel 12, MySQL, Composer y los paquetes de `composer.json` (Scribe 5.11, Tinker).
- Riesgos críticos de la matriz del proyecto: retrasos de desarrollo, migración de datos inconsistente y accesos no autorizados (hoy la API no tiene autenticación).

## 8. Contexto organizacional

- Equipo de 4 aprendices que se reparten entidades (en el diccionario del README: Dev 1 a Dev 4).
- Cronograma planeado de 20 semanas: recolección de información, requisitos, diseño, base de datos, backend, frontend, integración, pruebas, capacitación y documentación final.
- Metodología con control de versiones en GitHub: ramas `main` (estable) y `develop` (integración); se trabaja en `feat/<nombre>` y se une a `develop` con Pull Request.
- Commits y Pull Requests en español, descriptivos.
- Repositorio: <https://github.com/Julian-Gomez-L/ConexBase-back>.

## 9. Contexto técnico

### 9.1 Stack

PHP 8.3 · Laravel 12 · MySQL (`ConexBase`) · Docker Compose · Scribe · PHPUnit 11 · Laravel Pint. `package.json` solo trae el *tooling* por defecto de Laravel (Vite/Tailwind); la API no lo usa. No agregues dependencias de Composer ni de npm sin que se pida.

### 9.2 Comandos exactos

Entorno oficial: Docker (servicio `app`, contenedor `container_laravel`). No hay `.env.example`; el `.env` debe usar `DB_CONNECTION=mysql`, `DB_HOST=db`, `DB_PORT=3306`, `DB_DATABASE=ConexBase`, `DB_USERNAME=root`, `DB_PASSWORD=1234`.

```bash
docker compose up -d --build                              # levantar app, MySQL y phpMyAdmin
docker compose exec app php artisan key:generate          # solo la primera vez
docker compose exec app php artisan migrate --seed        # crear tablas + datos de prueba
docker compose exec app php artisan migrate:fresh --seed  # reiniciar BD
docker compose exec app php artisan test                  # pruebas (PHPUnit, SQLite en memoria)
docker compose exec app ./vendor/bin/pint                 # formatear
docker compose exec app php artisan scribe:generate       # regenerar docs en /docs
docker compose exec app php artisan route:list --path=api # verificar rutas
```

Puertos: API `8000`, MySQL `3308` (host), phpMyAdmin `8881`. Docs en `/docs`, `/docs.postman`, `/docs.openapi`.

### 9.3 Arquitectura (obligatoria)

Cada entidad sigue esta cadena; no saltes capas:

```text
routes/api.php → Controller → Service → Repository (vía Interface) → Model
```

| Capa | Ubicación | Responsabilidad |
|---|---|---|
| Controller | `app/Http/Controllers/<Entidad>Controller.php` | Recibe la petición, llama al servicio y arma el JSON. Sin lógica de negocio ni consultas. |
| Form Request | `app/Http/Requests/<Entidad>/Store<Entidad>Request.php` y `Update<Entidad>Request.php` | Validación de entrada con mensajes en español. |
| Service | `app/Services/<Entidad>Service.php` | Reglas de negocio, validación del ID y excepciones propias. Depende de la **interfaz**, nunca del repositorio concreto. |
| Interface | `app/Interfaces/<Entidad>Interface.php` | Extiende `BaseInterface` (`create`, `getAll`, `getById`, `update`, `delete`) y agrega métodos propios como `getAllWithTrashed()`. |
| Repository | `app/Repositories/<Entidad>Repository.php` | Extiende `BaseRepository` e inyecta el modelo en el constructor. Único lugar con consultas Eloquent. |
| Model | `app/Models/<Entidad>.php` | `$table`, `$fillable`, relaciones y `use SoftDeletes`. |

Los enlaces interfaz → repositorio se registran en `app/Providers/AppServiceProvider.php` con `$this->app->bind(...)`.

Orden de dependencia de las tablas (igual al de las migraciones `01_` a `11_`): `roles` → `usuarios` → `clientes` → `categorias` → `productos` → `pedidos` → `detalle_pedidos` → `pagos` → `producciones` → `trabajos_tapiceros` → `historial_pedidos`.

### 9.4 Checklist para una entidad nueva

1. Migración numerada en orden de dependencia, con `$table->softDeletes()` y llaves foráneas `->constrained('tabla')->onDelete('cascade')`.
2. Modelo con `SoftDeletes`, `$fillable` y relaciones.
3. `Interface` (extiende `BaseInterface`) y `Repository` (extiende `BaseRepository`).
4. `Service` con validación de ID y excepciones propias.
5. `StoreXRequest` y `UpdateXRequest`.
6. Controller con docblock `@group` de Scribe.
7. `Route::apiResource('nombre-plural-con-guiones', XController::class);` en `routes/api.php`.
8. `bind` en `AppServiceProvider`.
9. Datos de ejemplo en `DatabaseSeeder` y regenerar Scribe.

### 9.5 Convenciones y reglas de estilo

- PSR-12 con Laravel Pint. `.editorconfig`: UTF-8, LF, 4 espacios (2 en `.yml`), línea final obligatoria.
- Nombres en español: tablas en plural (`pedidos`, `producciones`), modelos en singular (`Pedido`, `Produccion`), rutas en plural con guiones (`detalle-pedidos`, `trabajos-tapiceros`), llaves foráneas `<entidad>_id`.
- Columnas comunes: `estado` (boolean en catálogos; string de 50 en pedidos, producción y trabajos), `created_at`, `updated_at`, `deleted_at`.
- Dinero: `decimal(12, 2)`, nunca `float`.
- Borrado siempre lógico (`SoftDeletes`); nada de `forceDelete`.
- Inyección por constructor con *property promotion*: `public function __construct(private XInterface $xRepository) {}`.
- Tipado: tipos de parámetros y retorno en código nuevo (`int $id`, `: array`, `: bool`). El código existente no usa `declare(strict_types=1)`; no lo agregues a archivos viejos sin pedirlo.
- Cambios en la base de datos: crea una migración nueva; no edites las ya aplicadas.

### 9.6 Contrato de respuestas

Éxito (hoy no es uniforme; en código nuevo usa el formato de `show`/`destroy`):

```json
{ "success": true, "message": "Pago consultado correctamente.", "data": { } }
```

- `index`, `store` y `update` existentes devuelven `"success": "<mensaje>"` (texto) y `"data"`.
- `show` y `destroy` devuelven `"success": true`, `"message"` y `"data"`.

Errores (registrados en `bootstrap/app.php`):

| Excepción | HTTP | Cuerpo |
|---|---|---|
| `ResourceNotFoundException(errorCode, message)` | 404 | `{success:false, message, error:<CODIGO>, status:404}` |
| `InvalidIdException(errorCode, message)` | 422 | `{success:false, message, error:<CODIGO>, status:422}` |

Códigos existentes: `INVALID_ID` y `<ENTIDAD>_NOT_FOUND` (ej. `PAGO_NOT_FOUND`). El servicio valida que el ID sea numérico, entero y mayor que 0.

### 9.7 Seguridad y datos

- **No hay autenticación.** Scribe documenta la API como "not authenticated".
- `password` está en `$hidden` del modelo `Usuario` y se guarda con `Hash::make`; mantenlo así.
- Las credenciales de `docker-compose.yml` y del seeder (`123456`) son solo de desarrollo.
- Nunca subas `.env` (está en `.gitignore`).

### 9.8 Deuda técnica e inconsistencias conocidas

No las "arregles" en silencio; si tocas una, dilo en tu respuesta.

1. **Archivo con mayúsculas distintas:** `app/Interfaces/TrabajostapicerosInterface.php` declara la interfaz `TrabajosTapicerosInterface`. En Linux, el autoload PSR-4 sin optimizar no la encuentra. Funciona hoy porque el `Dockerfile` usa `--optimize-autoloader`. Solución correcta: renombrar el archivo.
2. **`Pedido::$fillable` incluye `metodo_pago`**, pero la migración `06_pedido.php` no crea esa columna ni `fecha`, que el diccionario del README sí lista. `StorePedidoRequest` tampoco las valida.
3. **`Pago::cliente()`** devuelve `belongsTo(Pedido::class)`: el nombre correcto sería `pedido()`.
4. **`historial_pedidos` tiene `cliente_id`** en la migración y el modelo; el diccionario no lo lista.
5. **`observaciones`** es `string` en las migraciones de producción y trabajos, pero `text` en el diccionario.
6. **Atajo de depuración:** en varios servicios, `show('1234')` devuelve todos los registros, incluidos los borrados. `getAllWithTrashed()` existe en controlador y servicio, pero ninguna ruta lo expone. No lo repliques.
7. `StorePedidoRequest` importa `Ramsey\Uuid\Type\Integer` sin usarlo.
8. `subtotal` (detalle) y `total` (pedido) los envía el cliente; el backend no los calcula ni los verifica.
9. Los servicios repiten casi el mismo código por entidad. Si refactorizas, hazlo en un cambio aparte.
10. Solo existen las pruebas de ejemplo de Laravel; si agregas lógica, agrega pruebas en `tests/Feature`.

### 9.9 Qué hacer y qué no

**Haz:** seguir el patrón por capas, reutilizar `BaseRepository`, validar en Form Requests, lanzar las excepciones propias, mantener el borrado lógico, responder en español y, antes de proponer un cambio, correr `php artisan test` (y `scribe:generate` si cambiaste endpoints).

**No hagas:** consultas Eloquent en controladores o servicios, lógica de negocio en controladores, borrado físico, endpoints sin su `Request`, ni funcionalidades fuera del alcance documentado.
