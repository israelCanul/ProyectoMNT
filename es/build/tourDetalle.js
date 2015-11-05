'use strict';

function nl2br(str, is_xhtml) {
    var breakTag = is_xhtml || typeof is_xhtml === 'undefined' ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

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
            React.createElement(Rates, { rates: this.state.rates, params: this.state.params }),
            React.createElement(Detalle, { descripcion: this.state.description, titulo: this.state.titulo, disponibilidad: this.state.availability })
        );
    }
});
var Detalle = React.createClass({
    displayName: 'Detalle',

    render: function render() {
        var departure = nl2br(this.props.descripcion.departure);inclutions;
        var inclutions = nl2br(this.props.descripcion.inclutions);
        var noinclutions = nl2br(this.props.descripcion.exclusiones);
        var recommendations = nl2br(this.props.descripcion.recomendations);
        var regulations = nl2br(this.props.descripcion.regulations);
        var policies = nl2br(this.props.descripcion.policies);

        return React.createElement(
            'div',
            { className: 'col s12 detalles descriptionTour' },
            React.createElement(
                'div',
                { className: 'col s12' },
                React.createElement(
                    'h6',
                    null,
                    'Duration:'
                ),
                React.createElement(
                    'p',
                    null,
                    this.props.titulo.duracion
                )
            ),
            React.createElement(
                'div',
                { className: 'col s12' },
                React.createElement(
                    'h6',
                    null,
                    'Available on the following days'
                ),
                React.createElement(
                    'div',
                    { className: 'dayAvailable col s4 m3 l1' },
                    React.createElement(
                        'h6',
                        null,
                        'Monday'
                    ),
                    React.createElement('img', { src: "/images/icon/" + this.props.disponibilidad.lunes, className: 'responsive-img' })
                ),
                React.createElement(
                    'div',
                    { className: 'dayAvailable col s4 m3 l1' },
                    React.createElement(
                        'h6',
                        null,
                        'Tuesday'
                    ),
                    React.createElement('img', { src: "/images/icon/" + this.props.disponibilidad.martes, className: 'responsive-img' })
                ),
                React.createElement(
                    'div',
                    { className: 'dayAvailable col s4 m3 l1' },
                    React.createElement(
                        'h6',
                        null,
                        'Wednesday'
                    ),
                    React.createElement('img', { src: "/images/icon/" + this.props.disponibilidad.miercoles, className: 'responsive-img' })
                ),
                React.createElement(
                    'div',
                    { className: 'dayAvailable col s4 m3 l1' },
                    React.createElement(
                        'h6',
                        null,
                        'Thursday'
                    ),
                    React.createElement('img', { src: "/images/icon/" + this.props.disponibilidad.jueves, className: 'responsive-img' })
                ),
                React.createElement(
                    'div',
                    { className: 'dayAvailable col s4 m3 l1' },
                    React.createElement(
                        'h6',
                        null,
                        'Friday'
                    ),
                    React.createElement('img', { src: "/images/icon/" + this.props.disponibilidad.viernes, className: 'responsive-img' })
                ),
                React.createElement(
                    'div',
                    { className: 'dayAvailable col s4 m3 l1' },
                    React.createElement(
                        'h6',
                        null,
                        'Saturday'
                    ),
                    React.createElement('img', { src: "/images/icon/" + this.props.disponibilidad.sabado, className: 'responsive-img' })
                ),
                React.createElement(
                    'div',
                    { className: 'dayAvailable col s4 m3 l1' },
                    React.createElement(
                        'h6',
                        null,
                        'Sunday'
                    ),
                    React.createElement('img', { src: "/images/icon/" + this.props.disponibilidad.domingo, className: 'responsive-img' })
                )
            ),
            React.createElement(
                'div',
                { className: 'col s12' },
                React.createElement(
                    'h6',
                    null,
                    'Departure'
                ),
                React.createElement('p', { dangerouslySetInnerHTML: { __html: departure } })
            ),
            React.createElement(
                'div',
                { className: 'col s12' },
                React.createElement(
                    'h6',
                    null,
                    'Included'
                ),
                React.createElement('p', { dangerouslySetInnerHTML: { __html: inclutions } })
            ),
            React.createElement(
                'div',
                { className: 'col s12' },
                React.createElement(
                    'h6',
                    null,
                    'Not Included'
                ),
                React.createElement('p', { dangerouslySetInnerHTML: { __html: noinclutions } })
            ),
            React.createElement(
                'div',
                { className: 'col s12' },
                React.createElement(
                    'h6',
                    null,
                    'Recommendations'
                ),
                React.createElement('p', { dangerouslySetInnerHTML: { __html: recommendations } })
            ),
            React.createElement(
                'div',
                { className: 'col s12' },
                React.createElement(
                    'h6',
                    null,
                    'Regulations'
                ),
                React.createElement('p', { dangerouslySetInnerHTML: { __html: regulations } })
            ),
            React.createElement(
                'div',
                { className: 'col s12' },
                React.createElement(
                    'h6',
                    null,
                    'Cancellation Policies'
                ),
                React.createElement('p', { dangerouslySetInnerHTML: { __html: policies } })
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
            var tarifaAdulto = function tarifaAdulto(rate) {
                if (params.adults > 0) {
                    return React.createElement(
                        'div',
                        { className: 'col 12' },
                        "Adults: " + params.currency + " " + rate.tarifaAdult
                    );
                }
            };
            var tarifaNino = function tarifaNino(rate) {
                if (params.ninos > 0) {
                    return React.createElement(
                        'div',
                        { className: 'col 12' },
                        "Children: " + params.currency + " " + rate.tarifaNino
                    );
                }
            };
            var botonBook = function botonBook(rate) {
                if (rate.tarifaDisponible == 1) {
                    return React.createElement(
                        'div',
                        { className: 'col s12 m6 rateRight' },
                        React.createElement('input', { type: 'submit', value: 'Book', className: 'btn btn-large col s12 red' }),
                        React.createElement('input', { type: 'hidden', value: '1', name: 'fromDetails', className: 'btn btn-large col s12 red' }),
                        React.createElement('input', { name: 'jnfe', value: rate.jnfe, type: 'hidden' })
                    );
                }
            };
            var precio = function precio(rate) {
                if (rate.tarifaDisponible == 1) {
                    return React.createElement(
                        'center',
                        null,
                        params.currency + " $" + rate.tarifaTotal + " "
                    );
                } else {
                    return React.createElement('center', { className: 'black-text', dangerouslySetInnerHTML: { __html: rate.tarifaTotal } });
                }
            };
            return React.createElement(
                'div',
                { className: 'col s12 rate' },
                React.createElement(
                    'form',
                    { method: 'Post', action: '/tour/agregar.html' },
                    React.createElement(
                        'h6',
                        { className: 'red-text' },
                        rate.tarifaNombre
                    ),
                    React.createElement(
                        'div',
                        { className: 'col s12 m6 l8 rateLeft' },
                        tarifaNino(rate),
                        tarifaAdulto(rate)
                    ),
                    React.createElement(
                        'div',
                        { className: 'col s12 m6 l4' },
                        React.createElement(
                            'div',
                            { className: 'row' },
                            React.createElement(
                                'div',
                                { className: 'col s12 m6 rateRight' },
                                precio(rate)
                            ),
                            botonBook(rate)
                        )
                    )
                )
            );
        };
        return React.createElement(
            'div',
            { className: 'descriptionTour col s12 wrap-rate' },
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
                React.createElement('input', { type: 'date', className: 'datepicker', name: 'tour-Checkin', id: 'tour-Checkin' })
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
                this.props.descripcion.description
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