import React, {Component} from 'react';
import ReactDOM from "react-dom";
import OrderCard from "@/react/components/OrderCard";
import Pagination from "@/react/components/Pagination";
import Button from "@/react/components/Button";
import {COLOR_INFO} from "@/helper/color";
import {routeUri} from "@/helper/url";

class Ongoing extends Component {
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
                    <a href={routeUri('sprinter.order.ongoing.detail', {order: item?.order?.id})}>
                        <Button color={COLOR_INFO} outline>
                            detail
                        </Button>
                    </a>
                }/>)}
                <Pagination config={this.state.paginator}/>
            </div>
        );
    }
}

export default Ongoing;

if (document.getElementById('sprinter-order-ongoing')) {
    ReactDOM.render(<Ongoing/>, document.getElementById('sprinter-order-ongoing'));
}
