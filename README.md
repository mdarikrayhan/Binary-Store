# 🛒 Binary Store - Laravel E-commerce Platform

[![Laravel](https://img.shields.io/badge/Laravel-12.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-orange.svg)](https://mysql.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.x-blue.svg)](https://tailwindcss.com)

A modern, full-featured e-commerce application built with Laravel, featuring a clean admin panel, user-friendly shopping experience, and comprehensive order management system. Originally developed as a custom PHP application and converted to Laravel for better maintainability and scalability.

## ✨ Features

### 🔐 **Authentication & User Management**
- **User Registration/Login** with email and password
- **Role-based Access Control** (Admin vs Regular Users)
- **Profile Management** with detailed address information
- **First User Auto-Admin** (first registered user becomes admin)
- **Session Management** and security features

### 👨‍💼 **Admin Dashboard**
- **Category Management**: Create, edit, delete categories with image uploads
- **Product Management**: Full CRUD operations with pricing, inventory, and images
- **Order Management**: View all orders, update status, track customer information
- **File Upload System**: Organized image storage for products and categories
- **User Management**: View registered users and their roles

### 🛍️ **Customer Shopping Experience**
- **Product Catalog**: Browse products with category filtering
- **Product Details**: Detailed product pages with images and descriptions
- **Shopping Cart**: Add products and proceed to checkout
- **Order Placement**: Complete checkout with shipping information
- **Order History**: Track personal order status and history
- **Category Browsing**: Organized product discovery

### 📧 **Communication & Notifications**
- **Order Confirmation Emails**: Automated email notifications
- **Order Status Updates**: Email notifications for status changes
- **SMTP Integration**: Professional email delivery system

### 🌍 **Location Features**
- **Bangladesh Geographic Data**: Complete division, district, upazila hierarchy
- **Address Management**: Detailed shipping address collection
- **Postal Code Integration**: ZIP code validation and selection

## 🗄️ **Database Schema**

The application uses a well-designed MySQL schema optimized for e-commerce operations:

### **Tables Structure**
```sql
users               # User accounts and profiles
├── id              # Primary key
├── role            # ENUM('admin', 'user')
├── email           # Unique email address
├── password        # Hashed password
├── first_name      # User's first name
├── last_name       # User's last name
├── phone           # Contact number
├── division        # Bangladesh division
├── district        # Bangladesh district  
├── upazila         # Bangladesh upazila
├── zipcode         # Postal code
└── created_at      # Registration timestamp

categories          # Product categories
├── id              # Primary key
├── name            # Category name
├── description     # Category description
├── image_url       # Category image path
├── user_id         # Foreign key to users (creator)
└── created_at      # Creation timestamp

products            # Product catalog
├── id              # Primary key
├── name            # Product name
├── description     # Product description
├── image_url       # Product image path
├── price           # Price in smallest currency unit
├── quantity        # Available stock
├── category_id     # Foreign key to categories
├── user_id         # Foreign key to users (creator)
└── created_at      # Creation timestamp

orders              # Customer orders
├── id              # Primary key
├── product_id      # Foreign key to products
├── user_id         # Foreign key to users (customer)
├── order_status    # Order status (pending, delivered, etc.)
├── cost            # Total order cost
├── shipping_address # Delivery address
├── shipping_phone  # Delivery contact
├── quantity        # Ordered quantity
└── created_at      # Order timestamp
```

### **Relationships**
- **Users** → **Categories** (One-to-Many)
- **Users** → **Products** (One-to-Many)
- **Users** → **Orders** (One-to-Many)
- **Categories** → **Products** (One-to-Many)
- **Products** → **Orders** (One-to-Many)

## 🚀 **Installation & Setup**

### **Prerequisites**
- PHP 8.2 or higher
- Composer
- MySQL 8.0 or higher
- Node.js (for asset compilation)

### **Quick Start**
```bash
# 1. Clone the repository
git clone https://github.com/your-username/binary-store.git
cd binary-store

# 2. Install PHP dependencies
composer install

# 3. Install Node dependencies
npm install

# 4. Environment setup
cp .env.example .env
php artisan key:generate

# 5. Configure database in .env file
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=binarystore
DB_USERNAME=your_username
DB_PASSWORD=your_password

# 6. Run database migrations
php artisan migrate

# 7. Create storage symlink
php artisan storage:link

# 8. Compile assets (optional)
npm run build

# 9. Start the development server
php artisan serve
```

### **Email Configuration (Optional)**
Configure SMTP in your `.env` file for order notifications:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Binary Store"
```

## 📁 **Project Structure**

```
Binary-Store/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/            # Admin-only controllers
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   └── OrderController.php
│   │   │   ├── User/             # User-facing controllers
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   ├── CheckoutController.php
│   │   │   │   └── OrderController.php
│   │   │   ├── AuthController.php
│   │   │   └── HomeController.php
│   │   ├── Middleware/           # Custom middleware
│   │   └── Requests/             # Form validation requests
│   ├── Models/                   # Eloquent models
│   │   ├── User.php
│   │   ├── Category.php
│   │   ├── Product.php
│   │   └── Order.php
│   └── Services/                 # Business logic services
├── resources/
│   ├── views/                    # Blade templates
│   │   ├── layouts/
│   │   │   └── app.blade.php     # Main layout
│   │   ├── admin/                # Admin interface
│   │   │   ├── categories/
│   │   │   ├── products/
│   │   │   └── orders/
│   │   ├── user/                 # User interface
│   │   │   ├── categories/
│   │   │   ├── products/
│   │   │   └── orders/
│   │   ├── auth/                 # Authentication views
│   │   │   ├── signin.blade.php
│   │   │   ├── signup.blade.php
│   │   │   └── profile.blade.php
│   │   └── partials/             # Reusable components
│   │       ├── header.blade.php
│   │       ├── nav.blade.php
│   │       └── footer.blade.php
│   └── css/                      # Styling (Tailwind CSS)
├── public/
│   ├── uploads/                  # User uploaded files
│   │   ├── categories/           # Category images
│   │   └── products/             # Product images
│   └── json/                     # Bangladesh location data
│       ├── divisions.json
│       ├── districts.json
│       ├── upazilas.json
│       └── postcodes.json
├── database/
│   ├── migrations/               # Database migrations
│   └── seeders/                  # Database seeders
└── routes/
    └── web.php                   # Application routes
```

## 🛣️ **API Routes**

### **Public Routes**
| Method | Route | Description |
|--------|-------|-------------|
| GET | `/` | Homepage with featured categories |
| GET | `/signin` | User login page |
| POST | `/signin` | Process login |
| GET | `/signup` | User registration page |
| POST | `/signup` | Process registration |
| GET | `/categories` | Browse all categories |
| GET | `/products` | Browse all products |
| GET | `/product/{id}` | View single product |

### **Authenticated User Routes**
| Method | Route | Description |
|--------|-------|-------------|
| GET | `/profile` | User profile page |
| POST | `/profile` | Update profile |
| GET | `/checkout` | Checkout page |
| POST | `/checkout` | Process order |
| GET | `/orders` | User order history |
| POST | `/logout` | User logout |

### **Admin-Only Routes**
| Method | Route | Description |
|--------|-------|-------------|
| GET | `/admin/categories` | Manage categories |
| POST | `/admin/categories` | Create category |
| PUT | `/admin/categories/{id}` | Update category |
| DELETE | `/admin/categories/{id}` | Delete category |
| GET | `/admin/products` | Manage products |
| POST | `/admin/products` | Create product |
| PUT | `/admin/products/{id}` | Update product |
| DELETE | `/admin/products/{id}` | Delete product |
| GET | `/admin/orders` | View all orders |
| PUT | `/admin/orders/{id}` | Update order status |

## 🎨 **Frontend Design**

### **Technology Stack**
- **CSS Framework**: Tailwind CSS 3.x
- **Templating**: Laravel Blade
- **JavaScript**: Vanilla JS with modern ES6+
- **Responsive Design**: Mobile-first approach
- **Icons**: Heroicons (via Tailwind UI)

### **Design Features**
- **Modern UI/UX**: Clean, professional e-commerce design
- **Responsive Layout**: Works seamlessly on all devices
- **Interactive Elements**: Hover effects, transitions, and animations
- **Accessibility**: WCAG compliant with proper ARIA labels
- **Performance**: Optimized images and CSS
- **Consistent Branding**: Unified color scheme and typography

### **Key Components**
- **Navigation**: Role-based menu with user avatar
- **Product Cards**: Image, title, description, and pricing
- **Forms**: Validation with error/success messaging
- **Modals**: Confirmation dialogs for destructive actions
- **Notifications**: Toast messages for user feedback

## 🔄 **Migration from Custom PHP**

### **Key Improvements in Laravel Version**
- ✅ **Eloquent ORM**: Replaced raw PDO queries with Laravel's powerful ORM
- ✅ **Authentication**: Built-in Laravel authentication system
- ✅ **Validation**: Laravel Form Requests with comprehensive validation rules
- ✅ **Security**: CSRF protection, password hashing, and SQL injection prevention
- ✅ **Routing**: Clean, RESTful routes with middleware protection
- ✅ **Templating**: Blade engine with component reusability
- ✅ **Error Handling**: Comprehensive error logging and user-friendly messages
- ✅ **File Storage**: Laravel's file storage system for uploads
- ✅ **Configuration**: Environment-based configuration management
- ✅ **Artisan Commands**: CLI tools for database management and development

### **Preserved Features**
- 🎯 **Identical Database Schema**: Same table structure and relationships
- 🎯 **Exact UI/UX**: Preserved all Tailwind CSS designs and layouts
- 🎯 **Same Functionality**: All features work exactly as before
- 🎯 **Bangladesh Location Data**: Complete geographic hierarchy maintained
- 🎯 **Image Upload System**: Same organized file structure
- 🎯 **Email Notifications**: Order confirmation emails preserved

## 🔧 **Development**

### **Available Artisan Commands**
```bash
# Database operations
php artisan migrate                # Run migrations
php artisan migrate:fresh --seed   # Fresh database with sample data
php artisan db:seed                # Run database seeders

# Development server
php artisan serve                  # Start development server
php artisan serve --host=0.0.0.0 --port=8000  # Custom host/port

# Cache and optimization
php artisan config:cache           # Cache configuration
php artisan route:cache            # Cache routes
php artisan view:cache             # Cache views
php artisan cache:clear            # Clear application cache

# Storage and files
php artisan storage:link           # Create storage symlink
```

### **VS Code Integration**
The project includes VS Code tasks for development:
```json
{
    "label": "Laravel Development Server",
    "type": "shell",
    "command": "php artisan serve --host=0.0.0.0 --port=8000",
    "isBackground": true
}
```

## 🛡️ **Security Features**

### **Built-in Protection**
- **CSRF Protection**: All forms protected against cross-site request forgery
- **SQL Injection Prevention**: Eloquent ORM with parameter binding
- **Password Security**: Bcrypt hashing with salt
- **Session Security**: Secure session management
- **Input Validation**: Server-side validation for all user inputs
- **File Upload Security**: Validated file types and secure storage
- **Role-based Access Control**: Middleware-protected routes

### **Best Practices Implemented**
- Environment-based configuration (no hardcoded credentials)
- Proper error handling without information disclosure
- HTTPS-ready (works with SSL certificates)
- Secure headers and cookie settings
- Input sanitization and output escaping

## 📊 **Performance**

### **Optimization Features**
- **Database Indexing**: Optimized queries with proper indexes
- **Eloquent Relationships**: Efficient data loading with eager loading
- **Asset Optimization**: Minified CSS and JavaScript
- **Image Optimization**: Proper image sizing and compression
- **Caching**: Route, config, and view caching capabilities
- **CDN Ready**: Tailwind CSS served from CDN

## 🧪 **Testing**

### **Testing Setup**
```bash
# Run all tests
php artisan test

# Run specific test types
php artisan test --filter UserTest
php artisan test --filter CategoryTest

# Generate test coverage report
php artisan test --coverage
```

## 🚀 **Deployment**

### **Production Checklist**
- [ ] Set `APP_ENV=production` in `.env`
- [ ] Set `APP_DEBUG=false` in `.env`
- [ ] Configure production database
- [ ] Set up proper email configuration
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`
- [ ] Run `php artisan view:cache`
- [ ] Set up SSL certificate
- [ ] Configure web server (Apache/Nginx)
- [ ] Set proper file permissions

### **Server Requirements**
- PHP 8.2+
- MySQL 8.0+
- Composer
- Web server (Apache/Nginx)
- SSL certificate (recommended)

## 📝 **Contributing**

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/new-feature`)
3. Commit your changes (`git commit -am 'Add new feature'`)
4. Push to the branch (`git push origin feature/new-feature`)
5. Create a Pull Request

## 📄 **License**

This project is open-sourced software licensed under the [MIT license](LICENSE).

## 👨‍💻 **Author**

**Md Arik Rayhan**
- Email: mdarikrayhan@gmail.com
- GitHub: [@mdarikrayhan]

## 🙏 **Acknowledgments**

- Laravel Framework for the excellent foundation
- Tailwind CSS for the beautiful design system
- Bangladesh government for the geographic data

---

<p align="center">
  <strong>Binary Store - Modern E-commerce Solution Built with Laravel</strong>
</p>
