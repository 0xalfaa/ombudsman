#!/bin/bash

# 1. Jalankan Migrasi
echo "Running migrations..."
php artisan migrate --force

# 2. Cek apakah data Provinsi sudah ada (sebagai penanda database sudah di-seed)
# Kita gunakan tinker untuk menghitung jumlah data di tabel 'provinsi'
COUNT=$(php artisan tinker --execute="echo \App\Models\Provinsi::count();")

if [ "$COUNT" -eq "0" ]; then
    echo "Database is empty. Starting seeding (this might take a while)..."
    # Menjalankan seeder utama
    php artisan db:seed --force
    echo "Seeding completed!"
else
    echo "Database already seeded (Found $COUNT provinces). Skipping seed."
fi

# 3. Optimasi Filament & Laravel
php artisan storage:link
php artisan view:cache
php artisan config:cache
php artisan route:cache

# 4. Jalankan Aplikasi
echo "Starting application..."
php artisan serve --host=0.0.0.0 --port=$PORT
