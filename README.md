# CRUD de Usuarios y Municipios — Arquitectura Hexagonal con DDD y CQRS (PHP)

**Estudiante:** María Camila López Villa  
**Código:** 7502420035  
**Asignatura:** Desarrollo Web · **Unidad 2** · Actividad académica individual  
**Ejercicio asignado:** N.º 14 — **Municipio**  
**Aplicación publicada:** https://municipios-mlopez.site.je/

Aplicación web PHP que gestiona **Usuarios** (con autenticación por sesión) y la entidad **Municipio** (ejercicio 14), con operaciones CRUDL completas: crear, consultar, listar, actualizar y eliminar. Está construida sobre el proyecto base del profesor, siguiendo Arquitectura Hexagonal (Ports & Adapters), DDD y CQRS.

---

## Entidad del ejercicio: Municipio

| Campo | Tipo | Regla de dominio |
|---|---|---|
| id | texto (UUID) | generado automáticamente |
| nombre | texto | obligatorio, mínimo 2 caracteres |
| departamento | texto | obligatorio |
| pais | texto | obligatorio |
| alcalde | texto | opcional |
| gobernador | texto | opcional |
| patronoReligioso | texto | opcional |
| numHabitantes | entero | no puede ser negativo |
| numCasas | entero | no puede ser negativo |
| numParques | entero | no puede ser negativo |
| numColegios | entero | no puede ser negativo |
| descripcion | texto largo | opcional |

La entidad **Usuario** (id, clave, nombre, rol) viene del proyecto base y se mantiene separada de Municipio.

---

## Cómo está organizado Municipio por capas

| Capa | Archivos de Municipio |
|---|---|
| **Dominio** | `Domain/Models/MunicipioModel.php`, `Domain/ValueObjects/MunicipioId.php`, `MunicipioName.php`, excepciones `Invalid...Municipio...Exception` y `MunicipioNotFoundException` |
| **Aplicación — puertos de entrada** | `Application/Ports/In/*MunicipioUseCase.php` (crear, actualizar, eliminar, consultar por id, listar) |
| **Aplicación — puertos de salida** | `Application/Ports/Out/*MunicipioPort.php` |
| **Aplicación — servicios y DTO** | `Application/Services/*MunicipioService.php`, Commands y Queries en `Application/Services/Dto/`, `MunicipioApplicationMapper.php` |
| **Infraestructura — adaptador MySQL** | `Infrastructure/Adapters/Persistence/MySQL/` (`MunicipioEntity`, `MunicipioPersistenceDto`, `MunicipioPersistenceMapper`, `MunicipioRepositoryMySQL`) |
| **Infraestructura — entrypoint web** | `Infrastructure/Entrypoints/Web/Controllers/MunicipioController.php`, Request/Response DTO, `MunicipioWebMapper.php`, acciones en `Infrastructure/Entrypoints/Web/MunicipioActions.php`, vistas en `Presentation/Views/municipios/` |
| **Común** | Registro de clases en `Common/ClassLoader.php` y ensamblado de dependencias en `Common/DependencyInjection.php` |

**Flujo de una operación (crear municipio):** formulario HTML → `MunicipioController` → `CreateMunicipioCommand` → `CreateMunicipioService` → `SaveMunicipioPort` → `MunicipioRepositoryMySQL` → base de datos.

---

## Requisitos

- PHP 8.0 o superior (probado con 8.3)
- MySQL o MariaDB
- Apache con `mod_rewrite` habilitado (XAMPP lo incluye)

---

## Ejecutar en local (XAMPP)

1. Instala XAMPP, inicia **Apache** y **MySQL** y clona el repositorio dentro de `C:\xampp\htdocs`:
   ```
   git clone https://github.com/Marialopez35109/users-management-php.git
   ```
2. **Base de datos:** abre `http://localhost/phpmyadmin`, ve a la pestaña **SQL** y ejecuta el script:
   `Infrastructure/Adapters/Persistence/MySQL/Database/mysql/database.sql`
   (crea la base `crud_usuarios` y las tablas `users` y `municipios`, con tres municipios de ejemplo).
3. **Variables de entorno:** copia la plantilla y ajústala. Con XAMPP el usuario es `root` y la clave va vacía:
   ```
   Copy-Item .env.example .env
   ```
   y deja `DB_PASSWORD=` sin valor. El archivo `.env` nunca se sube al repositorio.
4. **Usuario administrador:** genera el hash de una clave:
   ```
   C:\xampp\php\php.exe -r "echo password_hash('TuClave123', PASSWORD_BCRYPT);"
   ```
   y en la pestaña SQL, con la base `crud_usuarios` seleccionada, ejecuta:
   ```sql
   INSERT INTO users (id, name, email, password, role, status)
   VALUES ('1', 'Administrador', 'admin@crud.com', 'EL_HASH_GENERADO', 'ADMIN', 'ACTIVE');
   ```
5. Abre `http://localhost/users-management-php/public/` e inicia sesión con `admin@crud.com`.

---

## Despliegue

La aplicación está publicada en **InfinityFree** (hosting PHP gratuito) con la base de datos MySQL del mismo servicio:

- URL: https://municipios-mlopez.site.je/
- Los archivos se suben a `htdocs` por FTP. El archivo `.env` del servidor se sube aparte y no está en el repositorio.
- El `.htaccess` redirige las peticiones hacia `public/index.php`, de modo que archivos como `.env` o el código fuente no se sirven al navegador.
- En el script del servidor se omiten `CREATE DATABASE` y `USE`, porque el hosting no permite crear bases de datos por SQL.

**Limitación conocida:** el hosting gratuito no permite enviar correo. En la versión publicada, la recuperación de contraseña y los avisos por correo al registrar usuarios no funcionan (en el registro se muestra un aviso de error de correo, pero el usuario se guarda). En local sí funcionan al configurar el SMTP en el `.env`.

---

## Documentación del proyecto base

Aplicación web PHP para la gestión de usuarios: registro, listado, visualización, edición, eliminación, autenticación con sesión y recuperación de contraseña por correo.

### Tecnologías

- PHP 8.3
- MySQL
- Apache mod_rewrite

### Funcionalidades

- Crear, listar, ver, editar y eliminar usuarios
- Autenticación con sesión (login / logout)
- Recuperación de contraseña mediante contraseña temporal enviada por correo
- Protección de rutas según estado de autenticación
- Protección contra acceso directo a archivos y listado de directorios
- Envío de notificaciones a los usuarios vía correo electrónico

### Conceptos aplicados

**Arquitectura general:** Arquitectura Hexagonal (Ports & Adapters), DDD, CQRS, capas Domain / Application / Infrastructure / Entrypoints, Front Controller (punto de entrada único).

**Capa de dominio:** Rich Domain Model, Value Objects, Named Constructors, Domain Exceptions, Domain Events, Enums, inmutabilidad, validación fail-fast, encapsulación de reglas de negocio.

**Capa de aplicación:** Use Cases, Application Services, Ports In (interfaces de casos de uso), Ports Out (interfaces de persistencia), Commands y Queries, DTOs, Anti-corruption Layer, Application Mapper.

**Capa de infraestructura:** Repository Pattern, Data Mapper, Persistence DTO, Persistence Entity, PDO con consultas preparadas, Adapter Pattern.

**Entrypoints / presentación:** enrutamiento por query string (`?route=`), PRG (Post-Redirect-Get), Flash Messages, autenticación basada en sesiones, Web Mapper, Web DTOs, `View::render`, Security Guard.

**Patrones de diseño:** Front Controller, Repository, Data Mapper, Factory Method, DTO, Strategy, Template Method, PRG.

**Principios SOLID:** SRP, OCP, LSP, ISP y DIP.

**Configuración externalizada (12-Factor App, factor III):** variables de entorno separadas del código, credenciales en `.env` (ignorado por git), `.env.example` como plantilla, las variables reales del servidor tienen prioridad sobre `.env`.
