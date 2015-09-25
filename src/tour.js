var data=[{'nom':'Park tour royale','desc':'esta es la descripcion del tour','img':'img/imagen.jpg','dest':'cancun','precio':'12','currency':'USD'},
{'nom':'BOnanza','desc':'este es el tour de bonanza','img':'img/imagen.jpg','dest':'Puertomorelos','precio':'24','currency':'USD'}];

var Tour=React.createClass({  
  render: function() {  	
  	var url="http://admin.lomastravel.com/tours/cancun.html?tour_fecha=09%2F26%2F2015&tour_adults=2&tour_childs=0";
    var urlBook="http://lomastravel.com/tours/cancun.html";
    return (
      <div className="card hoverable row">        
        <div className="col s12 m3 l2">
        	<img src={this.props.data.img} className="responsive-img"/>
        </div>
        <div className="col s12 m5 l6">
        <h3 className="left-align">{this.props.data.nom}</h3>
        <p>
        {this.props.data.desc}
        </p>
        Destination: 
        <a href={url} className="red-text">
        	{this.props.data.dest}
        </a>
        </div>
        <div className="col s12 m4 l4">
        	<div className="right-align col s10">
        		<small>From</small>
        	</div>
        	<div className="right-align col s10">
        		$ {this.props.data.currency} {this.props.data.precio}
        	</div>
        	<div className="col s12 m8 offset-m2 l6 offset-l3">
        		<a href={urlBook} className="col s12 btn red">
        			BOOK
        		</a>
        	</div>          	
        </div>
      </div>
    );
  }
});

var ListTours=React.createClass({
	render:function(){
		var tours=this.props.data.map(function(tour){
			return(
				<Tour data={tour}/>	
				);
		});
		return(
            <div className="commentList">
              {tours}  
            </div>
			);
	}
});

React.render(
		<ListTours data={data}/>,
		document.getElementById('elemento')
	);