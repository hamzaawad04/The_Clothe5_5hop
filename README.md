# CS2TP - Group 55
Group Members: <br>
Ma Basimah - 230248896; [email] <br>
Uzair Butt - 240229870; 240229870@aston.ac.uk <br>
Thomas Harvey - 240168801; 240168801@aston.ac.uk <br>
Kawthar Karim - 240087764; 240087764@aston.ac.uk <br>
Hamza Awad - 220081621; 220081621@aston.ac.uk <br>
Aliyan Ramday - 230126505; 230126505@aston.ac.uk <br>
Cameron Swaby - 240193227: 240193227@aston.ac.uk <br>
Ayomide Aidevbo Bola-Monite - 240362605; [email] <br> 

Required Installations:
- PHP
- Laravel
- Composer
- Node.js
- XAMPP
- Git

Ensure SQL and Apache are running inside XAMPP and go to http://localhost/phpmyadmin/ and create a new database called "theclothe55shop"

After cloning respository and opening inside an IDE, run inside terminal:
cd clothes-shop
composer install
npm install
npm run dev

In a new terminal, run:
cd clothes-shop
cp .env.example env
php artisan key:generate

In the newly created file named ".env", replace lines 23 to 28 with:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=theclothe55shop
DB_USERNAME=root
DB_PASSWORD=

In a new terminal, run:
cd clothes-shop
php artisan migrate
php artisan serve

Then open "http://127.0.0.1:8000"

In another terminal, run:
npm run dev
