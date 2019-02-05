USER AVATAR

```
composer require hashids/hashids
```

Configuració
- A fitxer .env afegir (random): TASKS_SALT
- config/tasks.php: TASKS_SALT
- Class user
- Propietat $appends
- Mètodes: hashedKey i getHashIdAttribute

Classe UserTest:
- test hash_id

Helpers:

- function is_valid_uuid

DatabaseNotification:
- Copiar test unitari
- Copiar Model  DatabaseNotification
