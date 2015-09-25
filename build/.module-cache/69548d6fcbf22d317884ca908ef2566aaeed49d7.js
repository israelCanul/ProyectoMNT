var Tour=React.createClass({displayName: "Tour",
  render: function() {
  	var data={'nom':'Park tour royale','desc':'esta es la descripcion del tour','img':'img/imagen.jpg','dest':'cancun'};
  	var url="http://admin.lomastravel.com/tours/cancun.html?tour_fecha=09%2F26%2F2015&tour_adults=2&tour_childs=0";
    return (
      React.createElement("div", {className: "card row"}, 
        React.createElement("div", {className: "col s12 m4 l3"}, 
        	React.createElement("img", {src: data.img, className: "responsive-img"})
        ), 
        React.createElement("div", {className: "col s12 m8 l9"}, 
        React.createElement("h3", {className: "left-align"}, data.nom), 
        React.createElement("p", null, 
        data.desc
        ), 
        React.createElement("a", {href: url, className: "red-text"}, 
        	"Destination: ", data.dest
        )
        )
      )
    );
  }
});

React.render(
		React.createElement(Tour, null),
		document.getElementById('elemento')
	);