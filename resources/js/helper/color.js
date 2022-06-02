export const COLOR_PRIMARY = 'primary';
export const COLOR_SECONDARY = 'secondary';
export const COLOR_SUCCESS = 'success';
export const COLOR_DANGER = 'danger';
export const COLOR_WARNING = 'warning';
export const COLOR_INFO = 'info';
export const COLOR_LIGHT = 'light';
export const COLOR_DARK = 'dark';

export const getColorClass = (prefix = 'btn-', color, outline = false) => color ? (outline ? `${prefix}outline-${color}` : `${prefix}${color}`) : ""
