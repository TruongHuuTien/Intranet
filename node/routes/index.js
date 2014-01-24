var app		= require('express')();
var fs		= require('fs');
var request = require('request');
var path	= require('path');
var colors	= require('colors');

var PHP_SERVER_URL	= 'http://192.168.0.118:8888';

var _dev			= true;

/* Log all input */
exports.log_input = function(req, res, next) {
	console.log('%s %s'.cyan, req.method, req.url);
	next();
};

/* Load file with file's caching from php server */
exports.loadFile = function(req, httpRes) {
	// Prepare request's path and file's path
	url = req.url;
	filePath = path.dirname(require.main.filename)+'/html'+url;
	if (pathParsed = url.match(/^\/(.*)(\.html)$/)) { // Convert .html -> .php
		requestPath = '/layout.php?content='+pathParsed[1];
	} else {
		requestPath = url;
	}
	// Prepare request's parameters if we have to send a request
	requestParam = {
		url			: PHP_SERVER_URL+requestPath,
		encoding	: null
	};
	
	// fs.exist check the existance of the requested file
	fs.exists(filePath, function(exists) {
		console.log(filePath, exists);
		if (_dev) { // server is on Developpement mode
			if (exists) {
				// Get file Information for cache date; stats.atime = file's Add Dates
				stats = fs.statSync(filePath);
				requestParam.headers = {
					'If-None-Match'		: '*',
					'If-Modified-Since'	: new Date(stats.atime).toUTCString()
				};
			}
			//Send a request with|out cache
			console.log(requestParam.url);
			request(requestParam, function(err, res, buffer) {
				if (err == null) {
					if (res.statusCode === 304) {
						httpRes.sendfile(filePath);
					} else if (res.statusCode === 200) {
						// Write file before sending
						fs.writeFile(filePath, buffer, function(err) { 
							httpRes.sendfile(filePath);
						});
					}
				} else {
					console.log('Error with path: '+requestParam.url);
				}
			});
		} else { // Server is on Production Mode
			if (!exists) { // We don't have this file, request it from php server
				request(requestParam, function(err, res, buffer) {
					if (err == null) {
						// Write file before sending
						fs.writeFile(filePath, buffer, function(err) {
							httpRes.sendfile(filePath);
						});
					} else {
						console.log('Error with path: '+requestParam.url);
					}
				});
			} else {
				httpRes.sendfile(filePath);
			}
		}
	});
};