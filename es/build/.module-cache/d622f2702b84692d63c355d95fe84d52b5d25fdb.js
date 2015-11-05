var tour=React.createClass({displayName: "tour",
	render:function(){
		var data={'nomTour':'Park tour royale','descripcion':'esta es la descripcion de tour'};		
		return(
				React.createElement("div", {className: "card"}, 
					data.nomTour
				)
			);
	}
});

React.render(
		React.createElement("tour", null),
		document.getElementById('elemento')
	);