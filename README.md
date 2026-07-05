# Match-Appi ⚽

API REST para la porra del Mundial 2026. Los usuarios predicen resultados de partidos,
acumulan puntos y compiten en un ranking general.

Proyecto desarrollado como ejercicio S5.01 del Bootcamp FullStack PHP
en IT Academy Barcelona Activa.

---

## 🛠 Tecnologías

- **Backend:** PHP 8.5 · Laravel 13.8 · Eloquent ORM
- **Base de datos:** MySQL
- **Autenticación:** Laravel Passport (OAuth2)
- **Testing:** PHPUnit · TDD
- **Documentación:** Swagger (L5-Swagger)
- **Herramientas:** Composer · Git · GitFlow

---

## ✨ Funcionalidades

- Autenticación con tokens OAuth2 via Laravel Passport
- Sistema de roles: `admin` y `user`
- CRUD completo de equipos y partidos (solo admin)
- Predicción de resultados de partidos (bloqueada al iniciar el partido)
- Predicción del campeón del Mundial (editable durante la fase de grupos)
- Cálculo automático de puntos al introducir el resultado real (Events/Listeners)
- Ranking general calculado en tiempo real
- Documentación interactiva con Swagger UI

---

## 🗃 Modelo de datos

Entidades principales: `users` · `teams` · `matches` · `match_predictions` · `champion_predictions`

---

## 📡 Endpoints

| Método | URL | Acceso | Descripción |
|--------|-----|--------|-------------|
| POST | `/api/register` | Público | Registro de usuario |
| POST | `/api/login` | Público | Login, devuelve token |
| POST | `/api/logout` | Auth | Cierre de sesión |
| GET | `/api/users` | Admin | Lista todos los usuarios |
| GET | `/api/users/{id}` | Admin/Propietario | Ver perfil |
| PUT | `/api/users/{id}` | Admin/Propietario | Editar perfil |
| DELETE | `/api/users/{id}` | Admin/Propietario | Eliminar usuario |
| GET | `/api/teams` | Auth | Lista equipos |
| POST | `/api/teams` | Admin | Crear equipo |
| PUT | `/api/teams/{id}` | Admin | Actualizar equipo |
| DELETE | `/api/teams/{id}` | Admin | Eliminar equipo |
| GET | `/api/matches` | Auth | Admin: todos · User: próximos |
| POST | `/api/matches` | Admin | Crear partido |
| PUT | `/api/matches/{id}` | Admin | Actualizar partido / introducir resultado |
| DELETE | `/api/matches/{id}` | Admin | Eliminar partido |
| GET | `/api/match-predictions` | Auth | Admin: todas · User: las suyas |
| POST | `/api/match-predictions` | User | Crear predicción |
| PUT | `/api/match-predictions/{id}` | Propietario | Editar predicción |
| DELETE | `/api/match-predictions/{id}` | Admin/Propietario | Eliminar predicción |
| GET | `/api/champion-predictions` | Auth | Admin: todas · User: la suya |
| POST | `/api/champion-predictions` | User | Crear predicción de campeón |
| PUT | `/api/champion-predictions/{id}` | Propietario | Editar predicción de campeón |
| DELETE | `/api/champion-predictions/{id}` | Admin/Propietario | Eliminar predicción de campeón |
| GET | `/api/ranking` | Auth | Ranking general por puntos |

---

## 🚀 Instalación

### Requisitos previos

- PHP >= 8.2
- Composer
- MySQL

### Pasos

```bash
# 1. Clonar el repositorio
git clone https://github.com/aproposito/Match-Appi.git
cd match-appi

# 2. Instalar dependencias PHP
composer install

# 3. Configurar variables de entorno
cp .env.example .env
php artisan key:generate
```

Edita `.env` con tus credenciales de base de datos:

```env
DB_DATABASE=match_appi
DB_USERNAME=root
DB_PASSWORD=
```

```bash
# 4. Ejecutar migraciones y seeders
php artisan migrate --seed

# 5. Instalar Passport
php artisan passport:install

# 6. Crear cliente de acceso personal
php artisan passport:client --personal


# 7. Iniciar el servidor
php artisan serve
```

---

## 🧪 Testing

El proyecto sigue metodología **TDD** — los tests se escriben antes del código.

### Configuración del entorno de test

Crea un archivo `.env.testing` con una base de datos separada:

```env
DB_DATABASE=match_appi_test
```

```bash
# Migrar la base de datos de test
php artisan migrate --env=testing
```

```bash
# Ejecutar todos los tests
php artisan test
```

### Credenciales de prueba

| Rol | Email | Contraseña |
|-----|-------|------------|
| Admin | admin@matchappi.com | password |
| Usuario | user@matchappi.com | password |

---

## 🏗 Arquitectura

El proyecto sigue el patrón **API REST** con las siguientes capas:

```
app/
├── Http/
│   ├── Controllers/Api/   # Controladores de la API
│   ├── Requests/          # Form Requests (validación y autorización)
│   └── Resources/         # API Resources (transformación JSON)
├── Events/                # Eventos (MatchResultRecorded)
├── Listeners/             # Listeners (CalculateMatchPoints)
├── Services/              # Lógica de negocio (PointsCalculatorService)
└── Models/                # Eloquent ORM
```

---

## 📋 Sistema de puntuación

| Acierto | Puntos |
|---------|--------|
| Resultado (signo) | 50 |
| Goles equipo local exactos | 20 + 5 por cada gol > 2 |
| Goles equipo visitante exactos | 20 + 5 por cada gol > 2 |
| Acertar el campeón del Mundial | 150 |

El cálculo se dispara automáticamente cuando el admin introduce el resultado real de un partido, mediante
**Events/Listeners**. de Laravel (implementación del patrón Observer).

---

## 📖 Documentación

La documentación interactiva está disponible tras instalar el proyecto localmente en:

```
http://localhost:8000/api/documentation
```

Para probar los endpoints autenticados en Swagger UI:

1. Usa `POST /api/login` con las credenciales de prueba
2. Copia el token devuelto
3. Pulsa el botón **Authorize** (🔒) en la parte superior
4. Pega el token con formato: `Bearer {token}`

---

## 👤 Autor

**Álvaro Martínez Aldama**
[LinkedIn](https://www.linkedin.com/in/alvaro-martinez-aldama/) · [GitHub](https://github.com/aproposito/)

Proyecto académico — IT Academy Barcelona Activa · Sprint 5 · 2026
