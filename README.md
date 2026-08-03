# Trip Booking System

A Laravel-based backend for booking trips (e.g. tours, pilgrimages, group travel). It includes a public booking API for end users and a full admin dashboard for managing the platform.

## What This Project Does

Users can browse trips, book seats, and get automatically added to a waiting list if a trip is full — with automatic promotion to a real booking once a seat frees up. Admins get a complete dashboard panel to manage destinations, categories, trips, bookings, tour guides, and view business reports.

## Features

**For users (API)**

- Browse destinations, categories, and available trips
- Book a trip for yourself and any number of companions
- Automatic waiting list when a trip is full, with automatic promotion and email when a seat opens up
- Cancel a booking before the trip's cancellation deadline
- View your own bookings and waiting-list entries

**For admins (Dashboard)**

- Overview dashboard with key stats (total trips, bookings, users, revenue, trips by status)
- Manage destinations and categories (with search)
- Manage trips (details, pricing, seats, image upload)
- View bookings
- Manage tour guides and assign them to trips
- Five business reports: revenue per trip, popular destinations, trip occupancy rate, monthly revenue, and cancellations

## Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js and npm
- A database (MySQL, PostgreSQL, or SQLite)
- Postman for testing the API — collection linked below

## Installation

1. **Install dependencies**

    ```bash
    composer install
    npm install
    ```

2. **Set up your environment file**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    Then open `.env` and set your database credentials (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, etc.).

3. **Run the migrations and seed sample data**

    ```bash
    php artisan migrate
    php artisan db:seed
    ```

4. **Set up JWT authentication**

    ```bash
    php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
    php artisan jwt:secret
    ```

5. **Link storage**
   Trip and destination images are uploaded to the `public` disk (`storage/app/public`) and served via `Storage::url()`. Without this, uploaded images will 404:

    ```bash
    php artisan storage:link
    ```

6. **Build the frontend assets**
   Run this in its own terminal tab and leave it running (Breeze's Vite dev server, with hot reload):

    ```bash
    npm run dev
    ```

7. **Start the app**

    ```bash
    php artisan serve
    ```

## Default Admin Login

```
Email:    admin@gmail.com
Password: admin
```

Log in at `/login`, then visit `/admin/dashboard`.

## Authentication (JWT)

The API routes in this project are written against `auth:sanctum`. If your project actually authenticates via **JWT** (`tymon/jwt-auth`) instead of Sanctum: `tymon/jwt-auth` is already listed in `composer.json`, so `composer install` (step 2 above) already pulled it in — you only need to publish its config and generate a secret:

```bash
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:secret
```

## Testing the API with Postman

A ready-to-import collection covering every endpoint (destinations, categories, trips, bookings, waiting lists) is available here:

**Postman Collection:** `https://shayma-00012-s-team.postman.co/workspace/TripGo~81565c62-3535-4bce-a522-403bf0d19a18/collection/31914369-9f12f7b5-87d5-4f5f-8783-d00c6b2e7a82?action=share&creator=31914369&active-environment=31914369-45673651-4837-48bf-bfa5-abb0bb4d54f2`

**To use it:**

1. Open the link above and click **Run in Postman** (or **Import** it manually if you're viewing the raw file).
2. Set the collection's `base_url` variable to your local URL (defaults to `http://localhost:8000/api`).
3. Log in through your app's auth endpoint, copy the token, and set it as the collection's `token` variable — every request is pre-configured to send it as a Bearer token.
