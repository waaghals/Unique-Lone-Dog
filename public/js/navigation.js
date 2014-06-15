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

addCheet('h', "/home");
addCheet('i', "/item/");
addCheet('a d d space i', "/item/add");
addCheet('h', "/hubs/mine");
addCheet('e x p l o r e space h', "/hubs/explore");
addCheet('a d d space h', "/hubs/add");
addCheet('l o g o', "/account/logout");
addCheet('l o g i', "/account/login");
addCheet('s', "/account/signup");

function addCheet(code, path) {
    cheet(prefix + code, function() {
        window.location.href = url + path;
    });
}