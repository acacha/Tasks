import { expect } from 'chai'
import { shallowMount, mount } from '@vue/test-utils'
import Tasks from '../../../resources/js/components/Tasks.vue'

describe('Tasks.vue', () => {
  it.only('shows_nothing_when_no_tasks_provided', () => {
    // 1 Prepare (opcional)

    // 2 Execució
    const wrapper = mount(Tasks) // <tasks></tasks>

    // 3 Expectation
    // expect(wrapper.text()).to.include('')

    console.log(wrapper.text())
  })
  it.skip('todo2', () => {

  })
})
