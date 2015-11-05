var Tour=React.createClass({displayName: "Tour",
  render: function() {
    return (
      React.createElement("div", {className: "card"}, 
        
        "It is" 
      )
    );
  }
});

React.render(
		React.createElement(Tour, null),
		document.getElementById('elemento')
	);