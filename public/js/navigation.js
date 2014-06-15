var protocol = window.location.protocol;
var domain = window.location.host;
var path = window.location.pathname.split('/');

if (path[1] == "uld") {
    path = '/' + path[1] + '/' + path[2];
} else {
    path[1] = '/';
    path[2] = "";
}

var url = protocol + "//" + domain + path;
var prefix = "n a v space ";

addCheet('h o m e', "/home");
addCheet('i t e m', "/item/");
addCheet('a d d space i t e m', "/item/add");
addCheet('h u b s', "/hubs/mine");
addCheet('e x p l o r e space h u b s', "/hubs/explore");
addCheet('a d d space h u b s', "/hubs/add");
addCheet('l o g o u t', "/account/logout");
addCheet('l o g i n', "/account/login");
addCheet('l o g i n', "/account/signup");

function addCheet(code, path) {
    cheet(prefix + code, function() {
        window.location.href = url + path;
    });
}