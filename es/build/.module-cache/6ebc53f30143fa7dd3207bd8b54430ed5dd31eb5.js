
var Tour=React.createClass({displayName: "Tour",  
  render: function() {
	 var clase="hidden";
	  if(this.props.num>4){
		clase="";
	 }
    return (
      React.createElement("div", {className: clase+"card-panel hoverable row card-tours elementList list-item"}, 
        React.createElement("div", {className: "col s12 m3 l2"}, 
        	React.createElement("img", {alt: this.props.data.photo.alt, src: "//apstatic.lomastravel.com.mx/204/"+this.props.data.photo.file, className: "responsive-img"})
        ), 
        React.createElement("div", {className: "col s12 m5 l6"}, 
        React.createElement("a", {href: urlBase+"tours/"+this.props.data.tour.clave+".html?"+dataUrl}, React.createElement("h5", {className: "tituloCard red-text left-align"}, this.props.data.tour.name)), 
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
	render:function(){
		var cont=0;
		var tours = this.props.data.map(function (tour) {
			return (
				React.createElement(Tour, {data: tour, num: cont})
			);
		});
		if(this.props.data.length==0){
			console.log(tours);
			return(
				React.createElement("div", {className: "commentList list box text-shadow"}, 
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
		React.createElement(ListTours, {data: data}),
		document.getElementById('listaTours')
	);