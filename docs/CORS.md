# CORS

localhost/:1 Failed to load http://127.0.0.1:8050/api/v1/tasks: No 'Access-Control-Allow-Origin' header is present on the requested resource. Origin 'http://localhost:8080' is therefore not allowed access.

Resources:
- https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS

# Troubleshooting. Resol·lució de problemes

## CORS. Failed to load URL: No 'Access-Control-Allow-Origin' header is present on the requested resource. Origin ... is therefore not allowed access.

IMPORTANT: CORS no caldrà quan l'aplicació client/frontend i la backend/server siguin al mateix domini

Cal instal·lar la llibreria de Laravel:

 https://github.com/barryvdh/laravel-cors
 
```
$ composer require barryvdh/laravel-cors
```

I afegir Middleware:

```
protected $middleware = [
    // ...
    \Barryvdh\Cors\HandleCors::class,
];
```