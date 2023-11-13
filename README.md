# API-REST-Libreria-Virtual

DOCUMENTACIÓN DE LOS ENDPOINTS GENERADOS:

Cada uno se presenta en orden: "ENDPOINT, VERBO, CONTROLLER, MÉTODO".

- Endpoint GET textos:
  ('textos', 'GET', 'textoAPIController', 'get');

Este endpoint devuelve una lista de todos los textos. El método HTTP utilizado es GET. El controlador asociado es textoAPIController y el método asociado es get.

Ejemplo de uso:
GET localhost/WEB2/TPE3/API-REST-Libreria-Virtual/api/textos

- Endpoint GET textos/:ID:
  ('textos/:ID', 'GET', 'textoAPIController', 'get');

Este endpoint devuelve un texto específico con el ID especificado. El método HTTP utilizado es GET. El controlador asociado es textoAPIController y el método asociado es get.

Ejemplo de uso:
GET localhost/WEB2/TPE3/API-REST-Libreria-Virtual/api/textos/2

- Endpoint DELETE textos/:ID:
  ('textos/:ID', 'DELETE', 'textoAPIController', 'delete');

Este endpoint elimina un texto específico con el ID especificado. El método HTTP utilizado es DELETE. El controlador asociado es textoAPIController y el método asociado es delete.

Ejemplo de uso:
DELETE localhost/WEB2/TPE3/API-REST-Libreria-Virtual/api/textos/2

- Endpoint POST textos:
  ('textos', 'POST', 'textoAPIController', 'add');

Este endpoint crea un nuevo texto. El método HTTP utilizado es POST. El controlador asociado es textoAPIController y el método asociado es add.

Ejemplo de uso:
POST localhost/WEB2/TPE3/API-REST-Libreria-Virtual/api/textos -H "Content-Type: application/json" -d '{ "text": "Este es un nuevo texto." }'

- Endpoint PUT textos/:ID:
  ('textos/:ID', 'PUT', 'textoAPIController', 'update');

Este endpoint actualiza un texto específico con el ID especificado. El método HTTP utilizado es PUT. El controlador asociado es textoAPIController y el método asociado es update.

Ejemplo de uso:
PUT localhost/WEB2/TPE3/API-REST-Libreria-Virtual/api/textos/2 -H "Content-Type: application/json" -d '{ "text": "Este es un texto actualizado." }'

Lo mismo sucede con los endpoints del recurso "autor", a saber:

('autor/', 'GET', 'autorAPIController', 'get');
('autor/:ID', 'GET', 'autorAPIController', 'get');
('autor', 'POST', 'autorAPIController', 'add');
('autor/:ID', 'DELETE', 'autorAPIController', 'delete');
('autor/:ID', 'PUT', 'autorAPIController', 'update');

En general, estos endpoints se pueden utilizar para realizar operaciones básicas sobre textos, como obtener una lista de todos los textos, obtener un texto específico, eliminar un texto, crear un nuevo texto o actualizar un texto existente.
