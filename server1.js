var express = require("express");
var app = express();

app.get('/', function(req, res) {
  res.send("hello there ... ");
});

app.get('/today', function(req, res) {
  var today = new Date();
  res.send(today);
});

app.get('/greeting', function(req, res) {
  var greeting = "Welcome";
  res.send(greeting);
});

app.listen("81", function() {
  console.log('Server running');
});