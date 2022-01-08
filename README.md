# XSN DEX feedbacks

A simple WebApp to let DEX users:
- Report bugs following a correct format
- Submit feature request(s)
- Browse issues/features already reported
- Get information on where to get their logs, or on the different categories

It includes a manager role and a contributor role.

Contributor will be able to see the attachments section on a ticket detail (when visitors can't), he will be able to download it aswell

Manager will be able to edit tickets, remove or add files on them.

## Tech stack

- Laravel 8
- Inertia.js
- Vue
- Tailwindcss

## Installation

Clone repo locally

```bash
git clone https://github.com/Sadhill94/xsn-dex-feedbacks.git
cd xsn-dex-feedbacks
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

Run the base seeders for Categories and statuses and types

```bash
php artisan db:seed --class=CategorySeeder
php artisan db:seed --class=StatusSeeder
php artisan db:seed --class=TypeSeeder
```

Run the base seeder for the manager role (don't forget to set the value for the password in the .env)
```bash
php artisan db:seed --class=UserSeeder
```

To test the render with issues and files, uncomment the Issue and FileSeeder on the DatabaseSeeder.php and run
```bash
php artisan migrate:fresh --seed
```

## License

[MIT](https://choosealicense.com/licenses/mit/)
