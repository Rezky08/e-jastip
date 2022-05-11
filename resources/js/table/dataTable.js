export const readExistingDataTable = (name) => {
    const tableSelector = `#table-${name}`;
    return new $.fn.dataTable.Api(tableSelector)
}

export const action = (dataTable, event, selector, callback) => {
    dataTable?.on(event, selector, function () {
        callback(dataTable.row($(this).parents('tr')).data())
    })
}
//     $(`#table-${name}`).on(event, selector, function () {
//     callback(dataTable.row($(this).parents('tr')).data())
// });
export default {readExistingDataTable, action}
