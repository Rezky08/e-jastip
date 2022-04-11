require('./bootstrap');
const rajaOngkir = require("./api/raja-ongkir");
const selectOption = require("./form/select-option");

window.raja_ongkir = rajaOngkir
window.form = {
    select : selectOption
}
