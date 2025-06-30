# Copilot Instructions for Binary Store Laravel

<!-- Use this file to provide workspace-specific custom instructions to Copilot. For more details, visit https://code.visualstudio.com/docs/copilot/copilot-customization#_use-a-githubcopilotinstructionsmd-file -->

This is a Laravel e-commerce application called Binary Store with the following specifications:

## Project Context
- **Framework**: Laravel 12.x with Blade templating
- **Database**: MySQL with existing schema (users, categories, products, orders)
- **Frontend**: Tailwind CSS for styling (maintain exact design from original PHP project)
- **Authentication**: Laravel built-in authentication with role-based access (admin/user)
- **File Uploads**: Category and product images with organized storage
- **Email**: Order confirmation emails via SMTP

## Database Schema
- `users`: Role-based (admin/user), Bangladesh address fields (division, district, upazila, zipcode)
- `categories`: Name, description, image_url, user_id (foreign key)
- `products`: Name, description, image_url, price (int), quantity, category_id, user_id
- `orders`: Product_id, user_id, order_status, cost, shipping_address, shipping_phone, quantity

## Key Features to Maintain
1. **Admin Features**: CRUD for categories, products, orders
2. **User Features**: Product browsing, checkout, order history
3. **Authentication**: Sign up/in, profile management, logout
4. **File Management**: Image uploads for categories/products
5. **Email System**: Order confirmation emails
6. **Location System**: Bangladesh geographic data (divisions, districts, upazilas)

## Design Requirements
- Maintain exact Tailwind CSS styling from original project
- Keep responsive grid layouts for products/categories
- Preserve navigation structure and user experience
- Maintain form designs and interactive elements

## Code Style
- Follow Laravel conventions and best practices
- Use Eloquent ORM for database operations
- Implement proper validation and security measures
- Maintain clean MVC architecture
- Use Laravel's built-in features where possible
