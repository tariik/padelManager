# Backend

 ```sh
$ cd backend
$ composer install
$ php artisan migrate
$ php artisan passport:install
$ php artisan db:seed
$ php artisan serve 
```
 el app incluye excepcionalmente por la prueba el fichero `${.env}`

# Frontend
    
 ```sh
$ cd clientapp
$ npm install
$ ng serve
```
  - cambiar el clave `client_secret`  y el `client_id` en la carpeta `clientapp/src/app/services/global.ts`  
