
var Tour=React.createClass({displayName: "Tour",  
  render: function() {
    return (
      React.createElement("div", {className: "card-panel hoverable row card-tours"}, 
        React.createElement("div", {className: "col s12 m3 l2"}, 
        	React.createElement("img", {alt: this.props.data.photo.alt, src: "//apstatic.lomastravel.com.mx/204/"+this.props.data.photo.file, className: "responsive-img"})
        ), 
        React.createElement("div", {className: "col s12 m5 l6"}, 
        React.createElement("a", {href: urlBase+"tours/"+this.props.data.tour.clave+".html"+dataUrl}, React.createElement("h5", {className: "tituloCard red-text left-align"}, this.props.data.tour.name)), 
		React.createElement("input", {type: "hidden", name: "idTour", value: this.props.data.tour.id}), 
        React.createElement("p", null, 
        this.props.data.description.short
        ), 

        React.createElement("a", {href: urlBase+"toursByDest/"+this.props.data.destination.clave+".html?"+dataUrl, className: "red-text"}, 
        	"Destination : "+this.props.data.destination.name
        )
        ), 
        React.createElement("div", {className: "col s12 m4 l4 precioDetalle"}, 
        	React.createElement("div", {className: "right-align col s10 from"}, 
        		React.createElement("small", null, "From")
        	), 
        	React.createElement("div", {className: "right-align col s10 price"}, 
        		"$ ", this.props.data.price.currency, " ", this.props.data.price.average
        	), 
        	React.createElement("div", {className: "col s12 m8 offset-m2 l6 offset-l3"}, 
        		React.createElement("a", {href: urlBase+"tours/"+this.props.data.tour.clave+".html?"+dataUrl, className: "col s12 btn red"}, 
        			"BOOK"
        		)
        	)	
        )
      )
    );
  }
});

var ListTours=React.createClass({displayName: "ListTours",
	loadCommentsFromServer:function(){
		console.log(this.props.url);
		$.ajax({
			url: this.props.url,
			dataType: 'json',
			cache: false,
			success: function(data) {
				this.setState({data: data});
			}.bind(this),
			error: function(xhr, status, err) {
				console.error(this.props.url, status, err.toString());
			}.bind(this)
		});
	},
	componentDidMount: function() {
		this.loadCommentsFromServer();
		setInterval(this.loadCommentsFromServer, this.props.pollInterval);
	},
	getInitialState:function(){
		return{data:[]};
	},
	render:function(){
		var tours = this.state.data.map(function (tour) {
			return (
				React.createElement(Tour, {data: tour})
			);
		});
		if(this.state.data.length==0){
			console.log(tours);
			return(
				React.createElement("div", {className: "commentList"}, 
					React.createElement(Nodatos, null)
				)
			);
		}else{
			return(
				React.createElement("div", {className: "commentList"}, 
					tours
				)
			);
		}
	}
});

var Nodatos=React.createClass({displayName: "Nodatos",
	render:function(){
		return(
			React.createElement("p", null, "No Data Found")
		);
	}
});

React.render(
		React.createElement(ListTours, {url: data}),
		document.getElementById('listaTours')
	);