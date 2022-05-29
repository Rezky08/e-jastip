export const optionElement = (item = {}) => `<option value="${(item['value'] ?? '')}" ${item['disabled'] && 'disabled'} ${item['selected'] && 'selected'}>${item['label'] ?? ''}</option>`;

export const preOptionApi = (url, id, additionalParams) => {
    const selector = $(`#${id}`);
    $.ajax({
        type: 'GET',
        url,
        data: additionalParams,
    }).then(function ({data}) {
        const option = new Option(data.text, data.id, true, true);
        selector.append(option).trigger('change');
    })
}

export const optionData = (selector, data) => $(selector).empty().select2({
    theme: "bootstrap4",
    data,
});

export const optionApi = (url, id, additionalParams, initiateParams = {}) => $(`#${id}`).select2({
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
    ...initiateParams
});
export default {optionElement, optionApi, preOptionApi, optionData}
