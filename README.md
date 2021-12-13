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

## Contributing

Coming soon

## License

[MIT](https://choosealicense.com/licenses/mit/)
