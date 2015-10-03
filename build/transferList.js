'use strict';

var Transfers = React.createClass({
    displayName: 'Transfers',

    getInitialState: function getInitialState() {
        return {
            'destination': this.props.data.destination,
            'transfers': this.props.data.transfers,
            'params': this.props.data.params,
            'fecha': this.props.fecha
        };
    },
    render: function render() {
        return React.createElement(
            'div',
            { classname: 'row' },
            React.createElement(Titulo, { params: this.state.params, fecha: this.state.fecha, destination: this.state.destination }),
            React.createElement(ListTransfers, { transfers: this.state.transfers, params: this.state.params })
        );
    }
});

var Transfer = React.createClass({
    displayName: 'Transfer',

    render: function render() {
        return React.createElement(
            'div',
            { className: " card-panel hoverable row card-tours elementList list-item" },
            React.createElement(
                'div',
                { className: 'col s12 m3 l2' },
                React.createElement('img', { src: "/images/transfers/" + this.props.data.type.img, className: 'responsive-img' })
            ),
            React.createElement(
                'div',
                { className: 'col s12 m5 l6' },
                React.createElement(
                    'h5',
                    { className: 'tituloCard red-text left-align' },
                    this.props.data.type.name
                ),
                React.createElement('input', { type: 'hidden', name: 'idTour', value: this.props.data.type.id }),
                React.createElement(
                    'p',
                    null,
                    this.props.data.type.description
                ),
                React.createElement(
                    'h6',
                    null,
                    "From " + this.props.data.rate.min_cap + " to " + this.props.data.rate.max_cap + " Passenger(s)"
                ),
                React.createElement(
                    'h6',
                    null,
                    'Rate per vehicle'
                )
            ),
            React.createElement(
                'div',
                { className: 'col s12 m4 l4 precioDetalle' },
                React.createElement(
                    'div',
                    { className: 'right-align col s10 from' },
                    React.createElement(
                        'small',
                        null,
                        'From'
                    )
                ),
                React.createElement(
                    'div',
                    { className: 'right-align col s10 price' },
                    React.createElement(
                        'span',
                        null,
                        '$ ',
                        this.props.params.currency
                    ),
                    React.createElement(
                        'span',
                        { className: 'price' },
                        ' ',
                        this.props.data.rate.total
                    )
                ),
                React.createElement(
                    'div',
                    { className: 'col s12 m8 offset-m2 l6 offset-l3' },
                    React.createElement(
                        'a',
                        { href: "/transfers/agregar.html?jnfe=" + this.props.data.rate.jnfe, className: 'col s12 btn red' },
                        'BOOK'
                    )
                )
            )
        );
    }
});

var ListTransfers = React.createClass({
    displayName: 'ListTransfers',

    render: function render() {
        var parametros = this.props.params;

        var transfers = this.props.transfers.map(function (trans) {
            return React.createElement(Transfer, { data: trans, params: parametros });
        });

        if (this.props.transfers.length > 0) {
            return React.createElement(
                'div',
                { className: 'commentList list box text-shadow' },
                transfers
            );
        } else {
            return React.createElement(
                'div',
                { className: 'commentList list box text-shadow' },
                React.createElement(Nodatos, null)
            );
        }
    }
});

var Nodatos = React.createClass({
    displayName: 'Nodatos',

    render: function render() {
        return React.createElement(
            'p',
            null,
            'No Data Found'
        );
    }
});

var Titulo = React.createClass({
    displayName: 'Titulo',

    render: function render() {
        return React.createElement(
            'div',
            { classname: 'col s12' },
            React.createElement(
                'h6',
                null,
                this.props.fecha
            ),
            React.createElement(
                'h5',
                null,
                ' ',
                "Transfer " + this.props.destination.dest_ini.name + " to " + this.props.destination.dest_end.name
            ),
            React.createElement(
                'h6',
                null,
                "Adults: " + this.props.params.adults + " - Children: " + this.props.params.ninos
            )
        );
    }
});

React.render(React.createElement(Transfers, { data: data, fecha: fecha }), document.getElementById('detalleTour'));