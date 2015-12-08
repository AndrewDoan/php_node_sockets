// require express and path
var express = require("express");
var path = require("path");
// create the express app
var app = express();
app.set('port', (process.env.PORT || 5000));
var messages = [];

// tell the express app to listen on port 8000
var server = app.listen(app.get('port'), function() {
  console.log('Node app is running on port', app.get('port'));
});

var io=require("socket.io").listen(server);
io.sockets.on("connection", function(socket){
  socket.on("test", function(data){
    // setInterval(function(){ randomMessages(); }, 5000);
    randomMessages();
  })
});

function randomMessages(){
    var message = "Hello!";
    for(var i = 0; i < 1000; i++){
    io.emit("message", {message:message});
    }
}