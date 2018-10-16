import { expect } from 'chai'
import { shallowMount, mount, Wrapper } from '@vue/test-utils'
import Tasks from '../../../resources/js/components/Tasks'
import moxios from 'moxios'
import TestHelpers from './helpers.js'

describe('Tasks.vue', () => {
  beforeEach(() => {
    // Assign test helpers methods to wrapper
    Object.assign(Wrapper.prototype, TestHelpers)
    moxios.install(axios)
  })

  afterEach(function () {
    moxios.uninstall(axios)
  })

  // Checks component's initial state
  it('check_default_state', () => {
    const wrapper = mount(Tasks)
    expect(wrapper.vm.$data.newTask).equals('')
    expect(wrapper.vm.$data.filter).equals('all')
    expect(wrapper.vm.$data.dataTasks).to.have.lengthOf(0)
    expect(wrapper.props().tasks).to.have.lengthOf(0)
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

  // ***************** METHODS *******************

  // ADD
  it('adds_task', (done) => {
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
