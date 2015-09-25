var Tour=React.createClass({displayName: "Tour",
	render:function(){
		var data={'nomTour':'Park tour royale','descripcion':'esta es la descripcion de tour'};		
		return(
      React.createElement("p", {className: "btn"}, 
        "You  this. Click to toggle."
      )
			);
	}
});

React.render(
		React.createElement(Tour, null),
		document.getElementById('elemento')
	);