export const api_raja_ongkir = axios.create({
    baseURL: window.location.origin + "/api/raja-ongkir",
    headers: {"Content-Type": "application/json"}
})
export const getProvince = (filter={})=>{
    return api_raja_ongkir.get("geo/provinsi",{params:filter}).then(({data})=>data)
}
export const getCity = (filter={})=>{
    return api_raja_ongkir.get("geo/kota",{params:filter}).then(({data})=>data)
}
export const getDistrict = (filter={})=>{
    return api_raja_ongkir.get("geo/kecamatan",{params:filter}).then(({data})=>data)
}

export default {getProvince,getCity,getDistrict}
