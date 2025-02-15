# Todo List Management

A Laravel-based project for managing todo lists efficiently. This project includes real-time capabilities using Laravel Reverb and API documentation powered by `dedoc/scramble`.

---

## Features

- **Todo List Management**: Create, update, delete, and view todo lists.
- **Real-Time Updates**: Real-time functionality powered by Laravel Reverb.
- **API Documentation**: Automatically generated API docs using `dedoc/scramble`.
- **JAM Video Walkthrough**: A detailed video explaining the project setup and functionality.

---

## Installation

Follow these steps to set up the project locally:

### Step 1: Clone the Repository

```bash
git clone https://github.com/abdullah-alfar/todo-list-management
```

### Step 2: Navigate to the Project Directory

```bash
cd todo-list-management
```

### Step 3: Install Composer Dependencies

```bash
composer install
```

### Step 4: Set Up the Environment File

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Update the `.env` file with your database credentials and other environment variables:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_list
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Step 5: Generate an Application Key

```bash
php artisan key:generate
```

### Step 6: Run Database Migrations

```bash
php artisan migrate
```

### Step 7: Install Laravel Reverb

```bash
composer require laravel/reverb
```

Publish the Reverb configuration file:

```bash
php artisan vendor:publish --tag=reverb-config
```

### Step 8: Start the Reverb Server

```bash
php artisan reverb:start
```

### Step 9: Start the Laravel Development Server

```bash
php artisan serve
```

Your application will now be running at [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## API Documentation

API documentation is automatically generated using `dedoc/scramble`.

### Accessing the API Docs

Ensure the Laravel development server is running:

```bash
php artisan serve
```

Then visit:

[http://127.0.0.1:8000/docs/api](http://127.0.0.1:8000/docs/api)

---

## JAM Video Walkthrough

For a detailed walkthrough of the project, including setup and functionality, check out the JAM video:

**JAM Video: Todo List Management**

https://jam.dev/c/449db0ea-e977-4c4d-8b31-cf749fc8ae27

---

## Contributing

Contributions are welcome! To contribute, follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix:
   
   ```bash
   git checkout -b feature/your-feature-name
   ```
3. Commit your changes:
   
   ```bash
   git commit -m "Add your commit message here"
   ```
4. Push to the branch:
   
   ```bash
   git push origin feature/your-feature-name
   ```
5. Submit a pull request.

Please ensure your code follows the project's coding standards and includes appropriate tests.

---

## License

This project is open-source and available under the MIT License.

---

## Database Seed Information

### Admin User:
- **Email**: `admin@example.com`
- **Password**: `password`

### Normal User:
- **Email**: `test@example.com`
- **Password**: `password`
