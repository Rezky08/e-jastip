import React, {Component} from 'react';
import ReactDOM from "react-dom";
import OrderCard from "@/react/components/OrderCard";
import Pagination from "@/react/components/Pagination";
import Button from "@/react/components/Button";
import {COLOR_INFO} from "@/helper/color";
import Form from "@/react/components/Form";

class Incoming extends Component {
    constructor(props) {
        super(props);
        this.state = {
            data: [],
            paginator: {}
        }
    }

    componentDidMount() {
        API.get(location.href).then(({data}) => {
            this.setState({data: data?.data, paginator: data?.paginator}, () => console.log(this.state))
        })
    }

    render() {
        return (
            <div className="d-flex flex-column" style={{gap: "1rem"}}>
                {this.state.data.map((item, key) => <OrderCard key={key} data={item} action={
                    <Form method="POST"
                          action={helper.url.routeUri('sprinter.order.incoming.take', {transaction: item?.id ?? null})}>
                        <Button color={COLOR_INFO} outline>
                            ambil
                        </Button>
                    </Form>
                }/>)}
                <Pagination config={this.state.paginator}/>
            </div>
        );
    }
}

export default Incoming;

if (document.getElementById('sprinter-order-incoming')) {
    ReactDOM.render(<Incoming/>, document.getElementById('sprinter-order-incoming'));
}
