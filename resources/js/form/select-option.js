export const optionElement = (item = {}) => `<option value="${(item['value'] ?? '')}" ${item['disabled'] && 'disabled'} ${item['selected'] && 'selected'}>${item['label'] ?? ''}</option>`;

export const optionApi = (url,id, additionalParams) => $(`#${id}`).select2({
    theme: "bootstrap4",
    ajax: {
        url,
        data: function (params) {
            // Query parameters will be ?search=[term]&type=public
            return {
                search: params.term,
                ...additionalParams
            };
        },
        processResults: function ({data}) {
            return {
                results: data
            };
        },
    },

});
export default {optionElement, optionApi}
