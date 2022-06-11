import {COLOR_INFO, COLOR_PRIMARY, COLOR_SUCCESS, COLOR_WARNING} from "@/helper/color";

export const ORDER_STATUS_TAKEN = 1;
export const ORDER_STATUS_PRINT = 2;
export const ORDER_STATUS_TO_UNIVERSITY = 3;
export const ORDER_STATUS_ARRIVED_UNIVERSITY = 4;
export const ORDER_STATUS_LEGAL_PROCESSING = 5;
export const ORDER_STATUS_LEGAL_PROCESSED = 6;
export const ORDER_STATUS_PACKING = 7;
export const ORDER_STATUS_PACKED = 8;
export const ORDER_STATUS_TO_SHIPMENT_PARTNER = 9;
export const ORDER_STATUS_SHIPPING = 10;
export const ORDER_STATUS_RECEIVED = 11;
export const ORDER_STATUS_ARRIVED = 12;

export const ORDER_STATUSES = (() => {
    const statuses = {}
    statuses[ORDER_STATUS_TAKEN] = 'Pesanan Diambil';
    statuses[ORDER_STATUS_PRINT] = "Pesanan Dicetak";
    statuses[ORDER_STATUS_TO_UNIVERSITY] = "Menuju Universitas";
    statuses[ORDER_STATUS_ARRIVED_UNIVERSITY] = "Sampai Universitas";
    statuses[ORDER_STATUS_LEGAL_PROCESSING] = "Proses Legalisasi";
    statuses[ORDER_STATUS_LEGAL_PROCESSED] = "Selesai Legalisasi";
    statuses[ORDER_STATUS_PACKING] = "Pengemasan";
    statuses[ORDER_STATUS_PACKED] = "Selesai Dikemas";
    statuses[ORDER_STATUS_TO_SHIPMENT_PARTNER] = "Menuju Jasa Pengiriman";
    statuses[ORDER_STATUS_SHIPPING] = "Dalam Pengiriman";
    statuses[ORDER_STATUS_RECEIVED] = "Pesanan diterima";
    statuses[ORDER_STATUS_ARRIVED] = "Pesanan telah sampai ditujuan";
    return statuses
})()

export const ORDER_STATUS_COLORS = (() => {
    const colors = {}
    colors[COLOR_INFO] = [ORDER_STATUS_TAKEN, ORDER_STATUS_PRINT];
    colors[COLOR_WARNING] = [ORDER_STATUS_LEGAL_PROCESSING, ORDER_STATUS_PACKING, ORDER_STATUS_SHIPPING, ORDER_STATUS_TO_UNIVERSITY];
    colors[COLOR_SUCCESS] = [ORDER_STATUS_ARRIVED_UNIVERSITY, ORDER_STATUS_LEGAL_PROCESSED, ORDER_STATUS_PACKED, ORDER_STATUS_RECEIVED, ORDER_STATUS_ARRIVED];
    return colors
})()

export const getOrderColorByStatus = (status = ORDER_STATUS_TAKEN) => {
    const color = Object.entries(ORDER_STATUS_COLORS).find(function ([key, value]) {
        if (value.includes(status)) {
            return true
        }
    })
    return color[0] ?? COLOR_INFO;
}
export default {
    getOrderColorByStatus,
    ORDER_STATUS_TAKEN,
    ORDER_STATUS_PRINT,
    ORDER_STATUS_TO_UNIVERSITY,
    ORDER_STATUS_ARRIVED_UNIVERSITY,
    ORDER_STATUS_LEGAL_PROCESSING,
    ORDER_STATUS_LEGAL_PROCESSED,
    ORDER_STATUS_PACKING,
    ORDER_STATUS_PACKED,
    ORDER_STATUS_TO_SHIPMENT_PARTNER,
    ORDER_STATUS_SHIPPING,
    ORDER_STATUS_RECEIVED,
    ORDER_STATUS_ARRIVED,
    ORDER_STATUSES,
    ORDER_STATUS_COLORS,
}
