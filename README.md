##Install and run this app in your machine

1. Download the archive or clone the repo using git
2. Get into this project using `cd` command on your cmd or terminal
3. Run `composer install` on your cmd or terminal
4. Copy `.env.example` file to `.env` on the root folder. for windows run `copy .env.example .env` on cmd and for linux/mac run `cp .env.example .env` on terminal
5. Open `.env` file and change database name`(DB_DATABASE)` to whatever you have and chage `(DB_USERNAME)` and `(DB_PASSWORD)`
6. Run `php artisan key:generate`
7. Run `php artisan migrate`
8. Run `php artisan serve`
9. Go to [http://localhost:8000](localhost) on your favourite browser
