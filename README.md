# Binary Store - Laravel Version

This is the Laravel version of the Binary Store e-commerce application, converted from the original custom PHP implementation.

## Features

- **User Authentication**: Sign up, sign in, profile management
- **Role-based Access**: Admin and User roles with different permissions
- **Category Management**: CRUD operations for product categories (Admin)
- **Product Management**: CRUD operations for products with image uploads (Admin)
- **Order Management**: View and manage orders, update order status (Admin)
- **Shopping Experience**: Browse categories and products, place orders (Users)
- **Email Notifications**: Order confirmation emails
- **Bangladesh Location Support**: Division, district, and upazila data

## Database Schema

The application uses the same MySQL schema as the original PHP version:

- `users`: User accounts with role-based access and Bangladesh address fields
- `categories`: Product categories with images
- `products`: Products with images, pricing, and inventory
- `orders`: Customer orders with shipping information

## Installation

1. Clone the repository
2. Install dependencies: `composer install`
3. Configure environment: Copy `.env.example` to `.env` and update database settings
4. Run migrations: `php artisan migrate`
5. Start the server: `php artisan serve`

## Directory Structure

- `app/Http/Controllers/` - Controllers for different sections
  - `Admin/` - Admin controllers (Categories, Products, Orders)
  - `User/` - User-facing controllers (Products, Categories, Checkout, Orders)
  - `AuthController.php` - Authentication controller
  - `HomeController.php` - Home page controller
- `app/Models/` - Eloquent models (User, Category, Product, Order)
- `resources/views/` - Blade templates
  - `admin/` - Admin interface views
  - `user/` - User interface views
  - `auth/` - Authentication views
  - `partials/` - Shared components
- `public/uploads/` - Image uploads directory
- `public/json/` - Bangladesh location data

## Key Differences from Original

- Uses Laravel's Eloquent ORM instead of raw PDO queries
- Implements Laravel's authentication system
- Uses Blade templating engine
- Follows Laravel conventions and best practices
- Improved error handling and validation
- Better security features built-in

## Admin Features

- Manage categories (create, read, update, delete)
- Manage products (create, read, update, delete)
- View and manage orders
- Update order status
- File upload for category and product images

## User Features

- Browse categories and products
- View product details
- Place orders with shipping information
- View order history and status
- Profile management

## Routes

### Public Routes
- `/` - Home page (categories)
- `/signin` - Sign in page
- `/signup` - Sign up page
- `/user/categories` - Browse categories
- `/user/products` - Browse products

### Protected Routes (Admin)
- `/admin/categories` - Manage categories
- `/admin/products` - Manage products
- `/admin/orders` - Manage orders

### Protected Routes (Users)
- `/profile` - User profile
- `/user/checkout` - Checkout process
- `/user/orders` - Order history

## Technology Stack

- **Backend**: Laravel 12.x
- **Frontend**: Blade templates with Tailwind CSS
- **Database**: MySQL
- **Authentication**: Laravel built-in authentication
- **File Uploads**: Laravel file storage
- **Email**: PHP mail functionality (can be upgraded to Laravel Mail)

## Security Features

- CSRF protection on all forms
- Password hashing
- SQL injection prevention through Eloquent ORM
- Input validation and sanitization
- Role-based access control

## Future Enhancements

- Integrate Laravel Mail for better email functionality
- Add payment gateway integration
- Implement product search and filtering
- Add product reviews and ratings
- Implement inventory tracking
- Add order tracking system
