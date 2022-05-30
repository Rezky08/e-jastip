export const displayCurrency = (currency) =>
    new Intl.NumberFormat("ID", {
        // These options are needed to round to whole numbers if that's what you want.
        //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
        maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
    }).format(currency ?? 0);
export default {displayCurrency}