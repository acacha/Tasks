# COMANDA CLI?

- https://laravel.com/docs/5.7/artisan
- https://laravel.com/docs/5.7/console-tests
- https://themsaid.com/laravel-artisan-commands-testing-20180825
- https://laravel.com/docs/5.7/console-tests

Com ho he fet?

EXAMPLES signatures:

```
command:name {file} // Required Argument
command:name {file?} // Optional Argument
command:name {file=app} // Optional Argument with default value
command:name {file} {--no-creation} // An option with true or false
command:name {file} {--key=} // An option that requires a value
command:name {file} {--key=default} // Accepts a value with a default
```

Testos:
- error_if_file_not_found
- ask_for_a_file_if_path_not_provided
- test_backup_file_is_created
- test_file_size_is_reduced

```
php artisan make:test ImgOptimizeTest
php artisan make:command ImgOptimize --command=img:optimize
```

- signature: 'img:optimize {path?}';

```
php artisan tinker img:optimize PATH_TO_IMAGE
```

-https://themsaid.com/building-testing-interactive-console-20160409

# OPTIMITZACIÓ IMATGES 

- JpegOptim, Optipng, Pngquant 2, SVGO, Gifsicle
- Laravel multimedia

```
sudo apt-get install jpegoptim
sudo apt-get install optipng
sudo apt-get install pngquant
sudo npm install -g svgo
sudo apt-get install gifsicle
```

## PHP

- https://github.com/spatie/image-optimizer/blob/master/README.md
- https://github.com/spatie/image-optimizer/blob/master/README.md#example-conversions

## JPEG
- all-progressive: https://www.liquidweb.com/kb/what-is-a-progressive-jpeg/

```
sudo apt-get install jpegoptim
```

- http://freshmeat.sourceforge.net/projects/jpegoptim

# Recursos
- https://medium.com/@macropus/optimizing-converting-images-8d10ae559586
- https://developers.google.com/speed/docs/insights/OptimizeImages
- https://github.com/spatie/image-optimizer
- https://murze.be/easily-optimize-images-using-php-and-some-binaries
- https://developers.google.com/web/fundamentals/performance/optimizing-content-efficiency/image-optimization#image_optimization_checklist

# QUIN FORMAT UTILITZAR?

https://developers.google.com/web/fundamentals/performance/optimizing-content-efficiency/images/format-tree.png

# AJUSTAR LAS IMATGES A LA MIDA QUE S'UTILITZARA:
- Exemple del goset
- https://developers.google.com/web/fundamentals/performance/optimizing-content-efficiency/image-optimization#provision_de_recursos_de_imagen_ajustados_a_escala

# RESPONSIVE IMAGES

https://docs.spatie.be/laravel-medialibrary/v7/responsive-images/getting-started-with-responsive-images

DEMO: https://docs.spatie.be/laravel-medialibrary/demo/responsive-images

## Adaptar a mida de dispositiu

<picture>
  <source srcset="extralarge.jpg" media="(min-width: 1000px)">
  <source srcset="large.jpg" media="(min-width: 800px)">
  <img srcset="medium.jpg" alt="…">
</picture>

## ADAPTAR A PIXELS DE HARDWARE

Comparar esta pàgina al navegador d'escriptori i al mòbil:

https://webkit.org/demos/srcset/

```
<img src="image-src.png" srcset="image-1x.png 1x, image-2x.png 2x,
                                 image-3x.png 3x, image-4x.png 4x">
```

Conversors:
- http://nsimage.brosteins.com/

Et demanen la imatge de més resolució (4x) i et fan les altres imatges

-https://www.sitepoint.com/how-to-build-responsive-images-with-srcset/

# LAZY LOADING

- INTERSECTION API

```
<img class="lazy" 
     src="placeholder-image.jpg" 
     data-src="image-to-lazy-load-1x.jpg" 
     data-srcset="image-to-lazy-load-2x.jpg 2x, 
     image-to-lazy-load-1x.jpg 1x" alt="I'm an image!"
>
```
