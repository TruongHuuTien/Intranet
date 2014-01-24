var app		= require('express')();
var http 	= require('http').createServer(app);
var colors	= require('colors');
var routes	= require('./routes');

http.listen('80');

/*	Routes	*/
app.use(routes.log_input);
app.use(routes.loadFile);