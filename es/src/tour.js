
var Tour=React.createClass({  
  render: function() {

    return (
      <div className={" card-panel hoverable row card-tours elementList list-item"}>
        <div className="col s12 m3 l2">
        	<img alt={this.props.data.photo.alt} src={"//apstatic.lomastravel.com.mx/204/"+this.props.data.photo.file} className="responsive-img"/>
        </div>
        <div className="col s12 m5 l6">
        <a href={urlBase+"tours/"+this.props.data.tour.clave+".html?"+dataUrl+"&TourId="+this.props.data.tour.id+"&tour_destination="+encodeURIComponent(this.props.data.tour.name).replace(/%20/g,'+')}><h5 className="tituloCard red-text left-align">{this.props.data.tour.name}</h5></a>
		<input type="hidden" name="idTour" value={this.props.data.tour.id} />
        <p>
        {this.props.data.description.short}
        </p>

        <a href={urlBase+"toursByDest/"+this.props.data.destination.clave+".html?"+dataUrl+"&tour_destination="+encodeURIComponent(this.props.data.destination.name).replace(/%20/g,'+')+"&dest="+this.props.data.destination.id} className="red-text">
        	{"Destination : "+this.props.data.destination.name}
        </a>
        </div>
        <div className="col s12 m4 l4 precioDetalle">
        	<div className="right-align col s10 from">
        		<small>From</small>
        	</div>
        	<div className="right-align col s10 price">
        		<span>$ {this.props.data.price.currency}</span><span className="price"> {" "+Math.round(this.props.data.price.average)}</span>
        	</div>
        	<div className="col s12 m8 offset-m2 l6 offset-l3">
        		<a href={urlBase+"tours/"+this.props.data.tour.clave+".html?"+dataUrl+"&TourId="+this.props.data.tour.id+"&tour_destination="+encodeURIComponent(this.props.data.tour.name).replace(/%20/g,'+')} className="col s12 btn red">
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

		var tours = this.props.data.map(function (tour) {
			return (
				<Tour data={tour}  />
			);
		});
		if(this.props.data.length==0){
			console.log(tours);
			return(
				<div className="commentList list box text-shadow">
					<Nodatos />
				</div>
			);
		}else{
			return(
				<div className="commentList list box text-shadow">
					{tours}
				</div>
			);
		}
	}
});

var Nodatos=React.createClass({
	render:function(){
		return(
			<p>No Data Found</p>
		);
	}
});

React.render(
		<ListTours data={data}/>,
		document.getElementById('listaTours')
	);