export const COLOR_PRIMARY = 'primary';
export const COLOR_SECONDARY = 'secondary';
export const COLOR_SUCCESS = 'success';
export const COLOR_DANGER = 'danger';
export const COLOR_WARNING = 'warning';
export const COLOR_INFO = 'info';
export const COLOR_LIGHT = 'light';
export const COLOR_DARK = 'dark';
export const COLORS = [
    COLOR_PRIMARY,
    COLOR_SECONDARY,
    COLOR_SUCCESS,
    COLOR_DANGER,
    COLOR_WARNING,
    COLOR_INFO,
    COLOR_LIGHT,
    COLOR_DARK,
]
export const getColorClass = (prefix = 'btn-', color = undefined, outline = false) => color ? `${prefix}${outline ? 'outline-' : null}${color}` : null
export default {
    COLORS,
    COLOR_PRIMARY,
    COLOR_SECONDARY,
    COLOR_SUCCESS,
    COLOR_DANGER,
    COLOR_WARNING,
    COLOR_INFO,
    COLOR_LIGHT,
    COLOR_DARK,
    getColorClass
}
