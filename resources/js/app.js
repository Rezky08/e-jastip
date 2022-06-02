/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');
require('./form/wrapper');
const rajaOngkir = require("./api/raja-ongkir");
const selectOption = require("./form/select-option");
const dataTable = require("./table/dataTable");
const urlHelper = require("./helper/url");
const fileHelper = require("./helper/file");
const lodash = require("lodash");

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
    lodash
}

window.API = axios.create({
    baseURL: window.location.base,
    headers: {"Content-Type": "application/json"}
});

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const pages = require.context("./react/pages", true, /(\.js|\.jsx)$/i);
pages.keys().map(key =>
    require(`./react/pages/${
        key
            .split("./").pop()
    }`)
);

const components = require.context("./react/components", true, /(\.js|\.jsx)$/i);
components.keys().map(key =>
    require(`./react/components/${
        key
            .split("./").pop()
    }`)
);
