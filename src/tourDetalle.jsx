function nl2br (str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

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
                <Rates rates={this.state.rates} params={this.state.params}/>
                <Detalle descripcion={this.state.description} titulo={this.state.titulo} disponibilidad={this.state.availability}/>
            </div>
        );
    }
});
var Detalle=React.createClass({
    render:function(){
        var departure=nl2br(this.props.descripcion.departure);inclutions
        var inclutions=nl2br(this.props.descripcion.inclutions);
        var noinclutions=nl2br(this.props.descripcion.exclusiones);
        var recommendations=nl2br(this.props.descripcion.recomendations);
        var regulations=nl2br(this.props.descripcion.regulations);
        var policies=nl2br(this.props.descripcion.policies);
        console.log(departure);
        return(
            <div className='col s12 detalles descriptionTour'>
                <div className="col s12">
                    <h6>Duration:</h6>
                    <p>
                        {this.props.titulo.duracion}
                    </p>
                </div>
                <div className='col s12'>
                    <h6>Available on the following days</h6>
                    <div className='dayAvailable col s3 m2 l1'>
                        <h6>Monday</h6>
                        <img src={"/images/icon/"+this.props.disponibilidad.lunes} className='responsive-img'/>
                    </div>
                    <div className='dayAvailable col s3 m2 l1'>
                        <h6>Tuesday</h6>
                        <img src={"/images/icon/"+this.props.disponibilidad.martes} className='responsive-img'/>
                    </div>
                    <div className='dayAvailable col s3 m2 l1'>
                        <h6>Wednesday</h6>
                        <img src={"/images/icon/"+this.props.disponibilidad.miercoles} className='responsive-img'/>
                    </div>
                    <div className='dayAvailable col s3 m2 l1'>
                        <h6>Thursday</h6>
                        <img src={"/images/icon/"+this.props.disponibilidad.jueves} className='responsive-img'/>
                    </div>
                    <div className='dayAvailable col s3 m2 l1'>
                        <h6>Friday</h6>
                        <img src={"/images/icon/"+this.props.disponibilidad.viernes} className='responsive-img'/>
                    </div>
                    <div className='dayAvailable col s3 m2 l1'>
                        <h6>Saturday</h6>
                        <img src={"/images/icon/"+this.props.disponibilidad.sabado} className='responsive-img'/>
                    </div>
                    <div className='dayAvailable col s3 m2 l1'>
                        <h6>Sunday</h6>
                        <img src={"/images/icon/"+this.props.disponibilidad.domingo} className='responsive-img'/>
                    </div>
                </div>
                <div className="col s12">
                    <h6>Departure</h6>
                    <p dangerouslySetInnerHTML={{__html: departure}}>
                    </p>
                </div>
                <div className="col s12">
                    <h6>Included</h6>
                    <p dangerouslySetInnerHTML={{__html: inclutions}}>
                    </p>
                </div>
                <div className="col s12">
                    <h6>Not Included</h6>
                    <p dangerouslySetInnerHTML={{__html: noinclutions}}>
                    </p>
                </div>
                <div className="col s12">
                    <h6>Recommendations</h6>
                    <p dangerouslySetInnerHTML={{__html: recommendations}}>
                    </p>
                </div>
                <div className="col s12">
                    <h6>Regulations</h6>
                    <p dangerouslySetInnerHTML={{__html: regulations}}>
                    </p>
                </div>
                <div className="col s12">
                    <h6>Cancellation Policies</h6>
                    <p dangerouslySetInnerHTML={{__html: policies}}>
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
        var tarifaAdulto= function (rate) {
            if(params.adults>0){
                return(
                    <div className='col 12'>
                        {"Adults: "+params.currency+" "+rate.tarifaAdult}
                    </div>
                );
            }
        }
        var tarifaNino= function (rate) {
            if(params.ninos>0){
                return(
                    <div className='col 12'>
                        {"Children: "+params.currency+" "+rate.tarifaNino}
                    </div>
                );
            }
        }
        var botonBook= function(rate){
            if(rate.tarifaDisponible==1){
                return(
                    <input  name='jnfe' value={rate.jnfe} type='hidden' />
                );
            }
        }
        var precio=function(rate){
            if(rate.tarifaDisponible==1){
                return(
                    <center>{params.currency+" $"+rate.tarifaTotal+" "}</center>
                );
            }else{
                return(
                    <center className='black-text' dangerouslySetInnerHTML={{__html: rate.tarifaTotal}}></center>
                );
            }
        }
        return(
            <div className='col s12 rate'>
                <form method="Post" action='/tour/agregar.html'>
                <h6 className='red-text'>{rate.tarifaNombre}</h6>
                <div className='col s12 m6 l8 rateLeft'>
                    {tarifaNino(rate)}
                    {tarifaAdulto(rate)}
                </div>
                <div className='col s12 m6 l4'>
                    <div className='row'>
                        <div className='col s12 m6 rateRight'>
                            {precio(rate)}
                        </div>
                        <div className='col s12 m6 rateRight'>
                            <input type='submit' value='Book' className='btn btn-large col s12 red'/>
                            {botonBook(rate)}
                        </div>
                    </div>
                </div>
                </form>
            </div>
        );
    }
        return(
            <div className='descriptionTour col s12 wrap-rate'>
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
                   {this.props.descripcion.description}
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