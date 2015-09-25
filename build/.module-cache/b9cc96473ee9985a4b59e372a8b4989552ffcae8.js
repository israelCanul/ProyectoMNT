var data={'nom':'Park tour royale','desc':'esta es la descripcion del tour','img':'img/imagen.jpg','dest':'cancun','precio':'12','currency':'USD'};

var Tour=React.createClass({displayName: "Tour",  
  render: function() {  	
  	var url="http://admin.lomastravel.com/tours/cancun.html?tour_fecha=09%2F26%2F2015&tour_adults=2&tour_childs=0";
    var urlBook="http://lomastravel.com/tours/cancun.html";
    return (
      React.createElement("div", {className: "card row"}, 
        React.createElement("div", {className: "col s12 m3 l2"}, 
        	React.createElement("img", {src: this.props.data.img, className: "responsive-img"})
        ), 
        React.createElement("div", {className: "col s12 m5 l6"}, 
        React.createElement("h3", {className: "left-align"}, this.props.data.nom), 
        React.createElement("p", null, 
        this.props.data.desc
        ), 
        "Destination:",  
        React.createElement("a", {href: url, className: "red-text"}, 
        	this.props.data.dest
        )
        ), 
        React.createElement("div", {className: "col s12 m4 l4"}, 
        	React.createElement("div", {className: "right-align col s10"}, 
        		React.createElement("small", null, "From")
        	), 
        	React.createElement("div", {className: "right-align col s10"}, 
        		"$ ", this.props.data.currency, " ", this.props.data.precio
        	), 
        	React.createElement("div", {className: "col s12 m8 offset-m2 l6 offset-l3"}, 
        		React.createElement("a", {href: urlBook, className: "col s12 btn red"}, 
        			"BOOK"
        		)
        	)	
        )
      )
    );
  }
});

React.render(
		React.createElement(Tour, {data: data}),
		document.getElementById('elemento')
	);