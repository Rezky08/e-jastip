const breakPoints = {
    xs: 0,
    sm: 576,
    md: 768,
    lg: 992,
    xl: 1200,
    xxl: 1400
}

const getBreakPoint = () => {
    let result = "xs";

    if (window.innerWidth < breakPoints.sm) {
        return result
    } else {
        Object.values(breakPoints).slice(1).some((value, index) => {
            if (window.innerWidth >= value) {
                result = Object.keys(breakPoints).slice(1)[index]
            }
        })
    }
    return result
}
window.getBreakPoint = getBreakPoint
