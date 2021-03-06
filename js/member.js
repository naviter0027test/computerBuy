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
            content.renderOrders();
        });

        model.on("change:orderDetail", function() {
            content.template = _.template($("#odrDetail").html());
            content.renderDetail();
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
        "detail/:no" : "detail",
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
        if(model.get("orderList") != null) {
            content.template = _.template($("#memOrders").html());
            content.renderOrders();
        }
    },
    detail : function(no) {
        model.getOrder(no);
        if(model.get("orderDetail") != null) {
            content.template = _.template($("#odrDetail").html());
            content.renderDetail();
        }
    },
    logout : function() {
        model.logout();
    },
    memHome : function() {
        content.template = _.template($("#memHome").html());
        content.render();
    }
});
