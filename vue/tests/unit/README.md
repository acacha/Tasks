# Component tasks

Que volem que faci?/Que volem testejar?

Funcionalitats:
- Les mateixes que http://todomvc.com/examples/vue/

NOTA: Crida a l'API és sinònim en el nostre projecte de axios

- Si no indiquem la propietat tasks s'executa una CRIDA a l'API (axios)
per obtenir la llista de tasques
- Si passem un array de 3 tasques com a propietat tasks predefinides les mostra correctament
- Comprovar funciona/mostra el total de tasques
- Si afegim una nova tasca es mostra a la llista de tasques
- Es mostra missatge validació quan intentem crear una tasca sense nom (i no s'executa axios)
- Si afegim una nova tasca s'executa una crida a l'API per afegir la tasca a la base de dades
- Si eliminem una tasca NO es mostra a la llista de tasques
- Si eliminem una tasca s'executa una crida a l'API per afegir la tasca a la base de dades
- Si premem la icona refresh, s'executa una crida a l'API per (re)obtenir les tasques de la base de dades
- Comprovar els filtres: Si indiquem tasques de tots els tipus (completades i no completades) comprovem que funcionen
els filtres
- Boto/Checkbox completar/descompletar (Toogle)
- Mostrar un text que indiqui quantes tasques queden per fer
- Boto/acció permeti eliminar les tasques ja completades

ISOLATION
- Es tracta de testejar el component independentment del backend
- És a dir, NO COMPROVEM que el backend funcioni o no (ja donem per suposat que és així o millor dit ja tenim testos 
Laravel que comproven que el backend funciona correctament)
- NOU CONCEPTE: FAKE/MOCKING. Farem un mock/fake de l'API, és a dir realment no executarem res directament a la API
sino que utilitzarem una API de mentida on naltros controlarem que retorna la APi
