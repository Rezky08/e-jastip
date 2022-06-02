import React, {Component} from 'react';
import ReactDOM from "react-dom";
import Card from "./Card";
import Currency from "@/react/components/display/currency";
import Button from "@/react/components/Button";
import {COLOR_INFO} from "@/helper/color";
import Form from "@/react/components/Form";

class OrderCard extends Component {
    render() {
        return (
            <Card>
                <div className="row align-items-center">
                    <div className="col-8">
                        <div className="d-flex flex-column">
                            <span className="font-weight-bold">#{this.props.data?.token ?? null}</span>
                            <span>{this.props.data?.university?.name ?? null}</span>
                            <span className="font-weight-bold">
                                <Currency value={this.props.data?.invoice?.calculated?.total}/>
                                {/*<x-display.display-currency amount="{{$data->invoice->calculated['total']??0}}"/>*/}
                </span>
                        </div>
                    </div>
                    <div className="col-4 text-right">
                        <Form method="POST"
                              action={helper.url.routeUri('sprinter.order.incoming.take', {transaction: this.props.data?.id ?? null})}>
                            <Button color={COLOR_INFO} outline>
                                ambil
                            </Button>
                        </Form>

                    </div>
                </div>
            </Card>
        );
    }
}

export default OrderCard;

if (document.getElementById('order-card')) {
    ReactDOM.render(<OrderCard/>, document.getElementById('order-card'));
}
