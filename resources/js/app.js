require('./bootstrap');
require('./form/wrapper');
const rajaOngkir = require("./api/raja-ongkir");
const selectOption = require("./form/select-option");
const dataTable = require("./table/dataTable");
const urlHelper = require("./helper/url");

window.raja_ongkir = rajaOngkir
window.form = {
    select: selectOption
}
window.table = {
    dataTable
}
window.helper = {
    url: urlHelper
}
