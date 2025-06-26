# Binary Store - Laravel Migration

This repository contains the migration of the Binary Store application from a custom PHP framework to Laravel.

## Project Structure

The project follows the standard Laravel directory structure:

- `app/` - Contains the core code of the application
  - `Http/Controllers/` - Controllers for handling requests
  - `Models/` - Eloquent models for database interaction
  - `Http/Middleware/` - Middleware for request filtering
- `config/` - Configuration files
- `resources/views/` - Blade templates for the views
- `routes/` - Route definitions
- `public/` - Publicly accessible files

## Models

The following models have been created:

- `User` - For user authentication and profile management
- `Category` - For product categories
- `Product` - For products
- `Order` - For customer orders
- `OrderItem` - For items within an order

## Controllers

The following controllers have been created:

### Admin Controllers
- `AdminCategoryController` - For managing categories
- `AdminProductController` - For managing products
- `AdminOrderController` - For managing orders

### User Controllers
- `AuthController` - For authentication
- `HomeController` - For the home page and general pages
- `CategoryController` - For viewing categories
- `ProductController` - For viewing products
- `OrderController` - For managing user orders
- `CheckoutController` - For the checkout process

## Views

The views have been converted to Laravel Blade templates:

- Layout files for consistent structure
- Partials for reusable components
- View files for each page

## Configuration

The following configuration files have been created:

- `.env` - Environment-specific configuration
- `config/app.php` - Application configuration
- `config/auth.php` - Authentication configuration
- `config/filesystems.php` - File storage configuration
- `config/laravel_database.php` - Database configuration (to be renamed to database.php)

## Middleware

The following middleware has been created:

- `AdminMiddleware` - For restricting access to admin routes

## Routes

Routes have been defined in `routes/web.php` for:

- Public pages
- Authentication
- User functionality
- Admin functionality

## Installation Instructions

1. Clone the repository
2. Install Composer dependencies:
   ```
   composer install
   ```
3. Copy `.env.example` to `.env` and configure your environment
4. Generate an application key:
   ```
   php artisan key:generate
   ```
5. Rename `config/laravel_database.php` to `config/database.php`
6. Run database migrations:
   ```
   php artisan migrate
   ```
7. Create a symbolic link for storage:
   ```
   php artisan storage:link
   ```
8. Start the development server:
   ```
   php artisan serve
   ```

## Additional Steps Required

1. Complete the migration of all views to Blade templates
2. Create database migrations for all tables
3. Create seeders for initial data
4. Implement file upload functionality
5. Add validation for all forms
6. Implement email notifications
7. Add tests for all functionality
8. Configure proper error handling
9. Set up proper logging
10. Configure caching

## Notes

This migration preserves the functionality of the original application while taking advantage of Laravel's features:

- Eloquent ORM for database operations
- Blade templating engine for views
- Middleware for request filtering
- Authentication system
- Route definitions
- File storage
- Configuration management