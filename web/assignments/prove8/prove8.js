var http = require('http');
http.createServer(function onRequest(req, res) {
    console.log("Hello world");
}).listen(8888);
