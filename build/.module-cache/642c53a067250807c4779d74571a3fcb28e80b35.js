var Tour=React.createClass({displayName: "Tour",
  render: function() {
  	var data={'nom':'Park tour royale','img':'img/imagen.jpg'};
    return (
      React.createElement("div", {className: "card row"}, 
        React.createElement("div", {className: "col s12 m4 l3"}, 
        	"ola"
        ), 
        React.createElement("div", {className: "col s12 m8 l9"}, 
        React.createElement("h3", null, data.nom)
        )
      )
    );
  }
});

React.render(
		React.createElement(Tour, null),
		document.getElementById('elemento')
	);