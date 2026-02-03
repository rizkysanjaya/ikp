# Hosting Guide for Internal Server (IKP-CI4)

This guide details the steps to deploy the IKP application to an internal server.

## 1. System Requirements
- **PHP**: 7.4 or 8.x
- **Extensions**: `intl`, `mbstring`, `json`, `mysql`
- **Database**: MySQL / MariaDB
- **Web Server**: Apache or Nginx
- **Internet Access**: Required for CDNs (or see "Offline Mode" below)

## 2. Configuration (`.env`)
Copy your local `.env` to the server and update:

```ini
# Production Environment
CI_ENVIRONMENT = production

# Your Internal URL (e.g. http://192.168.1.10/ikp or http://ikp.internal)
app.baseURL = 'http://YOUR_INTERNAL_IP_OR_DOMAIN/'

# Database Credentials
database.default.hostname = localhost
database.default.database = ikp_bkn (create this db first)
database.default.username = your_db_user
database.default.password = your_db_pass
```

## 3. Directory Permissions
Ensure the web server (e.g., `www-data`) has **write access** to the `writable` folder:

```bash
chmod -R 775 writable
chown -R www-data:www-data writable
```

## 4. Database Setup
1. Create the database (e.g., `ikp_bkn`).
2. Run Migrations:
   ```bash
   php spark migrate
   ```
3. Run Seeders (for Master Data + Admin):
   ```bash
   php spark db:seed MasterDataSeeder
   php spark db:seed UserSeeder
   ```
   *Note: If `MasterDataSeeder` or `UserSeeder` doesn't exist, you might need to import your local `ikp_bkn.sql` file directly.*

## 5. Offline Mode (Important)
The application currently uses **CDNs** for:
- Tailwind CSS
- Alpine.js
- Select2
- Google Fonts

**If your internal server DOES NOT have internet access:**
1. Download these libraries manually.
2. Save them in `public/assets/`.
3. Update `app/Views/layouts/main.php` and `app/Views/layouts/admin.php` to point to local files instead of `https://cdn...`.

## 6. Security Checks
- Ensure `debug` mode is OFF (`CI_ENVIRONMENT = production`).
- Secure your `/admin` routes if necessary (currently handled by Login Auth).
- If using `Apache`, ensure the `.htaccess` in `public/` is active to remove `index.php` from URLs.
