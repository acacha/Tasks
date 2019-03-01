# Webpack

https://laracasts.com/series/webpack-for-everyone

# Petits temes performance

- npm run dev: Observeu la llista de chunks que es detecten al final del procés:
  - [ ] Cal evitar chunks pesin massa -> En groc surten els BIG cal fer més petits i en Vermell els extrems
  
# Comparativa production vs environment

- Canvieu de branques i comproveu que les mides de fitxers han millorat

Exemple production

```
$ git checkout production
$ ls -lah public/tenant/js 
total 14M
drwxrwxr-x 2 sergi sergi 4,0K de ma  1 10:26 .
drwxrwxr-x 4 sergi sergi 4,0K d’abr 21  2018 ..
-rw-r--r-- 1 sergi sergi 826K de ma  1 10:26 app.js
-rw-r--r-- 1 sergi sergi  11M de ma  1 10:26 app.js.map
-rw-r--r-- 1 sergi sergi 1,5K de ma  1 10:26 manifest.js
-rw-r--r-- 1 sergi sergi 2,4M de ma  1 10:26 vendor.js
```

Cache busting:
```
cat public/mix-manifest.json 
{
    "/tenant/js/app.js": "/tenant/js/app.js?id=88df0e3bd2b318a0a42c",
    "/tenant/css/app.css": "/tenant/css/app.css?id=c83bc773c0d110b4c9ed",
    "/tenant/js/manifest.js": "/tenant/js/manifest.js?id=3d5166988b50734f26c5",
    "/tenant/js/vendor.js": "/tenant/js/vendor.js?id=eb433e250672e2554561"
}
``` 

# Cache busting (bust: reventar)

- https://www.keycdn.com/support/what-is-cache-busting
- Cal configurar servidor Apache/Nginx:
  - https://leaderinternet.com/blog/leverage-browser-caching-laravel-forge
- La tècnica és que cada cop que un fitxer canvia li canviem el nom tipus: app-v1.js to app-v2.js
  -  Com fer-ho a mà és un pal es poden utilitzar hash
  - Per que funcioni cal carregar el fitxer app.js o el app.cs o els que convinguin amb el helper mix:
  
  <script src="{{ mix('/js/app.js') }}"></script>

  - El que fa Laravel mix és utilitzar el fitxer mix-manifest.json. Amb cache busting:

```
  cat public/mix-manifest.json
  {
      "/tenant/js/app.js": "/tenant/js/app.js?id=7013cb7ad92e282b2b94",
      "/tenant/css/app.css": "/tenant/css/app.css?id=d9f389693f5cc51d0c97",
      "/tenant/js/manifest.js": "/tenant/js/manifest.js?id=954ca82b8b21238db005",
      "/tenant/js/vendor.js": "/tenant/js/vendor.js?id=d222f443b64fddafaebb"
  }
```

Sense:
```
cat public/mix-manifest.json
{
    "/tenant/js/app.js": "/tenant/js/app.js",
    "/tenant/css/app.css": "/tenant/css/app.css",
    "/tenant/js/manifest.js": "/tenant/js/manifest.js",
    "/tenant/js/vendor.js": "/tenant/js/vendor.js"
}
```
- Si es combina amb un augment dels temps que es cachejant certs recursos als servidors és una millora molt important de rendiment 
tan a client com a servidor:
  
https://leaderinternet.com/blog/leverage-browser-caching-laravel-forge
A /etc/nginx/sites-available cadascú al seu fitxer cal afegir:

```
# browser caching of static assets
location ~*  \.(jpg|jpeg|png|webp|gif|ico|css|js|pdf)$ {
    expires 365d;
}
location = /sw.js {
    add_header 'Cache-Control' 'no-store, no-cache, must-revalidate, proxy-revalidate, max-age=0';
    expires off;
    proxy_no_cache 1;
}
```
Reiniciar nginx i veure no us heu carregat el servidor

- En local no té sentit: i ho rebentem continuament amb Shift+F5

Com comprovar si hi ha cache o no:

```
curl -I -L URL | grep cache-control
```

Ha de sortir 604800 = 7dies o 31536000 | = 365d

- Crec que per defecte la cache guarda els fitxers 1 dia?
- https://developers.google.com/web/fundamentals/performance/optimizing-content-efficiency/http-caching?hl=es

## Cache sw.js

Este no ens interesa fer cache:

```
location = /sw.js {
    add_header 'Cache-Control' 'no-store, no-cache, must-revalidate, proxy-revalidate, max-age=0';
    expires off;
    proxy_no_cache 1;
}
```

```
sudo apt-get install curl
curl -I -L https://workbox-demos.firebaseapp.com/demo/workbox-core/sw.js | grep cache-control
```


# SOURCE MAPS

- Ctrl+shift+P: i busqueu source maps
- https://blog.teamtreehouse.com/introduction-source-maps
- https://www.html5rocks.com/en/tutorials/developertools/sourcemaps/
- https://webpack.js.org/configuration/devtool/
- https://itnext.io/using-sourcemaps-on-production-without-revealing-the-source-code-%EF%B8%8F-d41e78e20c89

- mix.sourceMaps(): incovenvenient -> el fitxer .js és encara més gran!
- OPCIÓ RECOMANADA: mix.sourceMaps(false) -> a producció no es generen els source maps

# VENDOR EXTRACTION

- mix.js(.....).extract(['vue'])
- https://laravel.com/docs/5.7/mix#vendor-extraction
- https://laravel-mix.com/docs/4.0/extract
- Crearà tres fitxers:
  - public/js/manifest.js-> Necessari per juntar vendor i app.js
  - public/js/vendor.js -> El codi de vendors que haguim extret
  - public/js/app.js -> El nostre codi
- Cal canviar el codi
- Incovenients: Dos peticions HTTP REQUEST EXTRES-> Però millor funcionament cache busting

Observeu com queda abans i després de fer el canvi:
- 

```
$ ls -la public/tenant/js 
total 43180
drwxrwxr-x 2 sergi sergi     4096 de ma  1 09:33 .
drwxrwxr-x 4 sergi sergi     4096 d’abr 21  2018 ..
-rw-r--r-- 1 sergi sergi 27937328 de ma  1 09:36 app.js
-rw-r--r-- 1 sergi sergi 11241461 de fe 28 18:55 app.js.map
```

```
ls -la public/tenant/js
total 26776
drwxrwxr-x 2 sergi sergi     4096 de ma  1 09:33 .
drwxrwxr-x 4 sergi sergi     4096 d’abr 21  2018 ..
-rw-r--r-- 1 sergi sergi 11139396 de ma  1 09:39 app.js
-rw-r--r-- 1 sergi sergi 11241461 de fe 28 18:55 app.js.map
-rw-r--r-- 1 sergi sergi     8925 de ma  1 09:33 manifest.js
-rw-r--r-- 1 sergi sergi  5011202 de ma  1 09:33 vendor.js
```

RESUM:
- app.js sense source maps: 11139396 -> 11M
- Amb source maps: 27937328 -> 27M  -> Desactivar a producció!!!!!!
- app.js extract vue: 22959441 -> 22M vendor: 5011202 -> 4,8 manifest: 8,8K
