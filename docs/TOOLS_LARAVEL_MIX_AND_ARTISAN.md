# Laravel valet

Utilitzarem Valet for Linux: 

 https://github.com/cpriego/valet-linux
 https://cpriego.github.io/valet-linux/
 
Instal·lació:

```
composer global require cpriego/valet-linux
valet install
cd ~/Code/acacha
laravel park
```

Ara si la carpeta del projecte es diu tasks, aleshores la URL serà:

 http://tasks.test
 
 HTTPS:
 
```
valet secure tasks
```
 
# Laravel mix

Encarregat de la compilació assets Javascript, CSS i altres:

 https://laravel.com/docs/5.7/mix

```
npm run dev
```

## watch

No cal estar compilant cada vegada que canviem el codi, la iena vigila (watch) els canvis al codi i compila quan hi han canvis

```
npm run watch
```

## Hot (HMR -> Hot Module Replacement)

ës igual que el watch però a més actualitza el navegador (no cal fer F5)

```
npm run hot
```

Per funcionar cal apuntar el nostre app.js a:

```
    <script src="http://localhost:8080/js/app.js"></script>
```

Com la URL pot canviar:

```
<body>
    <div id="app"></div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
```

OCO HTTPS:

Canviar script per:

```
"scripts": {
    "hot": "NODE_ENV=development webpack-dev-server --inline --hot --https",
  }
```

Recursos:
- https://github.com/JeffreyWay/laravel-mix/blob/master/docs/hot-module-replacement.md

# ESLINT
