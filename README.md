# CS2TP - Group 55
Group Members: <br>
Ma Basimah - 230248896; 230248896@aston.ac.uk <br>
Uzair Butt - 240229870; 240229870@aston.ac.uk <br>
Thomas Harvey - 240168801; 240168801@aston.ac.uk <br>
Kawthar Karim - 240087764; 240087764@aston.ac.uk <br>
Hamza Awad - 220081621; 220081621@aston.ac.uk <br>
Aliyan Ramday - 230126505; 230126505@aston.ac.uk <br>
Cameron Swaby - 240193227: 240193227@aston.ac.uk <br>
Ayomide Aidevbo Bola-Monite - 240362605; [email] <br> 

### Required Installations: <br>
- PHP <br>
- Laravel <br>
- Composer <br>
- Node.js <br>
- XAMPP <br>
- Git <br>

Ensure SQL and Apache are running inside XAMPP and go to http://localhost/phpmyadmin/; import SQL script in clothes-shop/database/sql to create "theclothe55shop" database OR create empty "theclothe55shop" database and run "php artisan migrate" <br>

After cloning respository and opening it inside an IDE, run inside terminal: <br>
cd clothes-shop <br>
composer install <br>
npm install <br>
npm run dev <br>

In a new terminal, run: <br>
cd clothes-shop <br>
cp .env.example .env <br>
php artisan key:generate <br>

In the newly created file named ".env", replace lines 23 to 28 with: <br>
DB_CONNECTION=mysql <br>
DB_HOST=127.0.0.1 <br>
DB_PORT=3306 <br>
DB_DATABASE=theclothe55shop <br>
DB_USERNAME=root <br>
DB_PASSWORD= <br>

In a new terminal, run: <br>
cd clothes-shop <br>
php artisan migrate <br>
php artisan serve <br>

Then open "http://127.0.0.1:8000" <br>

In another terminal, run: <br>
npm run dev <br>
