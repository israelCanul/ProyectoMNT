
      var CommentBox = React.createClass({displayName: "CommentBox",
        loadCommentsFromServer:function(){
          $.ajax({
            url: this.props.url,
            dataType: 'json',
            cache: false,
            success: function(data) {
              this.setState({data: data});
            }.bind(this),
            error: function(xhr, status, err) {
              console.error(this.props.url, status, err.toString());
            }.bind(this)
          });
        },
        getInitialState:function(){
          return{data:[]};
        },
        handleCommentSubmit:function(){

        },
        componentDidMount: function() {
          this.loadCommentsFromServer();
          setInterval(this.loadCommentsFromServer, this.props.pollInterval);
        },        
        render: function() {
          return (
            React.createElement("div", {className: "commentBox"}, 
              React.createElement("h1", null, "Comments"), 
              React.createElement(CommentList, {data: this.state.data}), 
              React.createElement(CommentForm, {onCommentSubmit: this.handleCommentSubmit})
            )
          );
        }
      });
      var CommentList = React.createClass({displayName: "CommentList",
        render:function(){
          var commentNodes=this.props.data.map(function(comment){
            return(
                React.createElement(Comment, {author: comment.author}, 
                  comment.text
                )  
              );
          });
          return(
            React.createElement("div", {className: "commentList"}, 
              commentNodes
            )
            );
        }
      });
      var CommentForm = React.createClass({displayName: "CommentForm",
        handleSubmit:function(e){
          e.preventDefault();
          var author=React.findDOMNode(this.refs.author).value.trim();
          var text= React.findDOMNode(this.refs.text).value.trim();
          if(!text || !author){
            return;
          }
          React.findDOMNode(this.refs.author).value = '';
          React.findDOMNode(this.refs.text).value = '';
          return;

        }, 
        render:function(){
            return(
              React.createElement("form", {className: "commentForm", onSubmit: this.handleSubmit}, 
                React.createElement("input", {type: "text", placeholder: "Your Name", ref: "author"}), 
                React.createElement("input", {type: "text", placeholder: "Say something...", ref: "text"}), 
                React.createElement("input", {type: "submit", value: "Post"})
              )
            );    
        }
      });
      var Comment= React.createClass({displayName: "Comment",

        render:function(){
            var texto= this.props.children.toString();
           var rawMarkup = marked(texto, {sanitize: true});
           return(
              React.createElement("div", {className: "comment"}, 
                React.createElement("h2", {className: "commentAuthor"}, 
                  this.props.author
                ), 
                React.createElement("span", {dangerouslySetInnerHTML: {__html: rawMarkup}})
              )  
            );
        }
      });
      React.render(
        React.createElement(CommentBox, {url: "comments.json", pollInterval: 2000}),
        document.getElementById('content')
      );