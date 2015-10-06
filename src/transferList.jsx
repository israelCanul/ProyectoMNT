var Transfers=React.createClass({
    getInitialState:function(){
      return {
        'destination':this.props.data.destination,
        'transfers'  :this.props.data.transfers,
        'params'     :this.props.data.params,
        'fecha'      :this.props.fecha
      };
    },
    render:function(){
        return(
            <div classname='row'>
                <Titulo params={this.state.params} fecha={this.state.fecha} destination={this.state.destination} />
                <ListTransfers transfers={this.state.transfers} params={this.state.params}/>
            </div>
        );
    }
});

var Transfer=React.createClass({
    render: function() {
        return (
            <div className={" card-panel hoverable row card-tours elementList list-item"}>
                <div className="col s12 m3 l2">
                    <img  src={"/images/transfers/"+this.props.data.type.img} className="responsive-img"/>
                </div>
                <div className="col s12 m5 l6">
                    <h5 className="tituloCard red-text left-align">{this.props.data.type.name}</h5>
                    <input type="hidden" name="idTour" value={this.props.data.type.id} />
                    <p>
                        {this.props.data.type.description}
                    </p>
                    <h6>{"From "+this.props.data.rate.min_cap+" to "+this.props.data.rate.max_cap+" Passenger(s)"}</h6>
                    <h6>Rate per vehicle</h6>
                </div>
                <div className="col s12 m4 l4 precioDetalle">
                    <div className="right-align col s10 from">
                        <small>From</small>
                    </div>
                    <div className="right-align col s10 price">
                        <span>$ {this.props.params.currency}</span><span className="price"> {this.props.data.rate.total}</span>
                    </div>
                    <div className="col s12 m8 offset-m2 l6 offset-l4">
                        <a href={"/transfers/agregar.html?jnfe="+this.props.data.rate.jnfe} className="col s12 btn red">
                            BOOK
                        </a>
                    </div>
                </div>
            </div>
        );
    }
});


var ListTransfers=React.createClass({
    render:function(){
        var parametros=this.props.params;

        var transfers=this.props.transfers.map(function(trans){
            return(
                <Transfer data={trans} params={parametros}/>
            );
        });

        if(this.props.transfers.length>0){
            return(
                <div className="commentList list box text-shadow">
                    {transfers}
                </div>
            );
        }else{
            return(
                <div className="commentList list box text-shadow">
                    <Nodatos />
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

var Titulo=React.createClass({
    render:function(){
        return(
            <div classname='col s12'>
                <h6 className='titulosColor'>{this.props.fecha}</h6>
                <h5 className='titulosColor'> {"Transfer "+this.props.destination.dest_ini.name+" to "+this.props.destination.dest_end.name}</h5>
                <h6 className='titulosColor'>{"Adults: "+this.props.params.adults+" - Children: "+this.props.params.ninos}</h6>
            </div>
        );
    }
});

React.render(
    <Transfers data={data} fecha={fecha}/>,
    document.getElementById('detalleTour')
);