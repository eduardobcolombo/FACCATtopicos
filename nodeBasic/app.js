var http = require('http');
var port = 8400;

//server
http.listen(port, function(err) {
  console.log('Server is running: ' + port);
});
