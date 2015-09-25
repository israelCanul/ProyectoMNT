var Tour=React.createClass({displayName: "Tour",
  render: function() {
  	var data={'nom':'Park tour royale','img':'img/imagen.jpg'};
    return (
      React.createElement("div", {className: "card row"}, 
        React.createElement("div", {className: "col s12 m4 l3"}, 
        	React.createElement("img", {src: data.img, className: "responsive-img"})
        ), 
        React.createElement("div", {className: "col s12 m8 l9"}, 
        React.createElement("h3", {className: "left-align"}, data.nom), 
        React.createElement("p", null, 
        data.desc
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