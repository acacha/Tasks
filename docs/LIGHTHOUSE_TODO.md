# ACCESSIBILITAT

## Buttons do not have an accessible name

- https://dequeuniversity.com/rules/axe/3.1/button-name?application=lighthouse
- aria-label no buit si l'interior del button és un text complex

## Color Contrast Is Satisfactory
- https://dequeuniversity.com/rules/axe/3.1/color-contrast?application=lighthouse
    
# Preconnect to required origins -> Resource Hints

IMPORTANT UTILITZAR DNS-PREFETCH i PRECONNECT AL MATEIX TEMPS PERÔ PRECONNECT ABANS

```
<link rel="preconnect dns-prefetch" href="https://somewhere.tls" crossorigin>
```
o
```
<rel="preconnect" href="https://somewhere.tls" crossorigin> <rel="dns-prefetch" href="https://somewhere.tls">
```

```
<link rel="preload" as="script" href="super-important.js">
<link rel="preconnect" href="https://example-domain.com/">
```

Preconnect to required origins
- https://caniuse.com/#search=dns-prefetch
- https://caniuse.com/#search=preconnect
- URL Potential Savings (ms) https://smartlock.google.com 300 ms
- https://developers.google.com/web/fundamentals/performance/resource-prioritization#preconnect
- https://caniuse.com/#search=preload
- https://medium.com/@soorajchandran/speeding-up-your-website-using-prefetching-techniques-8077058b7418
- https://stackoverflow.com/questions/47875337/dns-prefetch-and-preconnect-one-or-both-fallback

# Altres
- Convertir les imatges a webp. Suport progressiu (component Vue i detecció Javascript del suport) per navegadors no suporten
- Fonts Google inline: 

## DNS PREFETCH:

```
<link rel="dns-prefetch" href="//fonts.googleapis.com">
```

- https://www.keycdn.com/blog/resource-hints
- https://www.keycdn.com/blog/resource-hints#3-prerendering

## PRERENDERING

- https://caniuse.com/#search=prerender

## Prefetch

- [ ] La idea és que amb baixa prioritat baixi possibles recursos futurs
- [  ] S'ha de provar 
- https://developers.google.com/web/fundamentals/performance/resource-prioritization#preconnect
- https://caniuse.com/#search=prefetch

# Does not provide fallback content when JavaScript is not available

Utilitzar etiqueta noscript: 

Exemple: http://tutsplus.github.io/blur-image-load/index.html

Com provar a devtools?

Click the ⋮ menu in the corner of the Developer Tools, click Settings, then check Disable Javascript under Debugger.

- https://stackoverflow.com/questions/13405383/how-to-disable-javascript-in-chrome-developer-tools

# Altres temes performance:

- https://flaviocopes.com/javascript-async-defer/#the-position-matters
- scripts amb defer async i al header en comptes del final del body
- https://stackoverflow.com/questions/436411/where-should-i-put-script-tags-in-html-markup/24070373#24070373
- FUOC: POsar als headers de les plantilles:

```
<style>
        [v-cloak] > * { display:none; }
        [v-cloak]::before {
            content: " ";
            display: block;
            width: 40px;
            height: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            background-image: url('data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBzdGFuZGFsb25lPSJubyI/Pgo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9HcmFwaGljcy9TVkcvMS4xL0RURC9zdmcxMS5kdGQiPgo8c3ZnIHdpZHRoPSI0MHB4IiBoZWlnaHQ9IjQwcHgiIHZpZXdCb3g9IjAgMCA0MCA0MCIgdmVyc2lvbj0iMS4xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4bWw6c3BhY2U9InByZXNlcnZlIiBzdHlsZT0iZmlsbC1ydWxlOmV2ZW5vZGQ7Y2xpcC1ydWxlOmV2ZW5vZGQ7c3Ryb2tlLWxpbmVqb2luOnJvdW5kO3N0cm9rZS1taXRlcmxpbWl0OjEuNDE0MjE7IiB4PSIwcHgiIHk9IjBweCI+CiAgICA8ZGVmcz4KICAgICAgICA8c3R5bGUgdHlwZT0idGV4dC9jc3MiPjwhW0NEQVRBWwogICAgICAgICAgICBALXdlYmtpdC1rZXlmcmFtZXMgc3BpbiB7CiAgICAgICAgICAgICAgZnJvbSB7CiAgICAgICAgICAgICAgICAtd2Via2l0LXRyYW5zZm9ybTogcm90YXRlKDBkZWcpCiAgICAgICAgICAgICAgfQogICAgICAgICAgICAgIHRvIHsKICAgICAgICAgICAgICAgIC13ZWJraXQtdHJhbnNmb3JtOiByb3RhdGUoLTM1OWRlZykKICAgICAgICAgICAgICB9CiAgICAgICAgICAgIH0KICAgICAgICAgICAgQGtleWZyYW1lcyBzcGluIHsKICAgICAgICAgICAgICBmcm9tIHsKICAgICAgICAgICAgICAgIHRyYW5zZm9ybTogcm90YXRlKDBkZWcpCiAgICAgICAgICAgICAgfQogICAgICAgICAgICAgIHRvIHsKICAgICAgICAgICAgICAgIHRyYW5zZm9ybTogcm90YXRlKC0zNTlkZWcpCiAgICAgICAgICAgICAgfQogICAgICAgICAgICB9CiAgICAgICAgICAgIHN2ZyB7CiAgICAgICAgICAgICAgICAtd2Via2l0LXRyYW5zZm9ybS1vcmlnaW46IDUwJSA1MCU7CiAgICAgICAgICAgICAgICAtd2Via2l0LWFuaW1hdGlvbjogc3BpbiAxLjVzIGxpbmVhciBpbmZpbml0ZTsKICAgICAgICAgICAgICAgIC13ZWJraXQtYmFja2ZhY2UtdmlzaWJpbGl0eTogaGlkZGVuOwogICAgICAgICAgICAgICAgYW5pbWF0aW9uOiBzcGluIDEuNXMgbGluZWFyIGluZmluaXRlOwogICAgICAgICAgICB9CiAgICAgICAgXV0+PC9zdHlsZT4KICAgIDwvZGVmcz4KICAgIDxnIGlkPSJvdXRlciI+CiAgICAgICAgPGc+CiAgICAgICAgICAgIDxwYXRoIGQ9Ik0yMCwwQzIyLjIwNTgsMCAyMy45OTM5LDEuNzg4MTMgMjMuOTkzOSwzLjk5MzlDMjMuOTkzOSw2LjE5OTY4IDIyLjIwNTgsNy45ODc4MSAyMCw3Ljk4NzgxQzE3Ljc5NDIsNy45ODc4MSAxNi4wMDYxLDYuMTk5NjggMTYuMDA2MSwzLjk5MzlDMTYuMDA2MSwxLjc4ODEzIDE3Ljc5NDIsMCAyMCwwWiIgc3R5bGU9ImZpbGw6YmxhY2s7Ii8+CiAgICAgICAgPC9nPgogICAgICAgIDxnPgogICAgICAgICAgICA8cGF0aCBkPSJNNS44NTc4Niw1Ljg1Nzg2QzcuNDE3NTgsNC4yOTgxNSA5Ljk0NjM4LDQuMjk4MTUgMTEuNTA2MSw1Ljg1Nzg2QzEzLjA2NTgsNy40MTc1OCAxMy4wNjU4LDkuOTQ2MzggMTEuNTA2MSwxMS41MDYxQzkuOTQ2MzgsMTMuMDY1OCA3LjQxNzU4LDEzLjA2NTggNS44NTc4NiwxMS41MDYxQzQuMjk4MTUsOS45NDYzOCA0LjI5ODE1LDcuNDE3NTggNS44NTc4Niw1Ljg1Nzg2WiIgc3R5bGU9ImZpbGw6cmdiKDIxMCwyMTAsMjEwKTsiLz4KICAgICAgICA8L2c+CiAgICAgICAgPGc+CiAgICAgICAgICAgIDxwYXRoIGQ9Ik0yMCwzMi4wMTIyQzIyLjIwNTgsMzIuMDEyMiAyMy45OTM5LDMzLjgwMDMgMjMuOTkzOSwzNi4wMDYxQzIzLjk5MzksMzguMjExOSAyMi4yMDU4LDQwIDIwLDQwQzE3Ljc5NDIsNDAgMTYuMDA2MSwzOC4yMTE5IDE2LjAwNjEsMzYuMDA2MUMxNi4wMDYxLDMzLjgwMDMgMTcuNzk0MiwzMi4wMTIyIDIwLDMyLjAxMjJaIiBzdHlsZT0iZmlsbDpyZ2IoMTMwLDEzMCwxMzApOyIvPgogICAgICAgIDwvZz4KICAgICAgICA8Zz4KICAgICAgICAgICAgPHBhdGggZD0iTTI4LjQ5MzksMjguNDkzOUMzMC4wNTM2LDI2LjkzNDIgMzIuNTgyNCwyNi45MzQyIDM0LjE0MjEsMjguNDkzOUMzNS43MDE5LDMwLjA1MzYgMzUuNzAxOSwzMi41ODI0IDM0LjE0MjEsMzQuMTQyMUMzMi41ODI0LDM1LjcwMTkgMzAuMDUzNiwzNS43MDE5IDI4LjQ5MzksMzQuMTQyMUMyNi45MzQyLDMyLjU4MjQgMjYuOTM0MiwzMC4wNTM2IDI4LjQ5MzksMjguNDkzOVoiIHN0eWxlPSJmaWxsOnJnYigxMDEsMTAxLDEwMSk7Ii8+CiAgICAgICAgPC9nPgogICAgICAgIDxnPgogICAgICAgICAgICA8cGF0aCBkPSJNMy45OTM5LDE2LjAwNjFDNi4xOTk2OCwxNi4wMDYxIDcuOTg3ODEsMTcuNzk0MiA3Ljk4NzgxLDIwQzcuOTg3ODEsMjIuMjA1OCA2LjE5OTY4LDIzLjk5MzkgMy45OTM5LDIzLjk5MzlDMS43ODgxMywyMy45OTM5IDAsMjIuMjA1OCAwLDIwQzAsMTcuNzk0MiAxLjc4ODEzLDE2LjAwNjEgMy45OTM5LDE2LjAwNjFaIiBzdHlsZT0iZmlsbDpyZ2IoMTg3LDE4NywxODcpOyIvPgogICAgICAgIDwvZz4KICAgICAgICA8Zz4KICAgICAgICAgICAgPHBhdGggZD0iTTUuODU3ODYsMjguNDkzOUM3LjQxNzU4LDI2LjkzNDIgOS45NDYzOCwyNi45MzQyIDExLjUwNjEsMjguNDkzOUMxMy4wNjU4LDMwLjA1MzYgMTMuMDY1OCwzMi41ODI0IDExLjUwNjEsMzQuMTQyMUM5Ljk0NjM4LDM1LjcwMTkgNy40MTc1OCwzNS43MDE5IDUuODU3ODYsMzQuMTQyMUM0LjI5ODE1LDMyLjU4MjQgNC4yOTgxNSwzMC4wNTM2IDUuODU3ODYsMjguNDkzOVoiIHN0eWxlPSJmaWxsOnJnYigxNjQsMTY0LDE2NCk7Ii8+CiAgICAgICAgPC9nPgogICAgICAgIDxnPgogICAgICAgICAgICA8cGF0aCBkPSJNMzYuMDA2MSwxNi4wMDYxQzM4LjIxMTksMTYuMDA2MSA0MCwxNy43OTQyIDQwLDIwQzQwLDIyLjIwNTggMzguMjExOSwyMy45OTM5IDM2LjAwNjEsMjMuOTkzOUMzMy44MDAzLDIzLjk5MzkgMzIuMDEyMiwyMi4yMDU4IDMyLjAxMjIsMjBDMzIuMDEyMiwxNy43OTQyIDMzLjgwMDMsMTYuMDA2MSAzNi4wMDYxLDE2LjAwNjFaIiBzdHlsZT0iZmlsbDpyZ2IoNzQsNzQsNzQpOyIvPgogICAgICAgIDwvZz4KICAgICAgICA8Zz4KICAgICAgICAgICAgPHBhdGggZD0iTTI4LjQ5MzksNS44NTc4NkMzMC4wNTM2LDQuMjk4MTUgMzIuNTgyNCw0LjI5ODE1IDM0LjE0MjEsNS44NTc4NkMzNS43MDE5LDcuNDE3NTggMzUuNzAxOSw5Ljk0NjM4IDM0LjE0MjEsMTEuNTA2MUMzMi41ODI0LDEzLjA2NTggMzAuMDUzNiwxMy4wNjU4IDI4LjQ5MzksMTEuNTA2MUMyNi45MzQyLDkuOTQ2MzggMjYuOTM0Miw3LjQxNzU4IDI4LjQ5MzksNS44NTc4NloiIHN0eWxlPSJmaWxsOnJnYig1MCw1MCw1MCk7Ii8+CiAgICAgICAgPC9nPgogICAgPC9nPgo8L3N2Zz4K');
        }
    </style>
```

# Posar directiva v-cloak

- EVITAR FUOC: Flash Of Unestyled Content 

```
<v-app id="app" v-cloak style="background: #F0F4F8;background: -webkit-linear-gradient(to right, #F0F4F8, #D9E2EC, #BCCCDC);
            background: linear-gradient(to right, #F0F4F8, #D9E2EC, #BCCCDC);">
```

# Enable text compression

- Solucionat amb npm run prod

# Defer unused CSS

- Solucionat amb npm run prod

# Minify JavaScript

- Solucionat amb npm run prod



```
npm install material-design-icons-iconfont
npm install typeface-roboto --save
npm install typeface-montserrat
```
I al fitxer app.js posar:

```
import 'material-design-icons/iconfont/material-icons.css'
import 'typeface-roboto/index.css'
import 'typeface-montserrat/index.css'
```

https://medium.com/@daddycat/using-offline-material-icons-and-roboto-font-in-electron-app-f25082447443

# Preload key request

```
 <link rel=preload>
```

Però amb webpack i Laravel mix?

```
npm install --save-dev @babel/plugin-syntax-dynamic-import
```

`.babelrc`:

```
{
  "plugins": ["@babel/plugin-syntax-dynamic-import"]
}
```

Fitxer app.js:

```
// https://github.com/JeffreyWay/laravel-mix/issues/1249
import (/* webpackPrefetch: true */  'typeface-montserrat/index.css') // eslint-disable-line
import (/* webpackPrefetch: true */  'typeface-roboto/index.css') // eslint-disable-line
import (/* webpackPrefetch: true */  'material-design-icons-iconfont/dist/material-design-icons.css') // eslint-disable-line
import (/* webpackPrefetch: true */  '@fortawesome/fontawesome-free/css/all.css') // eslint-disable-line
import (/* webpackPrefetch: true */  'font-awesome/css/font-awesome.min.css') // eslint-disable-line
```
- https://developers.google.com/web/tools/lighthouse/audits/preload
- https://medium.com/webpack/link-rel-prefetch-preload-in-webpack-51a52358f84c

# Ensure text remains visible during webfont load

```
font-display: swap;
```

- https://developers.google.com/web/updates/2016/02/font-display
- typeface-roboto/index.css
