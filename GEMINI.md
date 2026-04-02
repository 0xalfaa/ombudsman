# Ombudsman Project (Filament Starter Kit)

## Project Overview
This project is built using the **Superduper Filament Starter Kit**, a robust foundation for Laravel 11 and Filament 3 applications. It is specifically tailored for an **Ombudsman** system, featuring tools for complaint management (Pengaduan), news (Berita), and attendance (Presensi).

### Core Technologies
- **PHP 8.2+** & **Laravel 11**
- **Filament 3** (Admin Panel)
- **Vite** (Asset Bundling)
- **Spatie Laravel Permission** (via Filament Shield)
- **Spatie Laravel Media Library** & **Spatie Laravel Settings**
- **Laravolt/Indonesia** (Geographical Data)

### Architecture Highlights
- **RBAC:** Managed through `Filament Shield`. Roles and permissions are granularly controlled.
- **Settings:** General site settings (branding, theme, favicon) are stored using `spatie/laravel-settings`.
- **User Management:** Uses UUIDs for the `User` model and integrates `Filament Breezy` for extended profile management.
- **Reporting System:** A custom "Pengaduan" (Complaints) module with related entities: `DataPelapor`, `DataTerlapor`, and `Kronologi`.

## Building and Running

### Prerequisites
- PHP 8.2+
- Node.js & NPM
- MySQL/PostgreSQL

### Initial Setup
1. **Dependencies:**
   ```bash
   composer install
   npm install
   ```
2. **Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. **Database:**
   ```bash
   php artisan migrate:fresh --seed
   ```
   *Note: The seeder populates Indonesian geographical data (Provinces, Cities, Districts).*
4. **Assets:**
   ```bash
   npm run build
   ```

### Running Locally
- **Web Server:** `php artisan serve`
- **Vite Dev Server:** `npm run dev`
- **Admin Panel:** Access via `/admin`
  - **Default User:** `superadmin@starter-kit.com`
  - **Default Password:** `superadmin`

## Development Conventions

### Filament Resources
New features should be implemented as Filament Resources in `app/Filament/Resources`. The project uses several plugins that should be respected:
- **Media:** Use the Media Manager for file uploads.
- **Shield:** Run `php artisan shield:generate --all` after adding new resources to update permissions.
- **Tables:** Default table configurations are set in `AppServiceProvider`.

### Localization
The project includes a custom command for bulk translation:
```bash
php artisan superduper:lang-translate [from] [to]
```

### Coding Standards
- **Models:** Use UUIDs where appropriate (e.g., `User` model).
- **Views:** Frontend views are located in `resources/views/home`.
- **Assets:** Custom Filament themes are located in `resources/css/filament/admin/theme.css`.

## Deployment (Zeabur)
When deploying to Zeabur, ensure:
1. `APP_KEY` is set in environment variables.
2. `php artisan migrate --force` is run during the build/deploy step.
3. Geographical data seeding might take time; consider running it manually or via a job if it timeouts.
4. Set `FILESYSTEM_DISK=public` and ensure storage is linked.
