# PhysicistsDen
Simple project in Vue and Laravel
<br />
---Requirements---
1.Composer - https://getcomposer.org/download/ <br />
After downloading composer, download laravel via composer from command line. <br />
2.Laravel - composer global require laravel/installer <br />

---Project Setup--- <br />
After downloading composer and laravel ,go to project via command line, run this commands to install.<br /><br />

1.composer install<br /><br />
2.npm install<br /><br />

3.Rename .env-example to .env (should be downloaded for you,if you don't have such file,<br /><br />
download it from here:<br /><br />
https://github.com/laravel/laravel/blob/master/.env.example)<br /><br />

You need to generate unique key for your app:<br /><br />
4.php artisan key:generate<br /><br />

5. In .env file change:<br /><br />
DB_DATABASE - name of the database<br /><br />
DB_USERNAME - according to your database settings<br /><br />
DB_PASSWORD - according to your database settings<br /><br />

6.Create Database(via cmd or GUI), name must be same as in .env file<br />

Create tables,run seeders using this command:<br />
7.php artisan migrate:refresh --seed<br />

---Note---<br />
If you are not registred (guest), you can only login or register,<br />
everything else is blocked by auth.
