# Laravel Food Delivery App

This project is a **Food Delivery Platform** built using Laravel. It includes both a **Frontend** for customers and an **Admin Dashboard** for managing restaurants, menus, orders, and users.

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=Laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=PHP&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=MySQL&logoColor=white)
![HTML](https://img.shields.io/badge/HTML-E34F26?style=for-the-badge&logo=HTML5&logoColor=white)
  ![CSS](https://img.shields.io/badge/CSS-1572B6?style=for-the-badge&logo=CSS3&logoColor=white)
  ![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
   ![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=Bootstrap&logoColor=white)
   ![Vue](https://img.shields.io/badge/Vue-4FC08D?style=for-the-badge&logo=Vue.js&logoColor=white)

## Features

### Frontend
- **Restaurant Listing**: Users can browse and view available restaurants.
- **Menu Display**: View restaurant menus, food items, and pricing.
- **Add to Cart**: Users can add food items to their cart for checkout.
- **Order Management**: Users can place and track their orders.
- **User Authentication**: Secure registration and login for customers.

### Admin Dashboard
- **Restaurant Management**: Add, update, and delete restaurants.
- **Menu Management**: Manage food items, categories, and pricing for each restaurant.
- **Order Tracking**: View and manage all customer orders.
- **User Management**: Admin can view and manage registered users.
- **Dashboard Analytics**: View reports on orders, customers, and more.

## Demo

A live demo of the site can be accessed [here](#).

## Installation

### Prerequisites
- PHP >= 7.3
- Composer
- MySQL
- Node.js & npm (for frontend assets)

### Steps

1. **Clone the Repository**
   ```bash
   git clone https://github.com/YuriiLohvynenko/Laravel-food-delivery.git
   cd Laravel-food-delivery

2. **Install Dependencies**
   ```bash
   composer install
   npm install

3. **Environment Setup** Copy the .env.example file to create your .env configuration:
   ```bash
   cp .env.example .env
   ```
   Update the .env file with your database and other configurations:
   ```bash
   APP_NAME=FoodDelivery
   APP_URL=http://

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```
   
4. **Generate Application Key**
   ```bash
   php artisan key:generate

5. **Run Migrations** Run the database migrations to set up the required tables:
   ```bash
   php artisan migrate

6. **Seed the Database** (Optional) Populate the database with sample data using the seeders:
   ```bash
   php artisan db:seed

7. **Compile Frontend Assets**
   ```bash
   npm run dev

8. **Start the Application**
   ```bash
   php artisan serve

*Visit the application at http://localhost:8000.*

### Usage
- **Frontend:** Customers can browse restaurants, view menus, add items to the cart, and place orders.
- **Admin Dashboard:** The admin can manage restaurants, menus, and view/manage customer orders from the backend.

### Technology Stack
- **Backend:** Laravel 8
- **Frontend:** Blade, Bootstrap, Vue.js (optional)
- **Database:** MySQL
- **Authentication:** Laravel Breeze/Passport (for API-based authentication)
- **Email Notifications:** Configured with SMTP for order notifications

### Contributing
Contributions are welcome! Please follow the contribution guidelines.
   1. Fork the repository.
   2. Create your feature branch: git checkout -b feature/your-feature.
   3. Commit your changes: git commit -m 'Add new feature'.
   4. Push to the branch: git push origin feature/your-feature.
   5. Submit a pull request.

## License
This project is open-source and licensed under the MIT License.

**Thank you for using the Laravel Food Delivery platform! If you like this project, please give it a ⭐ on GitHub.**