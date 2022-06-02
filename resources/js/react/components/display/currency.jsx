import React, {Component} from 'react';
import {displayCurrency} from "@/helper/formatter";

class Currency extends Component {
    render() {
        return (
            <span>
                Rp. {displayCurrency(this.props.value ?? 0)}
            </span>
        );
    }
}

export default Currency;
