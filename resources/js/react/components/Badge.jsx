import React, {Component} from 'react';
import {COLOR_PRIMARY, getColorClass} from "@/helper/color";
import {getSizeClass, SIZE_SMALL} from "@/helper/size";

const prefixClass = 'badge-'

class Badge extends Component {
    render() {
        return (
            <span className={[
                'badge',
                this.props.pill ? 'badge-pill' : null,
                this.props.color ? getColorClass(prefixClass, this.props.color, this.props.outline) : null,
                this.props.size ? getSizeClass(prefixClass, this.props.size) : null,
            ].join(" ")}>
                {this.props.children}
            </span>

        );
    }
}

Badge.defaultProps = {
    pill: true,
    size: SIZE_SMALL,
    color: COLOR_PRIMARY,

}
export default Badge;
