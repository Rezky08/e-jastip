import React, {Component} from 'react';

class Form extends Component {
    render() {
        return (
            <form {...this.props}>
                <input type="hidden" name="_token" value={window.csrf}/>
                {this.props.children}
            </form>
        );
    }
}

export default Form;
