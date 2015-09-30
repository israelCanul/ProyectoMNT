var Tour=React.createClass({
    getInitialState:function(){
        return{
            titulo:this.props.data.tour,
            rates:this.props.data.tarifas,
            availability:this.props.data.availability,
            coordinates:this.props.data.coordinates,
            destination:this.props.data.destination,
            gallery:this.props.data.gallery,
            description:this.props.data.description,
            params:this.props.data.params,
            supplier:this.props.data.supplier
        };
    },
    render:function(){
        return(
            <div className='col s12'>
                <Titulo fecha={this.props.fecha} params={this.state.params} titulo={this.state.titulo} destination={this.state.destination} supplier={this.state.supplier}/>
                <Description descripcion={this.state.description}/>
                <Gallery gallery={this.state.gallery}/>
                <Bookin params={this.state.params} />
                <Rates rates={this.state.rates} params={this.state.params}/>
                <Detalle descripcion={this.state.description} />
            </div>
        );
    }
});
var Detalle=React.createClass({
    render:function(){
        return(
            <div classname='col s12'>
                <div className="col s12">
                    <label>Departure</label>
                    <p>
                        {this.props.descripcion}
                    </p>
                </div>
            </div>
        );
    }
});
var Rates=React.createClass({
    getInitialState:function(){
        return{
            params:this.props.params
        };
    },
    render:function(){
    var params=this.state.params;
    var rates= function (rate) {

        return(
            <div className='col s12'>
                <h6>{rate.tarifaNombre}</h6>
                <div className='col 12 m8 rateLeft'>
                    <div className='col 12'>
                        {"Children: "+params.currency+" "+rate.tarifaNino}
                    </div>
                    <div className='col 12'>
                        {"Adults: "+params.currency+" "+rate.tarifaAdult}
                    </div>
                </div>
                <div className='col 12 m4 '>
                    <div className='row'>
                        <div className='col s12 m6 rateRight'>
                        {params.currency+" $"+rate.tarifaTotal+" "}
                        </div>
                        <div className='col s12 m6 rateRight'>
                            <a className='btn red' href={"/tour/agregar?jnfe="+rate.jnfe} >Book</a>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
        return(
            <div className='descriptionTour col s12'>
                {this.props.rates.map(rates)}
            </div>
        );
    }
});
var Bookin=React.createClass({
    render:function(){
        return(
            <div classname='col s12'>
                <div className="input-field col s12 m4">
                    <input type="date" className="datepicker" type="date" name="tour-Checkin" id="tour-Checkin"/>
                </div>
                <div className="input-field col s12 m4">
                    <input type="text" id='adults' name="tour-Checkin" />
                    <label for='adults' className='active'>Materialize Select</label>
                </div>
                <div className="input-field col s12 m4">
                    <input type="text" id='child'  name="tour-Checkin" />
                    <label for='child' className='active'>Materialize Select</label>
                </div>
            </div>
        );
    }
});

var Titulo=React.createClass({
    render:function(){
         return (
              <div className='col s12'>
                <div className='descriptionTour row'>
                    <div className='col s12 m8'>
                    <h5 className='infoSearch'>{"Tour-"+this.props.titulo.name}</h5>
                    <h6 className='infoSearch'>{this.props.destination.name}</h6>
                    <h6 className='infoSearch'>{"On "+this.props.fecha+", "+this.props.params.adults+" Adults, "+this.props.params.ninos+" Children"}</h6>
                    </div>
                    <div className='col s12 m4'>
                        <div className='textoTitulo'>{"Operated by: "+this.props.supplier}</div>
                    </div>
                </div>
              </div>
          );
    }
});

var Description=React.createClass({
    render:function(){

        return(
           <div className='col s12'>
               <p className='descriptionTextTour'>
                   {this.props.descripcion}
               </p>
           </div>
        );
    }
});

var Gallery=React.createClass({
    render:function(){
        var imagenes=function(img){
            return(
                <div className="item"><img className='responsive-img' src={"//apstatic.lomastravel.com.mx/800/"+img.file} alt={img.alt} /></div>
            );
        };
        return(
            <div className='col s12 descriptionTour' id='owl-demo'>
                {this.props.gallery.map(imagenes)}
            </div>
        );
    }
});

React.render(
    <Tour data={data} fecha={fecha}/>,
    document.getElementById('tourDetalle')
);