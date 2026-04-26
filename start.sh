#!/bin/bash

# Clear Laravel cache
php artisan optimize:clear

# Run Laravel server in background
php artisan serve &

# Run build (optional, runs once)
npm run build

# Run Vite dev server
npm run dev