var Tour=React.createClass({
    getInitialState:function(){
        return{
            titulo:this.props.data.tour,
            tarifas:this.props.data.tarifas,
            availability:this.props.data.availability,
            coordinates:this.props.data.coordinates,
            destination:this.props.data.destination,
            gallery:this.props.data.gallery,
            description:this.props.data.description,
            params:this.props.data.params
        };
    },
    render:function(){
        return(
            <div className='col s12'>
                <Titulo params={this.state.params} titulo={this.state.titulo} description={this.state.description} destination={this.state.destination}/>
            </div>
        );
    }
});

var Titulo=React.createClass({

    render:function(){

        return(
        var fecha=function () {
            //var dataDate=this.props.params.date.split("-");
            //console.log('dataDate');
            /* var date = new Date(Date.UTC(dataDate[0],dataDate[1],dataDate[2], 14, 0, 0));
             var options = {
             weekday: "long", year: "numeric", month: "short",
             day: "numeric", hour: "2-digit", minute: "2-digit"
             };*/
            //console.log(date);
            //return date.toLocaleTimeString("en-us", options);
            return "hola";
        }
          return  <div className='col s12'>
                <h5 className='infoSearch'>{"Tour-"+this.props.titulo.name}</h5>
                <h6 className='infoSearch'>{this.props.destination.name}</h6>
                <h6 className='infoSearch'>{this.fecha}</h6>
            </div>;
        );
    }
});
React.render(
    <Tour data={data}/>,
    document.getElementById('tourDetalle')
);