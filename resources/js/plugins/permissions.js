const disappear = (el, modifiers) => {
  const hidden = modifiers && modifiers.hidden
  const disabled = modifiers && modifiers.disabled
  if (hidden) {
    el.firstElementChild.style.display = 'none'
    return true
  }
  if (disabled) {
    el.firstElementChild.disabled = true
    return true
  }
  // el.innerHTML = ''
  el.remove()
}

const haveRole = (role) => {
  if (role == null) return true
  if (window.laravel_user && window.laravel_user.admin) return true
  const userRoles = window.laravel_user && window.laravel_user.roles
  if (userRoles) {
    if (userRoles.indexOf(role) === -1) return false
    else return true
  }
  return false
}

const hasRole = (role) => {
  return haveRole(role)
}

const can = (permission, resource = null) => {
  const user = window.laravel_user
  if (user && user.admin) return true
  const userPermissions = user && user.permissions

  if (resource instanceof Object) {
    if (user.id === resource.user_id) {
      return true
    }
  }
  if (userPermissions) {
    if (userPermissions.indexOf(permission) === -1) return false
    return true
  } else return false
}

const cannot = (permission, resource = null) => {
  return !can(permission, resource)
}

export default {
  install (Vue, options) {
    // <delete-task-button v-can:delete="task"></delete-task-icon>
    // <delete-task-button v-can="delete.task"></delete-task-icon>
    // <delete-task-button v-can.disabled="delete.task"></delete-task-icon>
    // <delete-task-button v-can.hidden="delete.task"></delete-task-icon>

    Vue.directive('can', {
      bind (el, binding, vnode, oldVnode) {
        const action = binding.arg
        const resource = binding.value
        let permission
        if (resource instanceof Object) permission = binding.expression + '.' + action
        else {
          if (binding.value === null) return true
          permission = binding.value || binding.expression
        }
        if (!can(permission, resource)) disappear(el, binding.modifiers)
      }
    })
    Vue.directive('role', {
      bind (el, binding, vnode, oldVnode) {
        if (binding.value === null) return true
        const role = binding.value || binding.expression
        if (!haveRole(role)) disappear(el, binding.modifiers)
      }
    })
    // If authorID id is equal to current userId permission is always granted
    Vue.prototype.$can = can
    Vue.prototype.$cannot = cannot
    Vue.prototype.$haveRole = haveRole
    Vue.prototype.$hasRole = hasRole
  }
}
