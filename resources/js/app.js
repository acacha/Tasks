
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import './bootstrap'
import ExampleComponent from './components/ExampleComponent.vue'
import Tasks from './components/Tasks.vue'

window.Vue = Vue
window.Vue.use(Vuetify)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.Vue.component('example-component', ExampleComponent)
window.Vue.component('tasks', Tasks)

const AppComponent = require('./App.vue')
// eslint-disable-next-line no-unused-vars
const app = new window.Vue(AppComponent)
