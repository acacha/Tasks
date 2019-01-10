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

## API JSON
