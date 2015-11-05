
var Tour=React.createClass({displayName: "Tour",  
  render: function() {  	


    return (
      React.createElement("div", {className: "card-panel hoverable row card-tours"}, 
        React.createElement("div", {className: "col s12 m3 l2"}, 
        	React.createElement("img", {alt: this.props.data.photo.alt, src: "//apstatic.lomastravel.com.mx/204/"+this.props.data.photo.file, className: "responsive-img"})
        ), 
        React.createElement("div", {className: "col s12 m5 l6"}, 
        React.createElement("a", {href: urlBase+"tours/"+this.props.data.tour.clave+".html"}, React.createElement("h5", {className: "tituloCard red-text left-align"}, this.props.data.tour.name)), 
		React.createElement("input", {type: "hidden", name: "idTour", value: this.props.data.tour.id}), 
        React.createElement("p", null, 
        this.props.data.description.short
        ), 

        React.createElement("a", {href: urlBase+"toursByDest/"+this.props.data.destination.clave+".html", className: "red-text"}, 
        	"Destination : "+this.props.data.destination.name
        )
        ), 
        React.createElement("div", {className: "col s12 m4 l4"}, 
        	React.createElement("div", {className: "right-align col s10"}, 
        		React.createElement("small", null, "From")
        	), 
        	React.createElement("div", {className: "right-align col s10"}, 
        		"$ ", this.props.data.price.currency, " ", this.props.data.price.average
        	), 
        	React.createElement("div", {className: "col s12 m8 offset-m2 l6 offset-l3"}, 
        		React.createElement("a", {href: urlBase+"tours/"+this.props.data.tour.clave+".html?data="+dataurl, className: "col s12 btn red"}, 
        			"BOOK"
        		)
        	)	
        )
      )
    );
  }
});

var ListTours=React.createClass({displayName: "ListTours",
	render:function(){
		var tours=this.props.data.map(function(tour){
			return(
				React.createElement(Tour, {data: tour})	
				);
		});
		return(
            React.createElement("div", {className: "commentList"}, 
              tours
            )
			);
	}
});

React.render(
		React.createElement(ListTours, {data: data}),
		document.getElementById('listaTours')
	);