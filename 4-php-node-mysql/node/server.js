var http = require('http');
const port = process.env.NODE_PORT;

var server = http.createServer(function(req, res) {
    res.writeHead(200, {
        'Access-Control-Allow-Origin': '*',
        'Access-Control-Max-Age': 2592000, // 30 days
    });
    res.end('Salut tout le monde !');
});
server.listen(port);
