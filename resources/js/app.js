

require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

// window.Vue = require('vue').default;


// Routes File Imported
import {routes} from './routes';

//Import user class in the helper globally
import User from './helpers/User';
window.User = User


//Import Notification class in the helper globally
import Notification from './helpers/Notification';
window.Notification = Notification

// sweet alert
import Swal from 'sweetalert2'
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })
  
  window.Toast = Toast;

//declaring window reload as global to make all the changes appear
//on the front end when new items is added to cart without reloading the page
window.Reload = new Vue();

// sweet alert end

const router = new VueRouter({
    routes,
    mode: 'history'
})

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);



const app = new Vue({
    el: '#app',
    router
});
