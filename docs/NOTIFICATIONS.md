USER AVATAR

```
composer require hashids/hashids
```

Configuració
- A fitxer .env afegir (random): TASKS_SALT
- config/tasks.php: TASKS_SALT
Classe UserTest:
- test hash_id

Class user
- Mètodes: hashedKey i getHashIdAttribute


Helpers:

- function is_valid_uuid

DatabaseNotification:
- Copiar test unitari
- Copiar Model DatabaseNotification
