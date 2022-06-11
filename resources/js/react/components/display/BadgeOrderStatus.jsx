import React, {Component} from 'react';
import Badge from "@/react/components/Badge";
import {getOrderColorByStatus, ORDER_STATUS_TAKEN, ORDER_STATUSES} from "@/consts/Order";

class BadgeOrderStatus extends Component {
    render() {
        return (
            <Badge color={getOrderColorByStatus(this.props.status)}>
                <span className="text-wrap">
                    {ORDER_STATUSES[this.props.status]}
                </span>
            </Badge>
        );
    }
}

BadgeOrderStatus.defaultProps = {
    status: ORDER_STATUS_TAKEN
}
export default BadgeOrderStatus;
