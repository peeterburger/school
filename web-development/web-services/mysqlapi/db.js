'user strict';

var mysql = require('mysql');

//local mysql db connection
var connection = mysql.createConnection({
  host: '10.10.30.9',
  user: 'stburpet',
  password: 'mysql#5BT',
  database: 'stburpet'
});

connection.connect(function(err) {
  if (err) throw err;
});

module.exports = connection;
