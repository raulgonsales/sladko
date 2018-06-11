
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});

$(document).ready(function () {
	//timeout to hide dropdown menu
  var hideDropdownTimeout;

  //on hover to dropdown link
  $('.dropdown a.dropdown-toggle').hover(function (e) {
    //if we`ve hovered to dropdown link from opened dropdown menu
    if($(this).next().hasClass('show')) {
      //do not hide submenu
      clearTimeout(hideDropdownTimeout);
    }

    //show submenu
    $(this).next(".dropdown-menu").addClass('show');
  }, function () {
    var that = $(this);

    //set timeout to hide submenu
    hideDropdownTimeout = setTimeout(function() {
      that.next(".dropdown-menu").removeClass('show');
    }, 100);
  });

  //on hover to submenu block
  $('.dropdown-menu').hover(function () {
    clearTimeout(hideDropdownTimeout);
  }, function () {
    var that = $(this);
    hideDropdownTimeout = setTimeout(function() {
      that.removeClass('show');
    }, 100);
  });
});