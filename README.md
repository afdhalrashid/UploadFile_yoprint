# UploadFile_yoprint

A Laravel application for processing CSV file uploads with queue processing capabilities. This application uses Laravel Livewire for real-time file upload handling and Laravel Horizon for queue management.

## Features

- CSV file upload processing
- Real-time upload progress with Livewire
- Queue-based file processing with Laravel Horizon
- Product data management
- SQLite database support

## Requirements

- PHP >= 8.4
- Composer
- Node.js & NPM
- Redis (for queue processing)

## Installation

1. Clone the repository
```bash
git clone https://github.com/afdhalrashid/UploadFile_yoprint.git
cd UploadFile_yoprint
```

2. Install PHP dependencies
```bash
composer install
```

3. Install JavaScript dependencies
```bash
npm install
```

4. Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure your database in .env file
```
DB_CONNECTION=sqlite
DB_DATABASE=absolute/path/to/your/database.sqlite
```

6. Run migrations
```bash
php artisan migrate
```

7. Build assets
```bash
npm run build
```

8. Start the Laravel Horizon for queue processing
```bash
php artisan horizon
```

9. Start the development server
```bash
php artisan serve
```

## Usage

1. Access the application at `http://localhost:8000`
2. Use the file upload interface to upload CSV files
3. Monitor queue processing through Horizon at `http://localhost:8000/horizon`

## Queue Processing

This application uses Redis for queue processing. Make sure Redis is installed and running on your system. The queue processing is handled by Laravel Horizon, which provides a beautiful dashboard to monitor your queue metrics.

## File Upload Specifications

- Maximum file size: 40MB
- Supported format: CSV
- Processing: Async via Redis queue

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License

[MIT](https://choosealicense.com/licenses/mit/)
