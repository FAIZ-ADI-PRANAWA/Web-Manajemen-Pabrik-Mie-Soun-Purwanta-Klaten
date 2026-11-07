# 🍜 Web Manajemen Pabrik Mie Soun Purwanta Klaten

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white) ![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white) ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black) ![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white) ![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white) 

## 📝 Description
This project, named "Web Manajemen Pabrik Mie Soun Purwanta Klaten," is a comprehensive web-based management system designed specifically for a Soun noodle factory. It provides robust tools for tracking and managing various aspects of the factory's operations, including raw material inventory, daily production processes, final product stock, sales transactions, and detailed operational reporting. The system is built with a decoupled architecture, featuring a Laravel API backend and a separate Laravel Blade frontend, ensuring a flexible and scalable solution for factory management. 🏭

## 📚 Table of Contents
*   [✨ Features](#-features)
*   [🚀 Tech Stack](#-tech-stack)
*   [⚙️ Installation](#%EF%B8%8F-installation)
    *   [Backend API Setup](#backend-api-setup)
    *   [Frontend Web Setup](#frontend-web-setup)
    *   [Running Both Applications](#running-both-applications)
*   [📖 Usage](#-usage)
    *   [Login](#login)
    *   [Dashboard Overview](#dashboard-overview)
    *   [Raw Material Management](#raw-material-management)
    *   [Production Recording](#production-recording)
    *   [Soun Sales & Stock Management](#soun-sales--stock-management)
    *   [Price Settings](#price-settings)
    *   [Daily Reports](#daily-reports)
*   [📂 Project Structure](#-project-structure)
*   [⚡ API Reference](#-api-reference)
*   [🤝 Contributing](#-contributing)
*   [⚖️ License](#%EF%B8%8F-license)
*   [🔗 Important Links](#-important-links)
*   [<footer> Footer](#footer)

## ✨ Features
This management system offers a wide array of functionalities to streamline factory operations:

*   **User Authentication & Authorization**: Secure login and logout functionality powered by Laravel Sanctum for API security. Users log in via the frontend to obtain an API token for backend interactions. 🔐
*   **Dashboard Overview**: A central dashboard displaying key performance indicators such as current Soun stock, monthly production totals, monthly sales, and estimated monthly profit. Includes a dynamic chart visualizing production vs. sales over the last 7 days. 📊
*   **Raw Material Management**: Tracks available stock of essential raw materials like Tepung Pati Aren, Kaporit, Minyak Kelapa Sawit, and Kayu Bakar. Allows recording of incoming raw material (restock) transactions. 📦
*   **Production Tracking**: Enables recording of daily production cycles, detailing the quantity of raw materials consumed and the total kilograms of Soun produced. Automatically updates raw material and finished Soun stock. 📈
*   **Soun Stock Management**: Manages the inventory of finished Soun (in kilograms), distinguishing between incoming (production output) and outgoing (sales) transactions. 🛒
*   **Sales Transaction Recording**: Facilitates logging of Soun sales, capturing the quantity sold and automatically calculating revenue based on the current selling price per kilogram. 💰
*   **Price Management**: Provides an interface to update the selling price of Soun per kilogram and the purchase prices of individual raw materials, ensuring accurate cost and profit calculations. 🏷️
*   **Daily Operational Reports**: Generates daily reports summarizing production activities (materials used, Soun produced, costs), raw material transactions, and Soun sales. Ideal for daily operational review and printing. 📄

## 🚀 Tech Stack
The project leverages modern web technologies for a robust and user-friendly experience:

*   **Backend**: 
    *   PHP 8.2+
    *   Laravel 12 (Framework) 🐘
    *   Laravel Sanctum (API Authentication) 🛡️
    *   MySQL / SQLite (Database) 🗃️
*   **Frontend**: 
    *   PHP (Blade Templating) ⚙️
    *   Laravel 12 (Framework) ✨
    *   JavaScript (for dynamic UI elements) 🌐
    *   Vite 7 (Build Tool) ⚡
    *   TailwindCSS 4 (Styling) 🎨
    *   Bootstrap 5 (UI Components) 📏
    *   Chart.js (for data visualization) 📈
*   **Development Tools**: Composer, npm, Concurrently (for running multiple dev servers) 🛠️

## ⚙️ Installation
To get this project up and running on your local machine, follow these steps. The project is structured as two separate Laravel applications: `backend-api` and `frontend-web`.

### Backend API Setup
1.  **Clone the repository**: 
    ```bash
    git clone https://github.com/FAIZ-ADI-PRANAWA/Web-Manajemen-Pabrik-Mie-Soun-Purwanta-Klaten.git
    cd Web-Manajemen-Pabrik-Mie-Soun-Purwanta-Klaten
    ```

2.  **Navigate to the backend directory**: 
    ```bash
    cd backend-api
    ```

3.  **Install PHP dependencies**: 
    ```bash
    composer install
    ```

4.  **Copy the environment file**: 
    ```bash
    cp .env.example .env
    ```

5.  **Generate an application key**: 
    ```bash
    php artisan key:generate
    ```

6.  **Configure your database**: By default, `sqlite` is used. If you prefer MySQL, update the `.env` file with your database credentials:
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_db_name
    DB_USERNAME=your_db_user
    DB_PASSWORD=your_db_password
    ```
    If using SQLite, ensure `database/database.sqlite` exists:
    ```bash
    touch database/database.sqlite
    ```

7.  **Run database migrations and seeders**: This will set up the database schema and create a default admin user.
    ```bash
    php artisan migrate --force
    php artisan db:seed # Creates admin@pabrik.com with password 'password'
    ```

8.  **Install Node.js dependencies**: 
    ```bash
    npm install
    ```

9.  **Build frontend assets for API (optional, for development)**: 
    ```bash
    npm run build
    ```

### Frontend Web Setup
1.  **Navigate to the frontend directory**: 
    ```bash
    cd ../frontend-web
    ```

2.  **Install PHP dependencies**: 
    ```bash
    composer install
    ```

3.  **Copy the environment file**: 
    ```bash
    cp .env.example .env
    ```

4.  **Generate an application key**: 
    ```bash
    php artisan key:generate
    ```

5.  **Install Node.js dependencies**: 
    ```bash
    npm install
    ```

6.  **Build frontend assets**: 
    ```bash
    npm run build
    ```

### Running Both Applications
For development, you need to run both the backend API and the frontend web server. The `backend-api` `composer.json` includes a `dev` script using `concurrently` to simplify this.

1.  **Start the backend API and Vite development server** (from `backend-api` directory):
    ```bash
    php artisan serve
    # In a separate terminal or using concurrently:
    npm run dev
    ```

2.  **Start the frontend web server** (from `frontend-web` directory):
    ```bash
    php artisan serve --port=8001 
    # And its Vite development server
    npm run dev
    ```

    *Alternatively, you can use the `dev` script in `backend-api/composer.json` which uses `concurrently` (requires `concurrently` installed globally or locally via npm) to run all necessary processes in one command. Ensure `backend-api/.env` has `APP_URL=http://localhost:8000` and `frontend-web/.env` has `APP_URL=http://localhost:8001` and the API URL in frontend controllers is correctly set (e.g., `http://127.0.0.1:8000/api`).*

    The frontend application is expected to be accessible at `http://localhost:8001` (or your chosen port) and the backend API at `http://localhost:8000`.

## 📖 Usage
This system is designed for a factory administrator to manage production, inventory, and sales of Soun noodles. Here's a typical workflow:

### Login
1.  Access the frontend application via your browser (e.g., `http://localhost:8001`).
2.  Use the default credentials to log in:
    *   **Email**: `admin@pabrik.com`
    *   **Password**: `password`

### Dashboard Overview
After logging in, you'll be greeted by the dashboard. This page provides a quick glance at:
*   Current Soun stock (kg) 📦
*   Monthly production (kg) 📈
*   Monthly sales (kg) 💰
*   Estimated monthly profit 📊
*   Status of raw material stocks (indicating if sufficient for 1x production) with a quick link to restock.
*   A 7-day trend graph for production and sales. 📈

### Raw Material Management
Navigate to the **Bahan Baku** section from the sidebar.
*   View a list of all predefined raw materials, their current stock, units, and purchase prices. 📋
*   _Note: Adding new raw material types is currently not supported via the frontend, only viewing._

### Production Recording
To record a new production batch:
1.  Go to the **Produksi** section. 🏭
2.  Click **Catat Produksi Baru**.
3.  Enter the `Tanggal Produksi` (Production Date).
4.  Specify `Jumlah Produksi (Berapa Kali)` (Number of Production Cycles). Each cycle produces **1900 kg** of Soun and consumes:
    *   Tepung Pati Aren: 2100 kg
    *   Kaporit: 28 kg
    *   Minyak Kelapa Sawit: 50 ml
    *   Kayu Bakar: 10 krat
5.  Add any `Catatan` (Notes) relevant to the production batch.
6.  Click **Simpan Produksi**. The system will validate raw material stock before saving. If stock is insufficient, an error will be displayed. Upon successful recording, raw material stock will decrease, and Soun stock will increase.

### Soun Sales & Stock Management
To manage Soun stock (restock or record sales):
1.  Go to the **Transaksi** section. 🔄
2.  Here you have two tabs:
    *   **Restock Bahan Baku**: Select a raw material, specify the `Jumlah Tambah Stok`, `Tanggal`, and `Keterangan` for incoming raw materials. This increases the raw material stock. ➕
    *   **Penjualan Soun Jadi**: Record outgoing Soun. Enter the `Jumlah Soun Terjual` (in kg), `Tanggal Penjualan`, and `Keterangan` (e.g., customer name, destination). This decreases Soun stock and updates total revenue. ➖

### Price Settings
Adjust the selling price of Soun and raw material purchase prices:
1.  Navigate to **Pengaturan Harga**.
2.  You can update the `Harga Soun (1kg)` which directly impacts sales revenue calculations.
3.  You can also update the `Harga Beli / Satuan` for each raw material, affecting production cost calculations.
4.  Click **Simpan Semua Perubahan Harga** to apply changes. ✅

### Daily Reports
To view a summary of daily operations:
1.  Go to the **Laporan** section.
2.  Select a `Tanggal` to view the report for that specific day.
3.  The report includes detailed logs of: 📋
    *   Daily Production (time, materials used, total Soun produced, total cost, notes)
    *   Raw Material Transactions (incoming/outgoing of each material)
    *   Soun Transactions (sales/outgoing of Soun, with revenue if applicable)
4.  You can print the report directly from the browser using the **Cetak Laporan** button. 🖨️

## 📂 Project Structure
The repository is organized into two main Laravel applications:

```
Web-Manajemen-Pabrik-Mie-Soun-Purwanta-Klaten/
├── backend-api/                  # Laravel API for all business logic and data management
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/      # API Controllers (Auth, BahanBaku, Dashboard, HargaJual, Laporan, Produksi, Transaksi)
│   │   │   ├── Requests/         # Form request validation
│   │   │   └── Resources/        # API Resources for data transformation
│   │   ├── Models/             # Eloquent models (BahanBaku, HargaJual, Produksi, ProduksiDetail, StokSoun, TransaksiBahanBaku, TransaksiSoun, User)
│   │   ├── Repositories/       # Data access layer (ProduksiRepository)
│   │   └── Services/           # Business logic layer (ProduksiService)
│   ├── bootstrap/              # Framework bootstrapping
│   ├── config/                 # Application configuration
│   ├── database/               # Migrations, factories, seeders
│   ├── public/                 # Public entry point
│   ├── routes/                 # API and web routes (api.php defines most endpoints)
│   ├── tests/                  # Application tests
│   ├── .env.example            # Environment variables example
│   ├── composer.json           # PHP dependencies (Laravel, Sanctum)
│   └── package.json            # Node.js dependencies (TailwindCSS, Vite, Axios, Concurrently)
├── frontend-web/                 # Laravel Blade application for the user interface
│   ├── app/
│   │   ├── Http/
│   │   │   ├── Controllers/      # Web Controllers for handling requests and interacting with API
│   │   │   └── Middleware/       # Middleware for API authentication (ApiAuth)
│   │   └── Models/             # Eloquent model (User)
│   ├── bootstrap/              # Framework bootstrapping
│   ├── config/                 # Application configuration
│   ├── database/               # Migrations, factories, seeders
│   ├── public/                 # Public entry point
│   ├── resources/
│   │   ├── css/                # Frontend CSS (TailwindCSS)
│   │   ├── js/                 # Frontend JavaScript (Axios for API calls)
│   │   └── views/              # Blade templates (auth, bahan_baku, dashboard, laporan, layouts, pengaturan, produksi, transaksi, welcome)
│   ├── routes/                 # Web routes
│   ├── tests/                  # Application tests
│   ├── .env.example            # Environment variables example
│   ├── composer.json           # PHP dependencies (Laravel)
│   └── package.json            # Node.js dependencies (TailwindCSS, Vite, Axios, Concurrently)
├── README.md                   # This README file
```

## ⚡ API Reference
The backend provides the following API endpoints, requiring authentication via Laravel Sanctum (except for login):

| Method | Endpoint                    | Description                                       | Authentication Required |
| :----- | :-------------------------- | :------------------------------------------------ | :---------------------- |
| `POST` | `/api/login`                | Authenticate user and issue API token             | No                      |
| `POST` | `/api/logout`               | Invalidate current user's API token               | Yes                     |
| `GET`  | `/api/user`                 | Retrieve authenticated user details               | Yes                     |
| `GET`  | `/api/v1/dashboard`         | Get dashboard statistics and charts               | Yes                     |
| `GET`  | `/api/v1/bahan-baku`        | List all raw materials                            | Yes                     |
| `POST` | `/api/v1/bahan-baku`        | Create a new raw material (admin only)            | Yes                     |
| `GET`  | `/api/v1/produksi`          | List all production records                       | Yes                     |
| `POST` | `/api/v1/produksi`          | Record a new production batch                     | Yes                     |
| `POST` | `/api/v1/transaksi/bahan-baku` | Record raw material incoming/outgoing transaction | Yes                     |
| `POST` | `/api/v1/transaksi/soun`    | Record Soun incoming/outgoing transaction         | Yes                     |
| `GET`  | `/api/v1/laporan/harian`    | Get daily operational report (filtered by date)   | Yes                     |
| `GET`  | `/api/v1/harga-jual`        | Get current selling prices and raw material costs | Yes                     |
| `POST` | `/api/v1/harga-jual/update` | Update selling prices and raw material costs      | Yes                     |

## 🤝 Contributing
Contributions are welcome! If you have suggestions for improvements or new features, please feel free to:

1.  **Fork** the repository. 🍴
2.  **Create a new branch** (`git checkout -b feature/AmazingFeature`).
3.  **Commit your changes** (`git commit -m 'Add some AmazingFeature'`).
4.  **Push to the branch** (`git push origin feature/AmazingFeature`).
5.  **Open a Pull Request**. ⬆️

For major changes, please open an issue first to discuss what you would like to change. 🙏

## ⚖️ License
This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). 

## 🔗 Important Links
*   **Repository**: [https://github.com/FAIZ-ADI-PRANAWA/Web-Manajemen-Pabrik-Mie-Soun-Purwanta-Klaten](https://github.com/FAIZ-ADI-PRANAWA/Web-Manajemen-Pabrik-Mie-Soun-Purwanta-Klaten)

<footer>
<p align="center">---
Made with ❤️ by Faiz Adi Pranawa (AI-generated content for this README) </p>
<p align="center">
  <a href="https://github.com/FAIZ-ADI-PRANAWA/Web-Manajemen-Pabrik-Mie-Soun-Purwanta-Klaten/fork">
    <img alt="Fork this repo" src="https://img.shields.io/badge/Fork%20Repo-blue?style=for-the-badge&logo=github" />
  </a>
  <a href="https://github.com/FAIZ-ADI-PRANAWA/Web-Manajemen-Pabrik-Mie-Soun-Purwanta-Klaten/stargazers">
    <img alt="Stars" src="https://img.shields.io/github/stars/FAIZ-ADI-PRANAWA/Web-Manajemen-Pabrik-Mie-Soun-Purwanta-Klaten?style=for-the-badge&logo=github" />
  </a>
  <a href="https://github.com/FAIZ-ADI-PRANAWA/Web-Manajemen-Pabrik-Mie-Soun-Purwanta-Klaten/issues">
    <img alt="Issues" src="https://img.shields.io/github/issues/FAIZ-ADI-PRANAWA/Web-Manajemen-Pabrik-Mie-Soun-Purwanta-Klaten?style=for-the-badge&logo=github" />
  </a>
</p>
</footer>

---
**<p align="center">Generated by [ReadmeCodeGen](https://www.readmecodegen.com/)</p>**