# city-country-api
 creating a Laravel application that fetches data from external APIs for cities and countries, allows users to create groups of cities and countries, and provides an API to retrieve the grouped data

### Prerequisites:

- **PHP:** Ensure PHP is installed on your system. You can download it from [PHP Downloads](https://www.php.net/downloads.php) or use a package manager like Homebrew (for macOS) or apt (for Linux).
- **Composer:** Install Composer, a PHP dependency manager. You can download it from [Composer Downloads](https://getcomposer.org/download/).
- **Database:** Set up a database (MySQL, PostgreSQL, SQLite, etc.) and note down the credentials.

### Steps to Set Up and Run the Laravel Application:

1. **Clone the Repository:**
   Clone the GitHub repository of your Laravel application:

   ```bash
   git clone <repository_url>
   cd <project_folder>
   ```

2. **Install Dependencies:**
   Use Composer to install PHP dependencies:

   ```bash
   composer install
   ```

3. **Environment Configuration:**
   - Create a copy of the `.env.example` file and name it `.env`.
   - Update the `.env` file with your database credentials, app URL, and any other necessary configurations:

     ```bash
     cp .env.example .env
     ```

4. **Generate Application Key:**
   Generate an application key using the Artisan command:

   ```bash
   php artisan key:generate
   ```

5. **Run Migrations and Seeders (if any):**
   If your application includes database migrations and seeders, run them to set up the database tables and populate initial data:

   ```bash
   php artisan migrate --seed
   ```

6. **Start the Development Server:**
   Run the Laravel development server:

   ```bash
   php artisan serve
   ```

   This will start the server at `http://localhost:8000` by default.

7. **Access the Application:**
   Open your web browser and navigate to `http://localhost:8000` or the URL where the development server is running.

### Additional Steps:

- **Cache and Optimization:** Optionally, run cache-related commands to optimize your application:

  ```bash
  php artisan cache:clear
  php artisan config:cache
  php artisan route:cache
  ```
