      var CommentBox = React.createClass({displayName: "CommentBox",
        render: function() {
          return (
            React.createElement("div", {className: "commentBox"}, 
              "Hello, world! I am a CommentBox."
            )
          );
        }
      });
      var CommentList = React.createClass({displayName: "CommentList",
        srender:function(){
          
        }
      });
      React.render(
        React.createElement(CommentBox, null),
        document.getElementById('content')
      );