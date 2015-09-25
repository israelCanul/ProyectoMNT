var tour=React.createClass({displayName: "tour",
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
		React.createElement("tour", null),
		document.getElementById('elemento')
	);