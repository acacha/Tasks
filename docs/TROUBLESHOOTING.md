# No funciona res Javascript. Error consola Failed to load resource: net::ERR_CONNECTION_REFUSED

Intenteu obrir la URL: 

 http://localhost:8080/js/App.vue
 
o si useu HTTPS:

 https://localhost:8080/js/App.vue
 
Si us dona error:

No es pot accedir a aquest lloc

Es que no heu executat:

```
npm run hot
```

També és possible que el certificat autosignat de HTTPS encara no l'haguiu acceptat. Obriu la URL i indiqueu al navegador que 
accepteu el tèoric problema de seguretat.

Finalment recordeu de fer coincidir la execució del server HOT amb HTTPS si el vostre site és HTTPS
