/* eslint-disable no-undef */
export default {
  assertContains: function (selector) {
    expect(this.contains(selector)).toBe(true)
  },
  assertSee: function (text, selector) {
    let wrap = selector ? this.find(selector) : this
    expect(wrap.html()).toContain(text)
  },
  assertEmitted: function (event) {
    expect(this.emitted()[event]).toBeTruthy()
  },
  assertEventContains: function (event, key, value) {
    expect(this.emitted()[event][key]).toBe(value)
  },
  type: function (selector, text) {
    let node = this.find(selector)
    node.element.value = text
    node.trigger('input')
  },
  click: function (selector) {
    this.find(selector).trigger('click')
  }
}
