# FRONTEND

## USER PHOTOS AMB URL

- Test: copieu UserPhotoControllerTest
- Copieu els fixtures
- Afegiu rutes a web.php
- Copieu el route bind
- TODO

## NotificationsWidget

- Borreu el que vam començar
- Poseu el que us proporciono

## Components Vue

- Copieu tots els components de la carpeta notifications
- Copieu component UserSelectComponent
- Registreu els components a app.js (veure fitxer professor)
 
## VISTES

## Menú/Mòdul nou
- Creeu la entrada de menu Notificacions apuntant a la URL /notifications
   - Fitxer Navigation.vue

## /notifications

- Afegiu dos helpers:
  - set_sample_notifications_to_user($user);
  - sample_notifications();
  - map_simple_collection
- Copieu Test web: NotificationsControllerTest
  - Executeu i aneu arreglant problemes:
  - Afegiu ruta web a routes/web.php
  - Copieu controlador: NotificationController
  - Copieu els objectes Request
  - Copieu la vista

# BACKEND

## API
- Nou Rol: Afegiu rol: NotificationsManager
- Copieu tots els testos api de notificacions (carpeta Api/Notificacions): NotificationsControllerTest
- Executeu testos i aneu arreglant problemes:
  - api.php: Cal afegir Rutes api 
  - Copie controladors: NotificationsController, UserNotificationsController i SimpleNotificationsController

## USER AVATAR

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

## SimpleNotification

Copieu la notificació simple App\Notifications\SimpleNotification

Instal·leu les notificacions de base de dades Laravel:

```
php artisan notifications:table
php artisan migrate
```


# Helpers:

- function is_valid_uuid

DatabaseNotification:
- Copiar test unitari
- Copiar Model DatabaseNotification
