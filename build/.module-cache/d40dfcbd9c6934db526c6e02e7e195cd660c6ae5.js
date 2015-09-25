var Tour=React.createClass({displayName: "Tour",
  render: function() {
    return (
      React.createElement("div", {className: "card row"}, 
        React.createElement("div", {className: "col s12 m4 l3"}

        ), 
        React.createElement("div", {className: "col s12 m8 l9"}
        
        )
      )
    );
  }
});

React.render(
		React.createElement(Tour, null),
		document.getElementById('elemento')
	);