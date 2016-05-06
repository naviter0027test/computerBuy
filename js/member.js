var sidebar = null;
var content = null;
$(document).ready(function() {
    $("#scriptLoad").load("template/member.html", function() {
        $("#header").load("template/header.html",function() { });
        sidebar = new MemberSideBar({'el' : "#leftMenu"})
        sidebar.render();
        new MemRout();
        Backbone.history.start();
        $("#footer").load("template/footer.html");
    });
});

MemRout = Backbone.Router.extend({
    routes : {
        "login" : "login",
        "register" : "register",
        "logout" : "logout"
    },
    login : function() {
	var template = _.template($("#loginPageTem").html());
        $("#content").html(template());
    },
    register : function() {
	var template = _.template($("#registerPageTem").html());
        $("#content").html(template());
    },
    logout : function() {
        console.log("logout");
    },
});
