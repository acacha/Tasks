import { expect } from 'chai'
import { shallowMount, mount, Wrapper } from '@vue/test-utils'
import Tasks from '../../../resources/js/components/Tasks'
import moxios from 'moxios'

describe('Tasks.vue', () => {
  beforeEach(() => {
    // Assign test helpers methods to wrapper
    Object.assign(Wrapper.prototype, TestHelpers)
    moxios.install(axios)
  })

  afterEach(function () {
    moxios.uninstall(axios)
  })

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


  it('has_Tasks_as_name', () => {
    const wrapper = shallowMount(Tasks)
    expect(wrapper.name()).equals('Tasks')
  })

  it('has_HTMLDivElement_as_root_element', () => {
    const wrapper = shallowMount(Tasks)
    // console.log(wrapper.element)
    expect(wrapper.element).to.be.a('HTMLDivElement')
  })

  it('has_as_a_root_element_with_id_tasks', () => {
    const wrapper = mount(Tasks)
    expect(wrapper.attributes('id')).equals('tasks')
  })

  it('has_as_a_root_element_with_class_tasks', () => {
    const wrapper = mount(Tasks)
    expect(wrapper.classes()).to.contain('tasks')
  })

  it('contains_a_list', () => {
    const wrapper = mount(Tasks)
    // eslint-disable-next-line no-unused-expressions
    expect(wrapper.contains('ul')).to.be.true
  })

  it('not_shows_filters_if_task_list_is_empty', () => {
    const wrapper = mount(Tasks)
    // eslint-disable-next-line no-unused-expressions
    expect(wrapper.find('span#filters').isVisible()).to.be.false
  })

  it.only('not_shows_filters_if_task_list_is_not_empty', () => {
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

  it('contains_a_form_to_create_new_task', () => {
    const wrapper = mount(Tasks)
    // eslint-disable-next-line no-unused-expressions
    expect(wrapper.contains('input')).to.be.true
    const input = wrapper.find('input')
    // eslint-disable-next-line no-unused-expressions
    expect(input.is('input')).to.be.true
    const input1 = wrapper.find('input[name="name"]')
    // eslint-disable-next-line no-unused-expressions
    expect(input1.is('input')).to.be.true
  })

  it('check_default_state', () => {
    const wrapper = mount(Tasks)
    expect(wrapper.vm.$data.newTask).equals('')
    expect(wrapper.vm.$data.filter).equals('all')
    expect(wrapper.vm.$data.dataTasks).to.have.lengthOf(0)
    console.log(wrapper.props().tasks)
    // expect(wrapper.props().bar).to.be('baz')
    expect(wrapper.props().tasks).to.have.lengthOf(0)
  })
})
