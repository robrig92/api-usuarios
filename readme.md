URLS:

Crear usuario
Method: POST
body-json:
'username' => 'string' requerido debe ser único,
'email' => 'string' requerido. debe ser único,
'names' => 'string' requerido,
'password' => 'string' requerido,
'paternal_surname' => 'string' requerido
'maternal_surname' => 'string'
'age' => 'integer|nullable',
'role' => 'integer' requerido, ID del registro en database,
'permissions' => 'array' requerido, Con IDs de cada permission en database,
127.0.0.1:8000/api/users/roles

Ver todos usuarios
Method: GET
127.0.0.1:8000/api/users/roles/1

Ver por rol
Method: GET
Params: id - Identificador del rol
127.0.0.1:8000/api/users/roles/{id}

Ver por permiso
Method: GET
Params: id - Identificador del permiso
127.0.0.1:8000/api/users/permissions/{id}

Ver por activo
Method: GET
Params: activo - 1, 0
127.0.0.1:8000/api/users/active

Actualizar usuario
Method: PATCH
Params: id - ID del recurso usuario
body-json:
'username' => 'string' requerido debe ser único,
'email' => 'string' requerido. debe ser único,
'names' => 'string' requerido,
'password' => 'string',
'paternal_surname' => 'string' requerido
'maternal_surname' => 'string'
'age' => 'integer|nullable',
'role' => 'integer' ID del registro en database,
'permissions' => 'array' Con IDs de cada permission en database,
127.0.0.1:8000/api/users/roles/1

Eliminar usuario
Method: DELETE
Params: id - ID del recurso usuario
127.0.0.1:8000/api/users/{id}