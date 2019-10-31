Instalación<br/>
<br/>
Clonar el repositorio<br/>
Crear archivo .env<br/>
    configurar base de datos<br/>
ejecutar composer install<br/>
Generar llave php artisan key:generate<br/>
php artisan migrate<br/>
composer dump-autoload<br/>
php artisan gb:seed<br/>
php artisan serve para instancia local<br/>
Enjoy!<br/>
<br/>
URLS:
<br/>
Crear usuario<br/>
Method: POST<br/>
body-json:<br/>
'username' => 'string' requerido debe ser único,<br/>
'email' => 'string' requerido. debe ser único,<br/>
'names' => 'string' requerido,<br/>
'password' => 'string' requerido,<br/>
'paternal_surname' => 'string' requerido<br/>
'maternal_surname' => 'string'<br/>
'age' => 'integer|nullable',<br/>
'role' => 'integer' requerido, ID del registro en database,<br/>
'permissions' => 'array' requerido, Con IDs de cada permission en database,example: "permissions":[1,2,3,4]<br/>
127.0.0.1:8000/api/users<br/>
<br/>
Ver usuario<br/>
Method: GET<br/>
Params: id - ID del usuario</br>
127.0.0.1:8000/api/users/{id}<br/>
<br/>
Ver todos usuarios<br/>
Method: GET<br/>
127.0.0.1:8000/api/users<br/>
<br/>
Ver por rol<br/>
Method: GET<br/>
Params: id - Identificador del rol<br/>
127.0.0.1:8000/api/users/roles/{id}<br/>
<br/>
Ver por permiso<br/>
Method: GET<br/>
Params: id - Identificador del permiso<br/>
127.0.0.1:8000/api/users/permissions/{id}<br/>
<br/>
Ver por activo<br/>
Method: GET<br/>
Params: activo - 1, 0<br/>
127.0.0.1:8000/api/users/active/{active}<br/>
<br/>
Actualizar usuario<br/>
Method: PATCH<br/>
Params: id - ID del recurso usuario<br/>
body-json:<br/>
'username' => 'string' requerido debe ser único,<br/>
'email' => 'string' requerido. debe ser único,<br/>
'names' => 'string' requerido,<br/>
'password' => 'string',<br/>
'paternal_surname' => 'string' requerido<br/>
'maternal_surname' => 'string'<br/>
'age' => 'integer|nullable',<br/>
'role' => 'integer' ID del registro en database,<br/>
'permissions' => 'array' Con IDs de cada permission en database, example: "permissions":[1,2,3,4]<br/>
127.0.0.1:8000/api/users/roles/1<br/>
<br/>
Eliminar usuario<br/>
Method: DELETE<br/>
Params: id - ID del recurso usuario<br/>
127.0.0.1:8000/api/users/{id}<br/>