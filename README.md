# TPE2
/api/jugadores    Con GET se obtiene la lista completa de jugadores. 
                  Con Post se agrega un jugador a la lista de jugadores.

/api/jugadores/id   Con GET se obtiene al jugador especifico con su id.
                    Con DELETE se elimina al jugador especifico con su id.
                    Con PUT se edita al jugador especifico con su id.
                  
/api/jugadores?club=id_club   Se filtran los jugadores y se obtienen solamente los pertenecientes al club con su id_club.

/api/jugadores?ord=asc||desc  Se obtienen los jugadores de forma ordenada por su nombre.
