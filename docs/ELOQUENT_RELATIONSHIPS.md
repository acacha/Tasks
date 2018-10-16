# Test Driven Development and Wishful programming

Una de les millors formes d'afegir relacions es amb TDD i Wishful programming.

La idea és senzilla, definim un test on s'utilitzin relacions (relacions que encara no hem definit) i executem el test.
Evidentment el test no anirà (roig) però a mesura que anem solucionant els errors que apareixen al executar el test 
anirem entenent com funcionen les relacions.

## Exemple TDD 

- Afegim una nova entitat/model a la nostra aplicació de tasques
- Tag: Etiqueta en anglès
- La idea es poder etiquetar les tasques per temàtiques/etiquetes/hashtags
- Exemples etiquetes: 
  - home: Tasques casolanes (comprar pa)
  - studies: Tasques escolars (Estudiar PHP)
  - job: tasques de la feina (Preparar reunió amb equip recursos humans) 
  - etc.
- Una tasca pot tenir n etiquetes
- Una mateixa etiqueta pot estar associada a n tasques
- Tipus relació: n a n
- NOTA: recordeu es feina per a vosaltres fer tot el CRUD de tags seguint els passos que hem fet amb les tasques
- Feu el crud de tags amb TDD

# Tipus relacions

## One to One

Exemples relacions 1 a 1 amb usuaris:
- one phone
- one address
- on identifier (dni)
- avatar

IMPORTANT: pq no afegir simplement un camp phone o un camp address o un camp identifier a la taula users? Depèn...

Task:
- Forçarem una relació 1 a 1
- 1 tasca 1 fitxer associat
- model nou fitxer

## One to many

- Usuaris <-> Tasques
- 1 usuari pot tenir n tasques
- 1 Tasca 1 usuari
- tipus relació: 1 a n 

# Resources
- https://laracasts.com/series/eloquent-relationships

