export const SIZE_XSMALL = 'xs'
export const SIZE_SMALL = 'sm'
export const SIZE_LARGE = 'lg'
export const SIZE_XLARGE = 'xl'
export const SIZES = [
    SIZE_XSMALL,
    SIZE_SMALL,
    SIZE_LARGE,
    SIZE_XLARGE,
];
export const getSizeClass = (prefix = 'btn-', size = undefined) => size ? `${prefix}${size}` : null
export default {SIZES, SIZE_XLARGE, SIZE_SMALL, SIZE_LARGE, SIZE_XSMALL, getSizeClass}
