export const routeUri = (name, data = {}) => {
    let url = laravel?.routes[name]?.uri ?? ""
    Object.entries(data).map(([key, value]) => {
        url = url?.replace(`{${key}}`, value);
    });
    return "/" + url;
};
export default {routeUri}
