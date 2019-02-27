# COMANDA CLI?

- https://laravel.com/docs/5.7/artisan
- https://laravel.com/docs/5.7/console-tests
- https://themsaid.com/laravel-artisan-commands-testing-20180825
- https://laravel.com/docs/5.7/console-tests

Com ho he fet?

```

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

```
sudo apt-get install jpegoptim
```

- http://freshmeat.sourceforge.net/projects/jpegoptim

# Recursos
- https://medium.com/@macropus/optimizing-converting-images-8d10ae559586
- https://developers.google.com/speed/docs/insights/OptimizeImages
