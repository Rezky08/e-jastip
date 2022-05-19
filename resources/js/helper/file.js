export const getSize = (file) => {
    let _size = file.size;
    let fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
        i = 0;
    while (_size > 900) {
        _size /= 1024;
        i++;
    }
    return (Math.round(_size * 100) / 100) + ' ' + fSExt[i]
}
export default {getSize}
