# 🔗 MySQL Railway Connection Guide

## 📋 MySQL Credentials (dari screenshot)

```
MYSQL_DATABASE:     railway
MYSQLHOST:          mysql.railway.internal
MYSQLPORT:          3306
MYSQLUSER:          root
MYSQLPASSWORD:      ICtdAPdHgYuVIfvXY6ZY3sLCtpIh6rDN
MYSQL_URL:          mysql://root:ICtdAPdHgYuVIfvXY6ZY3sLCtpIh6rDN@mysql.railway.internal:3306/railway
MYSQL_PUBLIC_URL:   mysql://root:ICtdAPdHgYuVIfvXY6ZY3sLCtpIh6rDN@switchback.proxy.rlwy.net:58821/railway
```

---

## 🚀 Setup di Railway (Tubes-PemWeb Service)

### Langkah 1: Buka Variables Tab

1. Klik **Tubes-PemWeb** service (Laravel app)
2. Klik tab **"Variables"**

### Langkah 2: Add Variable Reference (RECOMMENDED)

Klik **"+ New Variable"** → **"Add Reference"**

#### Reference MySQL Variables:

| MySQL Variable | Custom Name untuk Laravel |
|----------------|---------------------------|
| `MYSQLHOST` | `DB_HOST` |
| `MYSQLPORT` | `DB_PORT` |
| `MYSQLDATABASE` | `DB_DATABASE` |
| `MYSQLUSER` | `DB_USERNAME` |
| `MYSQLPASSWORD` | `DB_PASSWORD` |

**Atau tambahkan manual:**

```env
DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
```

### Langkah 3: Add Laravel Required Variables

Tambahkan juga:

```env
APP_KEY=base64:FWhOm0in3JBw6g2fe564SdF9+e0PSsDonSrdmnXZNHY=
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=mysql
SESSION_DRIVER=database
CACHE_STORE=database
```

⚠️ **PENTING**: Generate APP_KEY baru untuk production!

```bash
# Di terminal lokal:
php artisan key:generate --show

# Copy hasilnya (contoh: base64:xxxxxxxx)
# Replace APP_KEY di Railway Variables
```

---

## 🔄 Redeploy

Setelah add semua variables:
1. Railway akan **auto-redeploy** ✅
2. Atau manual: Tab **"Deployments"** → **"Redeploy"**

---

## 🌐 Generate Public Domain

1. Tab **"Settings"**
2. Scroll ke **"Networking"** → **"Public Networking"**
3. Klik **"Generate Domain"**
4. Dapat URL: `https://tubes-pemweb-production-xxxx.up.railway.app`

---

## ✅ Verify Connection

### Check Deployment Logs:

1. Tab **"Deployments"**
2. Klik deployment terbaru
3. **"View Logs"**

Look for:
```
✓ Running migrations...
  Migration completed successfully
```

### Check Database:

1. Klik **MySQL** service
2. Tab **"Data"**
3. Lihat tables: `users`, `cache`, `jobs`, `migrations`, dll

---

## 🐛 Troubleshooting

### Error: "SQLSTATE[HY000] [2002] Connection refused"

**Solution:**
- Gunakan `${{MySQL.MYSQLHOST}}` (private network)
- BUKAN IP atau public URL

### Error: "Access denied for user"

**Solution:**
- Pastikan `MYSQLPASSWORD` sudah correct
- Cek di MySQL service Variables

### Migration tidak jalan?

**Solution:**
```bash
# Update Procfile untuk force migrate:
web: php artisan config:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
```

### APP_KEY not set?

**Solution:**
```bash
php artisan key:generate --show
# Add ke Railway Variables
```

---

## 📊 Connection Info

**Development (Lokal):**
```env
DB_CONNECTION=sqlite
# File: database/database.sqlite
```

**Production (Railway):**
```env
DB_CONNECTION=mysql
DB_HOST=mysql.railway.internal  # Private network
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=ICtdAPdHgYuVIfvXY6ZY3sLCtpIh6rDN
```

---

## 🎯 Quick Checklist

- [ ] MySQL service running (hijau)
- [ ] Variables referenced dari MySQL ke Laravel
- [ ] APP_KEY generated dan added
- [ ] DB_CONNECTION=mysql
- [ ] Redeploy triggered
- [ ] Check logs - migrations success
- [ ] Generate public domain
- [ ] Test app di browser

---

## 🎉 Done!

Your Laravel app is now connected to MySQL Railway! 🚀

**Next Steps:**
- Seed database dengan data test
- Setup authentication flow
- Build fitur dokter-pasien
- Deploy updates via `git push`

---

**Need help?** Check full guide in [`RAILWAY_SETUP.md`](RAILWAY_SETUP.md)
