
## Instructions

- clone the project using git clone.
- run composer install to generate vendor folder.
- add .env file to the project.
- create database on localhost and configure settings in .env file.
- generate app key for project using php artisan key:generate.
- run php artisan migrate to create migrations.
- run the project using php artisan serve.
- access project on http://localhost:8000.
- the project is ready to test.


## REST API
 postman collection document is accessible from project root with name POSTMAN_COLLECTION

- inorder to use api's you should first register a user with is_admin=1 otherwise you get authorization errors.
- Authentication's method is sanctum , when you register a user or login a user you get token to access api endpoints.
- use that token as bearer token in api authorization urls.
- when you register a user with is_admin=1 you will access all api's without authorization errors.

