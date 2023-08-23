<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Escape Room Booking API

Welcome to the Escape Room Booking API! This API allows users to browse available escape rooms, book time slots, manage bookings, and more.

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/sougmi/escape-room-challenge.git

2. **Navigate to the project directory:**

   ```bash
   cd escape-room-booking-api

3. **Install dependencies using Composer:**

   ```bash
   composer install

4. **Generate the application key:**

   ```bash
    php artisan key:generate

5. **Run database migrations and seeders:**

   ```bash
   php artisan migrate --seed

6. **Running the API**

   ```bash
   php artisan serve

## Usage
You can now access the API using tools like Postman or any HTTP client.

API Documentation: http://localhost:8000/api/docs/

## Authentication
This API uses Sanctum for authentication. To register and log in as a user, you can use the provided authentication endpoints.

## Running Tests
Run unit and feature tests:
```bash
   php artisan test
