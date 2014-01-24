var express		= require('express');
var app 		= express();
var http 		= require('http').createServer(app);
var io			= require('socket.io').listen(http, {'log level':1});
var request 	= require('request');
var colors		= require('colors');
var routes		= require('./routes');

http.listen('80');

/* userList */
var userList = [
	{ name : "Tien",	logged : false,	socketId : null },
	{ name : "Eric",	logged : false,	socketId : null },
	{ name : "Piero",	logged : false,	socketId : null },
	{ name : "Fabien",	logged : false,	socketId : null },
	{ name : "Yves",	logged : false,	socketId : null },
	{ name : "Kevin",	logged : false,	socketId : null },
	{ name : "Daniel",	logged : false,	socketId : null }
];

function findUserByName(name) {
	for (i=0; i<userList.length;i++) {
		if (userList[i].name === name) {
			return i;
		}
	}
}

/* Message */
var message = [];

/* intraProperty */
var intraProperty = {
	'Serveur 192.168.0.6'	: 'OK',
	'Console'				: 'Personne'
}

/* Routing */

/*
app.get('/', function(req, res) {
	res.sendfile(__dirname+'/index.html');
});
app.get('/ressources/:file', function(req, res) {
	res.sendfile(__dirname+'/ressources/'+req.params.file);
});
app.get('/template.html', function(req, res) {
	r = res;
	fs.exists(__dirname+'/template.html', function(exists){
		if (!exists) {
			request('http://192.168.0.130/selectic-webapp/index.php', function(err, res, body) {
				fs.writeFile(__dirname+'/template.html', body, function(err){
					r.sendfile(__dirname+'/template.html');
				});
			});
		} else {
			r.sendfile(__dirname+'/template.html',{ maxAge: 3600000 });
		}
	});
});
*/


app.use(routes.log_input);
app.use(routes.loadFile);


/* Socket */
io.sockets.on('connection', function(socket) {
	socket.emit('userList', userList);
	socket.emit('intraProperty', intraProperty);
	socket.on('intraProperty change', function(res) {
		intraProperty[res.name] = res.value;
		console.log(res.name.toString().magenta, res.value.toString().magenta);
		socket.broadcast.emit('intraProperty change', res);
	});
	socket.on('login', function(res) {
		index = findUserByName(res);
		userList[index].logged = true;
		userList[index].socketId = socket.id;
		console.log('login'.red, userList[index].name.cyan);
		socket.broadcast.emit('user login', userList[index].name);
		socket.emit('oldMessage', message);
	});
	socket.on('chat key', function(res) {
		io.sockets.emit('chat msg', res);
	});
	socket.on('chat notification', function(res) {
		console.log('notification'.red, res.username.cyan, res.msg.green);
		socket.broadcast.emit('chat notification', res);
		message.push(res);
	});
	socket.on('disconnect', function(res) {
		for (i=0; i<userList.length;i++) {
			if (userList[i].socketId === socket.id) {
				userList[i].socketId = null;
				userList[i].logged = false;
				socket.broadcast.emit('user logout', userList[i].name);
				console.log('logout'.red, userList[i].name.cyan);
			}
		}
	});
});