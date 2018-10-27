# Session Authentication (web)

- HTTP és un protocol sense estat: no té forma propia de mantenir informació comuna entre peticions HTTP
- Que HTTP no tingui la eina no vol dir que no puguem fer-ho

Opcions per compartir informació entre peticions HTTP
- Petició 1 crida a petició 2 i passa dades a compartir per GET o POST. En posteriors peticions està informació es perd 
a no ser que es continui la cadena (Petició 2 passi info a petició 3 i així consecutivament)
- Sessió:
  - Mantenir informació durant una sèrie llarga de peticions
  - Hi ha un inici de sessió i una finalització (sol coincidir però no té pq amb el Login i Logout)
- L'estat de la sessió es pot persistir de diverses formes:
  - Fitxers
  - Cockies
  - base de dades
  - Estes formes anomenem drivers i no haurien afectar la nostra api (el nostre codi)  
- Cas anterior: quan es guarda informació en sessió només per a la següent petició anomenem flash

# Token authentication (API)

Utilitzarem Laravel passport

# Laravel Authentication

## Config

Fitxer de config: **config/auth.php** 

# Recursos

- https://laravel.com/docs/5.7/authentication
- https://laravel.com/docs/5.7/passport
