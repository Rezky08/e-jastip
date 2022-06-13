import React, {Component} from 'react';
import ReactDOM from "react-dom";

class Card extends Component {
    render() {
        return (
            <div className="card">
                <div className="card-body">
                    {this.props.children}
                </div>
            </div>
        );
    }
}

export default Card;

if (document.getElementById('card')) {
    ReactDOM.render(<Card/>, document.getElementById('card'));
}
