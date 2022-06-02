import React, {Component} from 'react';
import ReactDOM from "react-dom";
import Card from "./Card";

class OrderCard extends Component {
    render() {
        return (
            <Card>
                <div className="row align-items-center">
                    <div className="col-8">
                        <div className="d-flex flex-column">
                            <span className="font-weight-bold">#{this.props.transaction ?? null}</span>
                            <span>{this.props.transaction?.university?.name}</span>
                            <span className="font-weight-bold">
                            {/*<x-display.display-currency amount="{{$transaction->invoice->calculated['total']??0}}"/>*/}
                </span>
                        </div>
                    </div>
                    <div className="col-4 text-right">
                        {/*<x-form.button size="{{\App\View\Components\Form\Button::SIZE_SMALL}}"*/}
                        {/*               type="{{\App\View\Components\Form\Button::TYPE_INFO}}" outline>*/}
                        {/*    ambil*/}
                        {/*</x-form.button>*/}
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
