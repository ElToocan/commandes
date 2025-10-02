# Laravel Project 🚀

This project is a Laravel-based application designed to streamline order management and enhance the user experience through a dynamic and responsive interface. It provides tools for managing products, categories, and orders, along with configurable options and add-ons. The application leverages modern web technologies to deliver a robust and scalable solution.

## 🚀 Key Features

- **Order Management**: Create, view, update, and delete orders with detailed information such as table number, customer details, delivery time, and order state.
- **Product Catalog**: Manage products with attributes like name, price, and category.
- **Product Categories**: Organize products into categories for easy browsing and management.
- **Configurable Options**: Define and apply options (e.g., size, color) to products and order lines.
- **Database Migrations**: Use migrations to easily set up and manage the database schema.
- **Artisan Commands**: Utilize custom Artisan commands for tasks like displaying inspiring quotes.
- **Web Routes**: Define routes for handling web requests and directing them to appropriate controllers.
- **Authentication**: Secure the application with configurable authentication guards and user providers.
- **Database Configuration**: Easily configure database connections for various database systems.
- **Application Configuration**: Centrally manage application settings such as name, environment, and timezone.

## 🛠️ Tech Stack

- **Backend**:
    - PHP: ^8.2
    - Laravel: ^10.0
    - Composer: Dependency Management
- **Frontend**:
    - JavaScript (ES Modules)
    - Vite: Build Tool
    - Tailwind CSS: CSS Framework
    - Axios: HTTP Client
- **Database**:
    - MySQL (Configurable via `config/database.php`)
- **Development Tools**:
    - npm/Yarn: JavaScript Package Manager
    - Laravel Sail: Docker-based development environment
    - Faker: For generating fake data
    - PHPUnit: Testing framework
    - Laravel Pint: Code style fixer
    - Laravel Pail: Debugging tool
    - Barryvdh/Laravel-Debugbar: Debugging tool
- **Other**:
    - Livewire: Full-stack framework for Laravel

## 📦 Getting Started

### Prerequisites

- PHP >= 8.2
- Composer
- Node.js and npm (or Yarn)
- MySQL or another supported database system
- Laravel Sail (optional, for Docker-based development)

### Installation

1.  **Clone the repository:**
    ```bash
    git clone <repository-url>
    cd <project-directory>
    ```

2.  **Install PHP dependencies using Composer:**
    ```bash
    composer install
    ```

3.  **Copy the `.env.example` file to `.env` and configure your environment variables:**
    ```bash
    cp .env.example .env
    ```
    Edit the `.env` file to set your database credentials, application URL, and other environment-specific settings.

4.  **Generate an application key:**
    ```bash
    php artisan key:generate
    ```

5.  **Install JavaScript dependencies using npm or Yarn:**
    ```bash
    npm install
    # or
    yarn install
    ```

6.  **Run database migrations:**
    ```bash
    php artisan migrate
    ```

### Running Locally

1.  **Start the development server:**
    ```bash
    php artisan serve
    ```

2.  **Start the Vite development server for front-end assets:**
    ```bash
    npm run dev
    # or
    yarn dev
    ```

3.  **Access the application in your browser at the URL specified by `php artisan serve` (usually `http://localhost:8000`).**

## 📂 Project Structure

```
laravel-project/
├── app/                      # Application logic (Controllers, Models, etc.)
├── bootstrap/                # Laravel bootstrapping files
├── config/                   # Configuration files (database, app, auth, etc.)
├── database/                 # Database related files (migrations, seeders)
│   ├── migrations/         # Database migration files
├── public/                   # Publicly accessible files (CSS, JavaScript, images)
├── resources/                # Resources (views, language files, assets)
│   ├── css/                # CSS files
│   ├── js/                 # JavaScript files
│   ├── views/              # Blade templates
├── routes/                   # Route definitions (web.php, api.php, console.php)
├── storage/                  # Storage directory for files and sessions
├── tests/                    # Automated tests
├── vendor/                   # Composer dependencies
├── artisan                   # Laravel Artisan command-line tool
├── composer.json             # Composer configuration file
├── package.json              # npm configuration file
├── vite.config.js            # Vite configuration file
├── .env                      # Environment configuration file
└── README.md                 # Project documentation
```

## 📸 Screenshots

<img width="1921" height="927" alt="image" src="https://github.com/user-attachments/assets/da4cb169-299f-463b-b7e7-34f4fe9e1704" />

<img width="1921" height="927" alt="image" src="https://github.com/user-attachments/assets/05c70d0e-4167-4e3c-8921-2758d86a98e1" />

<img width="1921" height="927" alt="image" src="https://github.com/user-attachments/assets/6025c621-568c-4cb3-83f4-1f8540e98490" />


## 📬 Contact

For questions or support, please contact: Pino Gabriele - gabriele.pno@gmail.com

💖 Thanks for checking out this project! We hope it helps you build something amazing.

