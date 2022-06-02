export const SIZE_SMALL = 'sm';
export const SIZE_XSMALL = 'xs';
export const SIZE_LARGE = 'lg';
export const SIZE_XLARGE = 'xl';

export const getSizeClass = (prefix = 'btn-', size) => size ? `${prefix}${size}` : ""
