var sidebar = null;
var content = null;
$(document).ready(function() {
    $("#scriptLoad").load("template/member.html", function() {
        $("#header").load("template/header.html",function() { });
        new MemRout();
        Backbone.history.start();
        $("#footer").load("template/footer.html");
    });
});

MemRout = Backbone.Router.extend({
    routes : {
        "login" : "login",
        "logout" : "logout"
    },
    login : function() {
        console.log("login");
    },
    logout : function() {
        console.log("logout");
    },
});
