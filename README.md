# lingoaz — Backend API

Laravel 13 + MySQL + Redis + Docker ilə qurulmuş REST API.

---

## Tələblər

- Docker & Docker Compose
- PHP 8.3+ (Docker içində)

---

## Qurulum

```bash
# Repoyu klonla
git clone <repo-url>
cd SkyDictionary

# .env faylını yarat
cp src/.env.example src/.env

# Konteynerləri işə sal
docker compose up -d

# Dependency-ləri qur
docker compose exec app composer install

# App açarını yarat
docker compose exec app php artisan key:generate

# Migration-ları işlət
docker compose exec app php artisan migrate

# (İstəyə bağlı) Seed et
docker compose exec app php artisan db:seed
```

---

## Servisler

| Servis  | Port  | Məqsəd            |
|---------|-------|-------------------|
| Nginx   | 80    | Web server        |
| PHP-FPM | —     | Laravel app       |
| MySQL   | 3306  | Verilənlər bazası |
| Redis   | 6379  | Cache / Session   |

---

## API Endpointlər

Bütün API endpointlər `/v1` prefiksi ilə başlayır.

### Auth (icazə tələb etmir)

| Method | Endpoint            | Təsvir                    |
|--------|---------------------|---------------------------|
| POST   | /v1/register        | Qeydiyyat                 |
| POST   | /v1/login           | Giriş                     |
| POST   | /v1/verify_otp      | E-poçt doğrulama          |
| POST   | /v1/resend_otp      | OTP-ni yenidən göndər     |
| POST   | /v1/forgot_password | Şifrə sıfırlama OTP-si    |
| POST   | /v1/reset_password  | Yeni şifrə tət            |

### Auth (Bearer token tələb edir)

| Method | Endpoint | Təsvir  |
|--------|----------|---------|
| POST   | /v1/logout | Çıxış |

### Lüğət

| Method | Endpoint                              | Təsvir                  |
|--------|---------------------------------------|-------------------------|
| GET    | /v1/dictionary-categories             | Kateqoriyalar siyahısı  |
| GET    | /v1/dictionary-categories/{id}/words  | Kateqoriya sözləri      |
| GET    | /v1/word-of-day                       | Günün sözü (public)     |

### Şəxsi lüğət (token tələb edir)

| Method | Endpoint                                     | Təsvir             |
|--------|----------------------------------------------|--------------------|
| GET    | /v1/user-dictionaries                        | Sözlər siyahısı    |
| POST   | /v1/user-dictionaries                        | Söz əlavə et       |
| GET    | /v1/user-dictionaries/{id}                   | Söz detalı         |
| PUT    | /v1/user-dictionaries/{id}                   | Söz yenilə         |
| DELETE | /v1/user-dictionaries/{id}                   | Söz sil            |
| DELETE | /v1/user-dictionaries/bulk                   | Toplu sil          |
| POST   | /v1/user-dictionaries/{id}/audio             | Audio əlavə et     |
| DELETE | /v1/user-dictionaries/{id}/audio/{index}     | Audio sil          |
| GET    | /v1/user-dictionary-groups                   | Qruplar            |
| POST   | /v1/user-dictionary-groups                   | Qrup yarat         |
| GET/PUT/DELETE | /v1/user-dictionary-groups/{id}     | Qrup əməliyyatları |
| GET/POST/PUT/DELETE | /v1/user-dictionary-categories | Kateqoriyalar     |

### Cümlə lüğəti (token tələb edir)

| Method | Endpoint                                       | Təsvir        |
|--------|------------------------------------------------|---------------|
| GET/POST | /v1/sentence-dictionary-groups               | Qruplar       |
| GET/POST | /v1/sentence-dictionary-group-categories     | Kateqoriyalar |
| GET/POST | /v1/sentence-dictionaries                    | Cümlələr      |

### Qeydlər (token tələb edir)

| Method | Endpoint         | Təsvir         |
|--------|------------------|----------------|
| GET/POST/PUT/DELETE | /v1/note-groups | Qeyd qovluqları |
| GET/POST/PUT/DELETE | /v1/notes       | Qeydlər         |

---

## Admin Panel

| URL                          | Təsvir             |
|------------------------------|--------------------|
| `https://lingoaz.online/`    | Welcome səhifəsi   |
| `https://lingoaz.online/admin/login` | Admin girişi |
| `https://lingoaz.online/admin`       | Admin paneli |

---

## Faydalı Komandalar

```bash
# Logları izlə
docker compose logs -f app

# Artisan komandası icra et
docker compose exec app php artisan <komanda>

# Cache təmizlə
docker compose exec app php artisan cache:clear

# MySQL-ə qoşul
docker compose exec mysql mysql -u root -p lingoaz
```

---

## Texnologiyalar

- **Framework:** Laravel 13.7
- **PHP:** 8.3+
- **Verilənlər bazası:** MySQL 8.0
- **Cache/Session:** Redis
- **Auth:** Laravel Sanctum
- **OTP:** ichtrojan/laravel-otp
- **Translate:** stichoza/google-translate-php
- **Konteyner:** Docker + Nginx
