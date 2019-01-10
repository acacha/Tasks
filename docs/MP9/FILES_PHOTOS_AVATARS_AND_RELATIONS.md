https://medium.com/@sergiturbadenas/uploading-utilitzant-vuetify-i-javascript-e7fdfb887632

# Usuaris, avatars i Photos

La idea és fer un sistema complet per forçar provar tot tipus de relacions

- Photo: Relació 1 a 1
- Avatar: Relació 1 a n -> Pugui guardar una llista avatars però només hi hagui un sigui el activat
- Gravatar: sistema de fallback sinó té fotos ni avatars aleshores utilitzar Gravatar 

# Images

- https://laravel.com/docs/5.7/eloquent-relationships#polymorphic-relationships
- Provar relacions polimorfiques, múltiples recursos (tasques, usuaris, tags, etc) poden tenir imatges relacionades
- També li podriem dir fitxers directament i ser més oberts a adjuntar qualsevol tipus de fitxer

# Files

Mateix idea que amb imatges

# Llista de fitxers que heu de copiar:

Model Photo:
- tests/Unit/PhotoTest
- Primer copieu només el test, i comprovoveu tot el que us falta per passar el test (aneu executant i a partir error aneu copiant fitxers falten):
  - Executeu test map:
    - [X] Us demanara la classe/Model Photo. Afegiu Photo
    - X] Us demanara la taula-> Afegiu la migració
  - Executeu test setUser
    - [ ] Observeu que passa si treieu/comenteu els mètodes user i setUser
    - [ ] Observeu la diferència entre belongsTo i hasOne com el id de la relació és mou d'una taula a un altre
    - [ ] Quina diferència hi ha amb una relació 1 a n? A la taula photos el camp user_id serà únic no hi hauran dos o més photos per un usuari
       - Aquesta última restricció la podem afegir a la definició de la taula/migració

Model Avatar
- Repetiu procediment seguit a Model Photo

Canvis al model User
- Relació 1 a 1 photo
  - Afegiu test  assignPhoto a userTest: 
     - [ ] Executeu test assignPhoto. Us donarà errors pq no hi ha la relació photo i el mètode assignPhoto a User. Afegiu
- Relació 1 a n avatars
  - Afegiu test addAvatar a userTest: 
   - [ ] Executeu test addAvatar. Us donarà errors pq no hi ha la relació avatars i el mètode addAvatar a User. Afegiu
   
# User Profile

URL: /profile

- Afegiu el test tests/Feature/ProfileControllerTest
- Afegiur la ruta /profile a web.php
- Afegiu el controlador: ProfileController
- Afegiu la vista: profile
- Afegiu el component: profile i registreu-lo a app.js
- Components secundaris: material-card

# UPLOAD FILE

- Docs: https://laravel.com/docs/5.7/filesystem#file-uploads
- Testing docs: https://laravel.com/docs/5.4/http-tests#testing-file-uploads

## WEB
- Copieu el test PhotoControllerTest
- Copieu la ruta POST (web.php) /photo
- Copieu el controlador
- Afegiu window.csrf_token a app.js
- Prepareu la base de dades php artisan migrate:fresh --seed -v
- Proveu el formulari POST que us proporciono

## API JSON

- TODO UPLOAD AVATAR PERO AMB JSON

# LOCAL vs PUBLIC
- Molt de compte amb public: per seguretat no posar fitxers amb dades personals o fitxers confidencials
- Els fitxers de local es poden mostrar "públicament" però de forma controlada a partir d'un controlador
- GET -> /user/photo Mostra només per als usuaris logats la photo de l'usuari logat
- Afegir test, controlador i ruta i el que calgui per fer funcionar /user/photo
- https://laravel.com/docs/5.7/responses#file-downloads

# IMAGES CACHE AND REFRESH

Si canviem la imatge Avatar/Photo cal fer Shift+F5 per actualitzar la cache:

Opcions:
- Cache headers: no cache -> poc eficient
- Canviar la URL: La url sigui diferent cada cop canvia imatge -> hash de la imatge

# Google Drive

Utilitzar drive com unitat on guardar els fitxers
- En aquest cas l'utilitzarem com unitat extra-> es guarda en local i també a drive

```
composer require nao-pon/flysystem-google-drive
```

CONFIG:

A **config/filesystems.php**:

```
'google' => [
            'driver' => 'google',
            'clientId' => env('GOOGLE_DRIVE_CLIENT_ID'),
            'clientSecret' => env('GOOGLE_DRIVE_CLIENT_SECRET'),
            'refreshToken' => env('GOOGLE_DRIVE_REFRESH_TOKEN'),
            'folderId' => env('GOOGLE_DRIVE_FOLDER_ID'),
        ],
```

Crear un Provider:

```
php artisan make:provider GoogleDriveServiceProvider
```

a boot posar:

```
\Storage::extend('google', function ($app, $config) {
    $client = new \Google_Client();
    $client->setClientId($config['clientId']);
    $client->setClientSecret($config['clientSecret']);
    $client->refreshToken($config['refreshToken']);
    $service = new \Google_Service_Drive($client);
    $adapter = new \Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter($service, $config['folderId']);
    return new \League\Flysystem\Filesystem($adapter);
});
```

a **config/app.php** registrar el provider:

Ara configureu Google:

Passos a seguir:
- Logar-se a Google Drive amb un compte de Gmail
- Anar a https://console.developers.google.com i crear un nou projecte (nom tasks)
- Fer clic a Enable APIs and Services -> Buscar Google Drive
- Activar la API fent click a Enable
- Fer clic a Manage
- Anar a credentials
- Fer clic a Crear Credenciales
  - ID de cliente de Oauth
  - Configurar pantalla de consentimiento
  - Posar nom a la app i el nom de domini i omplir totes les URL apuntant a la pàgina: http://tasks.sergitur.scool.cat (acapteu vostre cas)
  - Tornar a Id de cliente oauth i continuar usant Aplicación Web
  - Nom: Aplicació Tasques
  - URLS consentimiento: http://tasks.test | https://developers.google.com/oauthplayground
- Aneu al vostre compte d'usuari i afegiu una carpeta a Google Drive. Entreu a la carpeta i copieu de la URL el ID:

GOOGLE_DRIVE_FOLDER_ID=1Q57lZ5qV43z8bfAfs6JutEQcGh__NFHL
  
- Cal repetir procediment per a explotació
- Guardar credencials a .env:

GOOGLE_DRIVE_CLIENT_ID=20710478546-60h29mddnaogd9u13qhhda765q126aut.apps.googleusercontent.com
GOOGLE_DRIVE_CLIENT_SECRET=tXJ78qwWb45qTMavmEiT_9nXXy

- Guardar credencials a .env.production i pujar al servidor

Finalment per comprovar si funciona:

```php
php artisan tinker     
>>> Storage::disk('google')->makeDirectory('prova');
```  	

PROVES:
- https://developers.google.com/oauthplayground/


# TODO
- /user/avatar -> Només mostrar imatge per defecte si no hi ha imatge Gravatar per l'usuari
