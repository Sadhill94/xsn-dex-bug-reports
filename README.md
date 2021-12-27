# XSN DEX bug reports

A simple SPA to let DEX users:
- Report bugs following a correct format
- Get information on where to get logs
- See what issues are already reported

## Tech stack

- Laravel 8
- Inertia.js
- Vue
- Tailwindcss

## Installation

Clone repo locally

```bash
git clone https://github.com/Sadhill94/xsn-dex-bug-reports.git
cd xsn-dex-bug-reports
```

Install PHP Dependencies

```bash
composer install
```

Install NPM Dependencies

```bash
npm install
```

Build assets

```bash
npm run dev
```

Setup Configuration

```bash
cp .env.example .env
```

Generate application key

```bash
php artisan key:generate
```

Run Database migrations

```bash
php artisan migrate
```

Run the base seeders for Categories and statuses

```bash
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=StatusSeeder
```

Run the base seeder for the manager role (don't forget to set the value for the password in the .env)
```bash
php artisan db:seed --class=UserSeeder
```

To test the render with issues and files
```bash
php artisan migrate:fresh --seed
```

## License

[MIT](https://choosealicense.com/licenses/mit/)
