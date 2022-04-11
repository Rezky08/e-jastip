export const optionElement = (item) => `<option value="${item['value']??''}" ${item['disabled'] && 'disabled'} ${item['selected'] && 'selected'}>${item['label']??''}</option>`;
export default {optionElement}
