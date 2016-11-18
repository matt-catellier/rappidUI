
var express = require('express');
var path = require('path');
var cors = require('cors');
var bodyParser = require('body-parser');
// var mattsProcedure = require('./data');
var app = express();

app.use(express.static(path.join(__dirname)));

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false}));

app.use(cors());

app.use(function(req,res,next){
	console.log(req.method + ' request for ' + req.url);
    console.log(JSON.stringify(req.body));
	next();
});

app.get('/', function(req, res) {
	 res.sendFile(path.join(__dirname + '/index.html'));
});
app.get('/api/data', function(req, res) {
	// res.json(mattsProcedure);
});
app.post('/api/data', function(req, res, next){
	console.log(req.body);
	res.redirect('/');
});

app.listen(3000);
console.log('app running on port 3000');


module.exports = app;
