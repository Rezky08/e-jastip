import React, {Component} from 'react';
import {getSizeClass, SIZE_SMALL} from "@/helper/size";
import {COLOR_PRIMARY, getColorClass} from "@/helper/color";

const prefixClass = 'btn-'

class Button extends Component {

    render() {
        return (
            <button className={[
                "btn",
                this.props.fullWidth ? "btn-block" : null,
                this.props.rounded ? "btn-rounded" : null,
                this.props.circle ? "btn-circle" : null,
                this.props.size ? getSizeClass(prefixClass, this.props.size) : null,
                this.props.color ? getColorClass(prefixClass, this.props.color,this.props.outline) : null
            ].join(" ")}>{this.props.children}</button>

        );
    }
}

Button.defaultProps = {
    fullWidth: false,
    rounded: false,
    circle: false,
    outline: false,
    size: SIZE_SMALL,
    color: COLOR_PRIMARY,

}
export default Button;
