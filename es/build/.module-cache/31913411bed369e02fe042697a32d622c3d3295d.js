var tour=React.createClass({displayName: "tour",
	render:function(){
		var data={};		
		return(
				React.createElement("div", {className: "card"}, 
					"este es un texto"
				)
			);
	}
});

React.render(
		React.createElement("tour", null),
		document.getElementById('tour')
	);