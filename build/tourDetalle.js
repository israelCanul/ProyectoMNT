'use strict';

var Tour = React.createClass({
    displayName: 'Tour',

    getInitialState: function getInitialState() {
        return {
            titulo: this.props.data.tour,
            rates: this.props.data.tarifas,
            availability: this.props.data.availability,
            coordinates: this.props.data.coordinates,
            destination: this.props.data.destination,
            gallery: this.props.data.gallery,
            description: this.props.data.description,
            params: this.props.data.params,
            supplier: this.props.data.supplier
        };
    },
    render: function render() {
        return React.createElement(
            'div',
            { className: 'col s12' },
            React.createElement(Titulo, { fecha: this.props.fecha, params: this.state.params, titulo: this.state.titulo, destination: this.state.destination, supplier: this.state.supplier }),
            React.createElement(Description, { descripcion: this.state.description }),
            React.createElement(Gallery, { gallery: this.state.gallery }),
            React.createElement(Bookin, { params: this.state.params }),
            React.createElement(Rates, { rates: this.state.rates, params: this.state.params }),
            React.createElement(Detalle, { descripcion: this.state.description })
        );
    }
});
var Detalle = React.createClass({
    displayName: 'Detalle',

    render: function render() {
        return React.createElement(
            'div',
            { classname: 'col s12' },
            React.createElement(
                'div',
                { className: 'col s12' },
                React.createElement(
                    'label',
                    null,
                    'Departure'
                ),
                React.createElement(
                    'p',
                    null,
                    this.props.descripcion
                )
            )
        );
    }
});
var Rates = React.createClass({
    displayName: 'Rates',

    getInitialState: function getInitialState() {
        return {
            params: this.props.params
        };
    },
    render: function render() {
        var params = this.state.params;
        var rates = function rates(rate) {

            return React.createElement(
                'div',
                { className: 'col s12' },
                React.createElement(
                    'h6',
                    null,
                    rate.tarifaNombre
                ),
                React.createElement(
                    'div',
                    { className: 'col 12 m8 rateLeft' },
                    React.createElement(
                        'div',
                        { className: 'col 12' },
                        "Children: " + params.currency + " " + rate.tarifaNino
                    ),
                    React.createElement(
                        'div',
                        { className: 'col 12' },
                        "Adults: " + params.currency + " " + rate.tarifaAdult
                    )
                ),
                React.createElement(
                    'div',
                    { className: 'col 12 m4 ' },
                    React.createElement(
                        'div',
                        { className: 'row' },
                        React.createElement(
                            'div',
                            { className: 'col s12 m6 rateRight' },
                            params.currency + " $" + rate.tarifaTotal + " "
                        ),
                        React.createElement(
                            'div',
                            { className: 'col s12 m6 rateRight' },
                            React.createElement(
                                'a',
                                { className: 'btn red', href: "/tour/agregar?jnfe=" + rate.jnfe },
                                'Book'
                            )
                        )
                    )
                )
            );
        };
        return React.createElement(
            'div',
            { className: 'descriptionTour col s12' },
            this.props.rates.map(rates)
        );
    }
});
var Bookin = React.createClass({
    displayName: 'Bookin',

    render: function render() {
        return React.createElement(
            'div',
            { classname: 'col s12' },
            React.createElement(
                'div',
                { className: 'input-field col s12 m4' },
                React.createElement('input', { type: 'date', className: 'datepicker', type: 'date', name: 'tour-Checkin', id: 'tour-Checkin' })
            ),
            React.createElement(
                'div',
                { className: 'input-field col s12 m4' },
                React.createElement('input', { type: 'text', id: 'adults', name: 'tour-Checkin' }),
                React.createElement(
                    'label',
                    { 'for': 'adults', className: 'active' },
                    'Materialize Select'
                )
            ),
            React.createElement(
                'div',
                { className: 'input-field col s12 m4' },
                React.createElement('input', { type: 'text', id: 'child', name: 'tour-Checkin' }),
                React.createElement(
                    'label',
                    { 'for': 'child', className: 'active' },
                    'Materialize Select'
                )
            )
        );
    }
});

var Titulo = React.createClass({
    displayName: 'Titulo',

    render: function render() {
        return React.createElement(
            'div',
            { className: 'col s12' },
            React.createElement(
                'div',
                { className: 'descriptionTour row' },
                React.createElement(
                    'div',
                    { className: 'col s12 m8' },
                    React.createElement(
                        'h5',
                        { className: 'infoSearch' },
                        "Tour-" + this.props.titulo.name
                    ),
                    React.createElement(
                        'h6',
                        { className: 'infoSearch' },
                        this.props.destination.name
                    ),
                    React.createElement(
                        'h6',
                        { className: 'infoSearch' },
                        "On " + this.props.fecha + ", " + this.props.params.adults + " Adults, " + this.props.params.ninos + " Children"
                    )
                ),
                React.createElement(
                    'div',
                    { className: 'col s12 m4' },
                    React.createElement(
                        'div',
                        { className: 'textoTitulo' },
                        "Operated by: " + this.props.supplier
                    )
                )
            )
        );
    }
});

var Description = React.createClass({
    displayName: 'Description',

    render: function render() {

        return React.createElement(
            'div',
            { className: 'col s12' },
            React.createElement(
                'p',
                { className: 'descriptionTextTour' },
                this.props.descripcion
            )
        );
    }
});

var Gallery = React.createClass({
    displayName: 'Gallery',

    render: function render() {
        var imagenes = function imagenes(img) {
            return React.createElement(
                'div',
                { className: 'item' },
                React.createElement('img', { className: 'responsive-img', src: "//apstatic.lomastravel.com.mx/800/" + img.file, alt: img.alt })
            );
        };
        return React.createElement(
            'div',
            { className: 'col s12 descriptionTour', id: 'owl-demo' },
            this.props.gallery.map(imagenes)
        );
    }
});

React.render(React.createElement(Tour, { data: data, fecha: fecha }), document.getElementById('tourDetalle'));