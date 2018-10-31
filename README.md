# PhysicistsDen
Simple project in Vue and Laravel

---Requirements---
1.Composer - https://getcomposer.org/download/
After downloading composer, download laravel via composer from command line.
2.Laravel - composer global require laravel/installer

---Project Setup---
After downloading composer and laravel ,go to project via command line, run this commands to install.

1.composer install
2.npm install

3.Rename .env-example to .env (should be downloaded for you,if you don't have such file,
download it from here:
https://github.com/laravel/laravel/blob/master/.env.example)

You need to generate unique key for your app:
4.php artisan key:generate

5. In .env file change:
DB_DATABASE - name of the database
DB_USERNAME - according to your database settings
DB_PASSWORD - according to your database settings

6.Create Database(via cmd or GUI), name must be same as in .env file

Create tables,run seeders using this command:
7.php artisan migrate:refresh --seed

---Note---
If you are not registred (guest), you can only login or register,
everything else is blocked by auth.
