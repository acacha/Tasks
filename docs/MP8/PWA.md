http://acacha.org/mediawiki/Progressive_Web_Apps

# Tools

Pestanya App a Chrome Dev Tools

## Lighthouse

https://developers.google.com/web/tools/lighthouse/

# Web manifest

https://developers.google.com/web/fundamentals/web-app-manifest/

# Add to Homescreen ( A2HS) o Banners de instalación de apps web

Chrome mostrará de manera automática el banner cuando tu app cumpla con los siguientes criterios:

- Contener un archivo de manifiesto de aplicación web con:
  - un short_name (usado en la pantalla de inicio);
  - un name (usado en el banner);
  - un ícono png de 192 x 192 (en las declaraciones del ícono se debe incluir un tipo de mime image/png);
  - una start_url que se carga.
- Contener un service worker registrado en tu sitio.
- Transmitirse a través de HTTPS (un requisito para usar el service worker).
- Recibir visitas al menos dos veces, con al menos cinco minutos de diferencia entre las visitas.


Recursos:
- https://developers.google.com/web/tools/chrome-devtools/progressive-web-apps#add-to-homescreen
# Icones extra:

<!-- icon in the highest resolution we need it for -->
<link rel="icon" sizes="192x192" href="icon.png">

<!-- reuse same icon for Safari -->
<link rel="apple-touch-icon" href="ios-icon.png">

<!-- multiple icons for IE -->
<meta name="msapplication-square310x310logo" content="icon_largetile.png">
Chrome y Opera
Chrome y Opera usan icon.png, que se adapta al tamaño necesario a través del dispositivo. Para prevenir el ajuste de escala automático, también puedes proporcionar tamaños adicionales especificando el atributo sizes.

Note: El tamaño de los íconos debe basarse en 48 px; por ejemplo, 48 px, 96 px, 144 px, y 192 px.
Safari
En Safari, también se usa la etiqueta <link> con el atributo rel: apple-touch-icon.

Puedes especificar tamaños explícitos proporcionando una etiqueta de vínculo por separado para cada ícono. De este modo, el SO no tendrá que cambiar el tamaño del icono:

<link rel="apple-touch-icon" href="touch-icon-iphone.png">
<link rel="apple-touch-icon" sizes="76x76" href="touch-icon-ipad.png">
<link rel="apple-touch-icon" sizes="120x120" href="touch-icon-iphone-retina.png">
<link rel="apple-touch-icon" sizes="152x152" href="touch-icon-ipad-retina.png">

# Instal·lació d'aplicacions natives (App Banners)

https://developers.google.com/web/fundamentals/app-install-banners/native

IMPORTANT: Cal tenir una aplicació nativa penjada a Play Store

Cal posar al manifest:

```
"prefer_related_applications": true,
"related_applications": [
  {
    "platform": "play",
    "id": "com.google.samples.apps.iosched"
  }
]
```

# IOS Safari

https://developer.apple.com/library/archive/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html
