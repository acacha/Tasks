# Laravel

## Configuració PHPUNIT

Cal tenir:

```
        <env name="DB_CONNECTION" value="sqlite"/>
        <env name="DB_DATABASE" value=":memory:"/> 
```

Al fitxer phpunit.xml de l'arrel

# Vue

Utilitzarem les eines oficials de Testing de Vue:

- https://github.com/vuejs/vue-test-utils
- https://vue-test-utils.vuejs.org

Instal·lació:

Utilitarem vue Cli per comprovar els components, a l'arrel del projecte executeu:

$ vue create vue

Escolliu:
- Manually select features
- A part de les opcions ja escollides marqueu Unit Testing
- Eslint + standard config
- Lint on save
- In dedicated config files
- NO guardeu la configuració per a a altres projectes

I el més important per testejar utilitzarem 

 Mocha + Chai
 
- Mocha:  https://mochajs.org/
- Chai: https://www.chaijs.com/

Assertions Libraries (3 grans tipus: should | expect | assert) 

Recursos formació:
- https://laracasts.com/series/testing-vue

Execució dels testos:

```
cd vue
npm run test:unit
```

Plantilla per a nous testos example.spec.js:

```javascript
import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import HelloWorld from '@/components/HelloWorld.vue'

describe('HelloWorld.vue', () => {
  it('renders props.msg when passed', () => {
    const msg = 'new message'
    const wrapper = shallowMount(HelloWorld, {
      propsData: { msg }
    })
    expect(wrapper.text()).to.include(msg)
  })
})
```

Exemple que cal canviar per comprovar un component propi del nostre projecte (exemple tasks):

```javascript
import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import Tasks from '../../../resources/js/components/Tasks'

describe('Tasks.vue', () => {
  it('todo', () => {
    const wrapper = shallowMount(Tasks, {
      propsData: { msg }
    })
  })
})
```

EXECUTAR UN SOL TEST:

Executeu igual que si vulguessiu executar tots els testos però canvieu:

```javascript
  it('renders props.msg when passed', () => {
```

```javascript
  it.only('renders props.msg when passed', () => {
```

## Vue Test utils

### Objecte wrapper

https://vue-test-utils.vuejs.org/api/wrapper/#properties 

- wrapper.vw : conté la instància Vue (vm = ViewModel): https://vuejs.org/v2/api/#Instance-Properties
- wrapper.element: root element

# CHEATSHEET

https://gist.github.com/patocallaghan/6154431

# TROUBLESHOOTING

## No ESLint configuration found quan s'executa una test

Exemple test:

```javascript
import { expect } from 'chai'
import { shallowMount } from '@vue/test-utils'
import Tasks from '../../../resources/js/components/Tasks'

describe('Tasks.vue', () => {
  it('todo', () => {
    const wrapper = shallowMount(Tasks)
  })
})
```

Cal crear un fitxer vue.config.js a l'arrel de la carpeta vue:

```
const path = require('path');
module.exports = {
  chainWebpack: config => {
    config.module
      .rule('eslint')
      .use('eslint-loader')
      .tap(options => {
        options.configFile = path.resolve(__dirname, ".eslintrc.js");
        return options;
      })
  },
  css: {
    loaderOptions: {
      postcss: {
        config:{
          path:__dirname
        }
      }
    }
  }
}
```
