var Tour=React.createClass({displayName: "Tour",
  render: function() {
  	var data={'nom':'Park tour royale','desc':'esta es la descripcion del tour','img':'img/imagen.jpg','dest':'cancun'};
  	var url="www.url.com/"+data.dest;
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
        React.createElement("a", {href: data.dest, className: "btn"}, 
        	data.dest
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