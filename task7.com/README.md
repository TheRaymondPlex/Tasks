![Innowise Group Logo](public/images/inno-logo.png)
# Task 7 solution

# Run the application
- run `git clone https://github.com/TheRaymondPlex/Tasks/tree/Task7`.
- Install composer for PHP if you don't have it already.
- Install composer dependencies with `composer install`.
- Create table `users` in your database.
#### Table users:

| Field   | id                                                          | email                                    | first_name                 | second_name                | pass_word | created_date |
|---------|-------------------------------------------------------------|------------------------------------------|----------------------------|----------------------------|-----------|--------------|
| Options | INT() <br/> PRIMARY KEY <br/> NOT NULL <br/> AUTO_INCREMENT | VARCHAR(100) <br/> UNIQUE <br/> NOT NULL | VARCHAR(30) <br/> NOT NULL | VARCHAR(30) <br/> NOT NULL | CHAR(60)  | DATETIME     | 
- Rename `.env.example` file to `.env`.
- Fill the required fields in `.env` file with correct data.