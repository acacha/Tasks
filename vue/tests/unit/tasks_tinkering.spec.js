import { expect } from 'chai'
import { shallowMount, mount, Wrapper } from '@vue/test-utils'
import Tasks from '../../../resources/js/components/Tasks'
import moxios from 'moxios'
import TestHelpers from './helpers.js'

describe('Tasks.vue', () => {
  beforeEach(() => {
    // Assign test helpers methods to wrapper
    Object.assign(Wrapper.prototype, TestHelpers)
    // eslint-disable-next-line no-undef
    moxios.install(axios)
  })

  afterEach(function () {
    // eslint-disable-next-line no-undef
    moxios.uninstall(axios)
  })

  // TESTING TOTAL COMPUTED PROPERTY AND OUTPUT RENDER
  it('renders_default_title_with_total', () => {
    const wrapper = shallowMount(Tasks)
    // console.log('TEXT:' + wrapper.text())
    // console.log(wrapper.html())
    // assert see Tasques (0)
    expect(wrapper.text()).to.be.a('string')
    expect(wrapper.text()).to.contain('Tasques (0)')
    // expect(wrapper.text()).to.equal('Tasks')
    // expect(foo).to.have.lengthOf(3)
  })

  // Necessari? -> Si tenim clar no canviarem el nom? en tot cas no massa rellevant
  it('has_Tasks_as_name', () => {
    const wrapper = shallowMount(Tasks)
    expect(wrapper.name()).equals('Tasks')
  })

  // Test potser massa relacionat amb l'estil del component. Un altre copa si tenim clas que no canviarà
  it('has_HTMLDivElement_as_root_element', () => {
    const wrapper = shallowMount(Tasks)
    // console.log(wrapper.element)
    expect(wrapper.element).to.be.a('HTMLDivElement')
  })

  // Ídem anteriors
  it('has_as_a_root_element_with_id_tasks', () => {
    const wrapper = mount(Tasks)
    expect(wrapper.attributes('id')).equals('tasks')
  })

  // Ídem anteriors
  it('has_as_a_root_element_with_class_tasks', () => {
    const wrapper = mount(Tasks)
    expect(wrapper.classes()).to.contain('tasks')
  })

  // Interesant!!! Aquí testejem HTML (contingut) i no pas estil. Les llistes es poden formatar de múltiples formes però sempre seran llistes
  // Punt debil, que passa si la llista la fem amb una eina com vuetify i utilitzem custom components com v-list
  it('contains_a_list', () => {
    const wrapper = mount(Tasks)
    // eslint-disable-next-line no-unused-expressions
    expect(wrapper.contains('ul')).to.be.true
  })

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

  // example discard test
  it.skip('skipped_test', () => {
    const wrapper = shallowMount(Tasks)
    expect(wrapper.text()).to.contain('Tasques (0)')
  })
})
