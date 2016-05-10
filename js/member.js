var sidebar = null;
var content = null;
var model = null;
$(document).ready(function() {
    $("#scriptLoad").load("template/member.html", function() {
        $("#header").load("template/header.html",function() { 
        $("#nav a[href='member.html']").addClass("choosed");
        });
        model = new MemberModel();
        sidebar = new MemberSideBar({'el' : "#leftMenu", 'model' : model});
        content = new MemberPanel({'el' : "#content", 'model' : model});
        model.isLogin();

        content.template = _.template($("#memHome").html());
        content.render();

        model.on("change:isLogin", function() {
            sidebar.render();
        });

        model.on("change:orderList", function() {
            content.template = _.template($("#memOrders").html());
            content.render();
        });

        new MemRout();
        Backbone.history.start();
        $("#footer").load("template/footer.html");
    });
});

MemRout = Backbone.Router.extend({
    routes : {
        "login" : "login",
        "register" : "register",
        "myData" : "editPage",
        "myOrders" : "myOrderList",
        "logout" : "logout",
        "memHome" : "memHome"
    },
    login : function() {
	var template = _.template($("#loginPageTem").html());
        $("#content").html(template());
    },
    register : function() {
	var template = _.template($("#registerPageTem").html());
        $("#content").html(template());
    },
    editPage : function() {
        console.log("myData");
    },
    myOrderList : function() {
        model.orders();
    },
    logout : function() {
        model.logout();
    },
    memHome : function() {
        content.template = _.template($("#memHome").html());
        content.render();
    }
});
