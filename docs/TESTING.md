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

# Conceptes

- Expect: Used to construct assertions, compare a value with the expected result on a test. Chai Assertions.
- Spy: A test spy is an object that records its interaction with other objects and can be used to check if a certain function was called, the arguments passed to it (if any) and what the return value is (once again, if any). Sinon Spies.
- Stub: Change how the function is called on the tests. It replaces a function’s behavior, avoiding the original function invocation. Can be used to test how our unit behaves to different return values from a dependency function. Sinon Stubs.
- Mocking/ Faking
- Mount: When mounting a component, an instance is created. The component is rendered as well as its child components.
- Shallow: Very similar to mount but child components are stubbed, not rendered or instanced. Very useful in order to reduce the dependencies of a component’s test.

- https://medium.com/pixelmatters/unit-testing-with-vue-approach-tips-and-tricks-part-1-b7d3209384dc

## Vue Test utils

### Objecte wrapper

https://vue-test-utils.vuejs.org/api/wrapper/#properties 

- wrapper.vw : conté la instància Vue (vm = ViewModel): https://vuejs.org/v2/api/#Instance-Properties
- wrapper.element: root element

# Vue. Que testejar i que no?

- https://www.youtube.com/watch?v=OIpfWTThrK8

# Knowing What to Test
For UI components, we don't recommend aiming for complete line-based coverage, because it leads to too much focus on the internal implementation details of the components and could result in brittle tests.

Instead, we recommend writing tests that assert your component's public interface, and treat its internals as a black box. A single test case would assert that some input (user interaction or change of props) provided to the component results in the expected output (render result or emitted custom events).

For example, for the Counter component which increments a display counter by 1 each time a button is clicked, its test case would simulate the click and assert that the rendered output has increased by 1. The test doesn't care about how the Counter increments the value, it only cares about the input and the output.

## Output (HTML/DOM Render)

Recordeu que heu de veure els components com una funció (o com una capsula o caixa) i saber quina és la seva API,
és a dir, quina és la seva interfície d'ús com a programadors:

- Entrades: props/slots | User interaction (clicks, hovers, etc) | Vue lifecycle hooks
- Sortides: events i output DOM (HTML/template)
- nota: també s'ha de tenir en compte les connexions amb fills i pares

Són utils les funcions:
- wrapper.text(): mostra el text del component
- wrapper.html(): mostra el thml del component
- wrapper.find(CSS_SELECTOR): permet buscar un element a la plantilla. Si el troba torna un altre wrapper i podeu 
aplicar funcions (text(), html(), fer un altre find(), contains, etc)
- wrapper.contains(CSS_SELECTOR): https://vue-test-utils.vuejs.org/api/wrapper/#contains-selector
- https://vue-test-utils.vuejs.org/api/wrapper/#exists

### Lógica a la plantilla (v-if|v-show|v-fors)

Si tenim parts de la plantilla que es renderitzen condicionalment, cal testejar els dos casos (if i else).

IMPORTANT: Compte la diferència entre v-if (simplement busqueu element amb find i comproveu si està o no) i v-show (utilitzeu funció isVisible pq si utilitzeu find el trobarà però no és visible)

- Útil: expect(wrapper.find('div').exists()).to.be(true)


```javascript
// Checking conditional rendering
  it('not_shows_filters_if_task_list_is_empty', () => {
    const wrapper = mount(Tasks)
    // eslint-disable-next-line no-unused-expressions
    expect(wrapper.find('span#filters').isVisible()).to.be.false
  })

  it('not_shows_filters_if_task_list_is_not_empty', () => {
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: [
          {
            name: 'Compra pa'
          }
        ]
      }
    })
    // eslint-disable-next-line no-unused-expressions
    expect(wrapper.find('span#filters').isVisible()).to.be.true
  })
``` 

Les llistes també s'han de comprovar

## Esdeveniments/events

https://vue-test-utils.vuejs.org/api/wrapper/#emitted

## Vue Data

Si tenim clar que l'estat inicial del component podem testejar els valors inicials (estat inicial) del component:

```javascript
it('check_default_state', () => {
    const wrapper = mount(Tasks)
    expect(wrapper.vm.$data.newTask).equals('')
    expect(wrapper.vm.$data.filter).equals('all')
    expect(wrapper.vm.$data.dataTasks).to.have.lengthOf(0)
    expect(wrapper.props().tasks).to.have.lengthOf(0)
  })

```

## Methods

Els mètodes són simples funcions amb una entrada i una sortida i per tant es poden testejar com qualsevol altre funció.

Sovint els mètodes s'executen després d'alguna interacció de l'usuari amb el DOM (click, dblclick, hovers, etc)

Per tant el primer que cal aprendre és a interactuar amb el DOM per tal de disparar l'esdeveniment que ha d'executar el 
mètode que volem testejar. 

 https://vue-test-utils.vuejs.org/guides/dom-events.html

Exemple mètode (mètode add de tasques):

```
methods: {
      add() {
          axios.post('/api/v1/tasks', {
            name: this.newTask
          }).then((response) => {
            this.dataTasks.splice(0,0,{ id: response.data.id, name: this.newTask, completed: false } )
            this.newTask=''
          }).catch((error) => {
            console.log(response)
          })
      },
      remove(task) {
          this.dataTasks.splice(this.dataTasks.indexOf(task),1)
      }
  },
```

El DOM associat que executa el mètode és:

```html
    <input type="text"
               v-model="newTask" @keyup.enter="add"
               name="name"
        >

    <button @click="add">Afegir</button>
```

Observeu que algunes tasques seran tan habituals que podem fer helpers:

## Lifecycle Hooks (created, mounted, etc.)

Exemple created:

```javascript
created () {
    if (this.tasks.length === 0) {
      axios.get('/api/v1/tasks').then((response) => {
        this.dataTasks = response.data
      }).catch((error) => {
        console.log(error)
      })
    }
  }
```

Atenció aquest tipus de codi pot provocar que deixin d'anar tots els tests pel fet que cada vegada que montem (o fem shallow)
del component estem executant un crida a una API exterior que als testos no té perque estar disponible.

En aquest cas cal substituir (fake/mock/stub) axios per un quelcom que realment no executi la cria a la API però 
poguem controlar els valors que retorna i puguem espiar si s'ha executat o no.

Instal·lació Moxios:

```javascript
import moxios from 'moxios'

describe('Tasks.vue', () => {
  beforeEach(() => {
    moxios.install(axios)
  })

  afterEach(function () {
    moxios.uninstall(axios)
  })
```

Fixeu-vos indiquem axios com a variable global. Es recomanable crear un fitxer setup.js que executi tot aquell
codi que sigui comú a tots els testos, a setups.js poseu:

```javascript
global.axios = require('axios')
````

i Canvieu package.json a:

```
    "test:unit": "vue-cli-service test:unit  --require tests/unit/setup.js"
```

El test seria:

```javascript
// ***************** CREATED LIFECYCLE ****************
  it.only('fetchs_tasks_from_backend_when_no_tasks_prop_is_given', (done) => {
    moxios.stubRequest('/api/v1/tasks', {
      status: 200,
      response: [
        {
          id: 1,
          name: 'Comprar llet',
          completed: true
        },
        {
          id: 2,
          name: 'Comprar pa',
          completed: false
        },
        {
          id: 3,
          name: 'Estudiar PHP',
          completed: false
        }
      ]
    })
    const wrapper = mount(Tasks)

    moxios.wait(() => {
      expect(wrapper.vm.dataTasks).to.be.an('array')
      expect(wrapper.vm.dataTasks).to.have.lengthOf(3)
      expect(wrapper.vm.dataTasks[0].id).equals(1)
      expect(wrapper.vm.dataTasks[0].name).equals('Comprar llet')
      expect(wrapper.vm.dataTasks[0].completed).equals(true)
      expect(wrapper.vm.dataTasks[1].id).equals(2)
      expect(wrapper.vm.dataTasks[1].name).equals('Comprar pa')
      expect(wrapper.vm.dataTasks[1].completed).equals(false)
      expect(wrapper.vm.dataTasks[2].id).equals(3)
      expect(wrapper.vm.dataTasks[2].name).equals('Estudiar PHP')
      expect(wrapper.vm.dataTasks[2].completed).equals(false)
      done()
    })


    })
})
```

Recursos
- Moxios: Stubing/faking/Mocking Axios
- Sinon: 
- https://laracasts.com/series/testing-vue/episodes/8

## Computed properties

- Són funcions que calculen a partir d'una dada reactiva de vue un resultat o un valor derivat
- Sí són factibles de ser testejades amb un test unitari
- També es poden testejar "indirectament".

Exemple computed property:

```javascript
computed: {
    total() {
      return this.dataTasks.length
    }
```

Test unitari:

```javascript
it('computes_total_tasks_when_no_tasks', () => {
    const wrapper = shallowMount(Tasks)
    expect(wrapper.vm.total).equals(0)
  })

  it('computes_total_tasks', () => {
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: [
          {
            id: 1,
            name: 'Compra pa',
            completed: false
          },
          {
            id: 2,
            name: 'Compra llet',
            completed: false
          }
        ]
      }
    })
    expect(wrapper.vm.total).equals(2)
  })
```

Test indirecte (comprovem que es mostra correctament el total al DOM/HTML/Vista del component)

```javascript
//INDIRECT TEST -> Busquem que el total sigui correcte a la renderització/vista/dom final
  it('renders_default_title_with_total_0_without_tasks', () => {
    const wrapper = shallowMount(Tasks)
    expect(wrapper.text()).to.contain('Tasques (0)')
  })

  it('renders_default_title_with_total_1_with_one_tasks', () => {
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: [
          {
            id: 1,
            name: 'Compra pa',
            completed: false
          }
        ]
      }
    })
    expect(wrapper.text()).to.contain('Tasques (1)')
  })
```

## Watchers

La mateixa casuistica que les computed properties. Exemple de watch:

```
 watch: {
    tasks(newTasks) {
      this.dataTasks = newTasks
    }
  },
```

Que fa l'anterior codi? estar atent (watch) a si canvia la propietat tasks del component i actualitza l'estat 
del component. Igual que amb els testos de les propietats computades es pot fer test directe o indirecte.

```javascript
it('watchs_for_tasks_prop', () => {
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: [
          {
            id: 1,
            name: 'Compra pa',
            completed: false
          }
        ]
      }
    })
    expect(wrapper.vm.tasks).to.have.length(1)
    // https://vue-test-utils.vuejs.org/api/wrapper/setProps.html
    wrapper.setProps({ tasks: [
        {
          id: 1,
          name: 'Compra pa',
          completed: false
        },
        {
          id: 2,
          name: 'Compra llet',
          completed: false
        },
      ]})
    expect(wrapper.vm.tasks).to.have.length(2)
  })
```

## NO testejar els estils o questions relacionades amb CSS

Per què? pq canvien els estils molt fàcilment i fa els testos debils (falle/es trenquen fàcilment). A més els estils 
es compliquen fàcilment

```javascript
it('should_render_a_formatted_username')
it('should_render_a_formatted_username_with_a_custom_avatar')
it('should_render_a_formatted_username_in_green_with_a_custom_avatar_if_the_user_is_loggend_in_but_it_should_display' +
 'a_formatted_username_in_red_with_custom_avatar_if_not_logged)
 WTF!
```
it

## No testejar el propi framework (no testejar vue)

Ens hem de centrar en comprovar el nostre propi codi o decisions i no pas el que vue funciona correctament.

Exemple de test no necessari:

```javascript
// TEST INNECESSARI: no cal testejar el framework
  it('sets_tasks_prop', () => {
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: [
          {
            id: 1,
            name: 'Comprar pa',
            completed: false
          }
        ]
      }
    })
    expect(wrapper.vm.$props.tasks).to.be.an('array')
    expect(wrapper.vm.$props.tasks).to.have.lengthOf(1)
    expect(wrapper.vm.$props.tasks[0].id).equals(1)
    expect(wrapper.vm.$props.tasks[0].name).equals('Comprar pa')
    expect(wrapper.vm.$props.tasks[0].completed).equals(false)
  })
```

# CHEATSHEET

https://gist.github.com/patocallaghan/6154431

# TROUBLESHOOTING

# Troubleshooting

## SyntaxError: The string did not match the expected pattern using Moxios/Aios


Cal tenir en compte que tant el projecte (arrel) com la carpeta de testos (Vue o tests/Vue) han de tenir els paquets instal·lats en local:

```
cd tests/Vue
npm install --save-dev moxios axios
``` 

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

# Recursos
- https://medium.com/pixelmatters/unit-testing-with-vue-approach-tips-and-tricks-part-1-b7d3209384dc
- https://medium.com/pixelmatters/unit-testing-with-vue-approach-tips-and-tricks-part-2-61abc10b2d33
