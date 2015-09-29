'use strict';

var Tour = React.createClass({
    displayName: 'Tour',

    getInitialState: function getInitialState() {
        return {
            titulo: this.props.data.tour,
            tarifas: this.props.data.tarifas,
            availability: this.props.data.availability,
            coordinates: this.props.data.coordinates,
            destination: this.props.data.destination,
            gallery: this.props.data.gallery,
            description: this.props.data.description,
            params: this.props.data.params
        };
    },
    render: function render() {
        return React.createElement(
            'div',
            { className: 'col s12' },
            React.createElement(Titulo, { params: this.state.params, titulo: this.state.titulo, description: this.state.description, destination: this.state.destination })
        );
    }
});

var Titulo = React.createClass({
    displayName: 'Titulo',

    render: function render() {
        var fecha = function fecha() {
            //var dataDate=this.props.params.date.split("-");
            console.log('dataDate');
            /* var date = new Date(Date.UTC(dataDate[0],dataDate[1],dataDate[2], 14, 0, 0));
             var options = {
                 weekday: "long", year: "numeric", month: "short",
                 day: "numeric", hour: "2-digit", minute: "2-digit"
             };*/
            //console.log(date);
            //return date.toLocaleTimeString("en-us", options);
            return "hola";
        };
        return React.createElement(
            'div',
            { className: 'col s12' },
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
                this.fecha
            )
        );
    }
});
React.render(React.createElement(Tour, { data: data }), document.getElementById('tourDetalle'));