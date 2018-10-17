# Components susceptibles

Components de comunicació amb l'usuari

Tots aquells components gràfics que utilitzem per a comunicar-nos amb l'usuari evitant les alternatives bàsiques:

- Console.log: no serveix per comunicar-nos amb usuaris (només xivatos desenvolupador)
- window.alert: a nivell interfíci gràfic és molt cutre

Components:
- Alerts: https://vuetifyjs.com/en/components/alerts
- Snackbars: https://vuetifyjs.com/en/components/snackbars
- Modals/Dialogs: especialment complicats perquè de fet es poden arribar a utilitzar com noves finestres que continguin 
estructures complexes amb múltiples components
  - A Vuetify li diuen Dialogs: https://vuetifyjs.com/en/components/dialogs

Tots aquest components tenen el problema que s'utilitzen continuament en altres components i per tant són susceptibles de males pràctiques
com codi WET en comptes de DRY (abús de copy/paste)

# Exemple modal bàsic:

https://vuejs.org/v2/examples/modal.html

# Customitzar 

Al final acabarem tenint múltiples modals o snackbars o alerts amb codi molt similar però amb petites modificacions.

Per fet això tenim dos alternatives:

## Custom props and slots (BAD IDEA)

## Continguts del modal com un component separat i intercanviable

És el que fa Vuetify?

## MODAL DIALOG amb VUEX

- https://markus.oberlehner.net/blog/building-a-modal-dialog-with-vue-and-vuex/

## MODAL DIALOG amb PORTALS


# Recursos

- https://vuejs.org/v2/examples/modal.html
