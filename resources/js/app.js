import Vue from "vue";

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./form/wrapper');
const rajaOngkir = require("./api/raja-ongkir");
const selectOption = require("./form/select-option");
const dataTable = require("./table/dataTable");
const urlHelper = require("./helper/url");
const fileHelper = require("./helper/file");
const currencyHelper = require("./helper/currency");
const lodash = require("lodash");
const size = require("./consts/size");
const color = require("./consts/color");
window.raja_ongkir = rajaOngkir
window.form = {
    select: selectOption
}
window.table = {
    dataTable
}
window.helper = {
    url: urlHelper,
    file: fileHelper,
    currency: currencyHelper,
    lodash,
}
window.consts = {
    size,
    color
}


// window.Vue = require('vue').default;
Vue.prototype.$consts = window.consts;


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */


const components = require.context("./components", true, /\.vue$/i);
components.keys().map(key =>
    Vue.component(
        key
            .split("/")
            .pop()
            .split(".")[0],
        components(key).default
    )
);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
window.onload = function () {
    new Vue({}).$mount("#app");

    // const app = new Vue({
    //     el: '#app'
    // });
}
