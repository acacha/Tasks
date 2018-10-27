import { expect } from 'chai'
import { mount, shallowMount, Wrapper } from '@vue/test-utils'
import Tasks from '../../../resources/js/components/Tasks'
import moxios from 'moxios'
import TestHelpers from './helpers.js'
import Vuetify from 'vuetify'
import Vue from 'vue'

Vue.use(Vuetify)
Vue.config.silent = true

describe('Tasks.vue', () => {
  beforeEach(() => {
    // Assign test helpers methods to wrapper
    Object.assign(Wrapper.prototype, TestHelpers)
    moxios.install(global.axios)
  })

  afterEach(function () {
    moxios.uninstall(global.axios)
  })

  // Checks component's initial state
  it('check_default_state', () => {
    const wrapper = mount(Tasks)
    expect(wrapper.vm.$data.newTask).equals('')
    expect(wrapper.vm.$data.filter).equals('all')
    expect(wrapper.vm.$data.dataTasks).to.have.lengthOf(0)
    expect(wrapper.props().tasks).to.have.lengthOf(0)
  })

  // RENDERED OUTPUT (HTML/DOM OUTPUT TEMPLATE)

  // Checking shows a list
  // Checking DOM -> Ok però compte si canviem la plantilla podem tenir que canviar el test
  it('contains_a_list_of_tasks', () => {
    // Prepare

    // 2 execute
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: [
          {
            id: 1,
            name: 'Compra pa',
            completed: true
          },
          {
            id: 2,
            name: 'Compra llet',
            completed: false
          },
          {
            id: 3,
            name: 'Estudiar PHP',
            completed: false
          }
        ]
      }
    })

    // 3 assert
    expect(wrapper.text()).to.contain('todo')
  })

  it('shows_nothing_when_no_tasks_provided', () => {
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: []
      }
    })
    expect(wrapper.text()).to.contain('todo')
  })

  // Checking DOM -> Ok però compte si canviem la plantilla podem tenir que canviar el test
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

  // Checking conditional rendering
  it('not_shows_filters_if_task_list_is_empty', () => {
    const wrapper = mount(Tasks)
    // eslint-disable-next-line no-unused-expressions
    expect(wrapper.find('span#filters').isVisible()).to.be.false
  })

  // TODO 1
  it('show_all_tasks_when_all_filter_is_selected', () => {
    // Prepare
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: [
          {
            id: 1,
            name: 'Compra pa',
            completed: true
          },
          {
            id: 2,
            name: 'Compra llet',
            completed: false
          },
          {
            id: 3,
            name: 'Estudiar PHP',
            completed: false
          }
        ]
      }
    })

    // 2 Execute -> click on filter all

    // 3 Assert see all tasks
    expect(wrapper.text()).to.contain('todo')
  })

  // TODO 2
  it('shows_only_completed_tasks_when_completed_filter_is_selected', () => {
    // Prepare
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: [
          {
            id: 1,
            name: 'Compra pa',
            completed: true
          },
          {
            id: 2,
            name: 'Compra llet',
            completed: false
          },
          {
            id: 3,
            name: 'Estudiar PHP',
            completed: false
          }
        ]
      }
    })

    // 2 Execute -> click on filter completed

    // 3 Assert see only completed tasks
    expect(wrapper.text()).to.contain('todo')
  })

  // TODO 3
  it('shows_only_active_tasks_when_active_filter_is_selected', () => {
    // Prepare
    const wrapper = mount(Tasks, {
      propsData: {
        tasks: [
          {
            id: 1,
            name: 'Compra pa',
            completed: true
          },
          {
            id: 2,
            name: 'Compra llet',
            completed: false
          },
          {
            id: 3,
            name: 'Estudiar PHP',
            completed: false
          }
        ]
      }
    })

    // 2 Execute -> click on filter active

    // 3 Assert see only active tasks
    expect(wrapper.text()).to.contain('todo')
  })

  it('not_shows_filters_if_task_list_is_not_empty', () => {
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
    // eslint-disable-next-line no-unused-expressions
    expect(wrapper.find('span#filters').isVisible()).to.be.true
  })

  // ***************** TOTAL COMPUTED PROPERTY TESTS ****************

  // UNIT TEST-> DIRECT TEST
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

  // INDIRECT TEST -> Busquem que el total sigui correcte a la renderització/vista/dom final
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

  // ***************** TASKS WATCHER ****************
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
    wrapper.setProps({
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
    })
    expect(wrapper.vm.tasks).to.have.length(2)
  })

  // ***************** METHODS *******************

  // TODO
  it('adds_task_using_enter', (done) => {
    // https://vue-test-utils.vuejs.org/guides/dom-events.html
  })

  // ADD
  it.only('adds_task', (done) => {
    // 1 Prepare
    moxios.stubRequest('/api/v1/tasks', {
      status: 200,
      response:
        {
          id: 5,
          name: 'Nova tasca',
          completed: false
        }
    })

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

    // 2 Execute
    // Type new name
    wrapper.find("input[name='name']").element.value = 'Nova tasca'
    wrapper.find("input[name='name']").trigger('input')

    // Click
    wrapper.find('button').trigger('click')

    // ASSERT
    moxios.wait(() => {
      // console.log('Datatasks: ' + wrapper.vm.dataTasks)
      // console.log(wrapper.vm.dataTasks[0].id)
      // console.log(wrapper.vm.dataTasks[0].name)
      // console.log(wrapper.vm.dataTasks[0].completed)
      expect(wrapper.vm.dataTasks).to.have.lengthOf(3)
      expect(wrapper.vm.dataTasks[0].name).equals('Nova tasca')
      expect(wrapper.vm.dataTasks[0].completed).equals(false)
      done()
    })
  })

  // ***************** CREATED LIFECYCLE ****************
  it('fetchs_tasks_from_backend_when_no_tasks_prop_is_given', (done) => {
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
