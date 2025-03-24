# API REST

## Descripción

En esta segunda parte, se implementa una API REST que expone información del sistema para su integración con otros servicios.

## Endpoints

* GET /api/jugadores: Se obtiene la lista completa de jugadores.

* GET /api/jugadores/{id}: Se obtiene al jugador especifico con su id.

* POST /api/jugadores: Se agrega un jugador a la lista de jugadores.

* PUT /api/jugadores/{id}: Se edita al jugador especifico con su id.

* DELETE /api/jugadores/{id}: Se elimina al jugador especifico con su id.

* GET /api/jugadores?club={id_club}: Se filtran los jugadores y se obtienen solamente los pertenecientes al club con su id_club.

* GET /api/jugadores?ord=asc||desc:  Se obtienen los jugadores de forma ordenada por su nombre.

## Requisitos

* Códigos de respuesta: Manejo adecuado de 200, 201, 400 y 404.

* Opcionales: Paginación, filtrado avanzado y autenticación con token.

* Documentación: Se incluye en este README.
