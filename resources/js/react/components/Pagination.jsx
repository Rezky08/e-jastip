import React, {Component} from 'react';
import PaginationBootstrap from "react-bootstrap-4-pagination";

class Pagination extends Component {
    constructor(props) {
        super(props);
    }

    getPaginatorConfig(config) {
        return {
            totalPages: config?.total_page ?? 1,
            currentPage: config?.page ?? 1,
            showMax: 5,
            // size: "lg",
            threeDots: true,
            prevNext: true,
            pageOneHref: (config?.href ?? `${location.origin}${location.pathname}`),
            href: (config?.href ?? `${location.origin}${location.pathname}`) + '?page=*', // * will be replaced by the page number
            // borderColor: 'red',
            // activeBorderColor: 'black',
            // activeBgColor: 'grey',
            // disabledBgColor: 'red',
            // activeColor: 'red',
            // color: 'purple',
            // disabledColor: 'green',
            // circle: true,
            // shadow: true
        };
    }

    render() {
        return (
            <PaginationBootstrap {...this.getPaginatorConfig(this.props.config)} />
        );
    }
}

export default Pagination;
