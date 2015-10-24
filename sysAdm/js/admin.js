
AdminRoutes = Backbone.Router.extend({
    initialize : function() {
	$("#left").load("left.html");
	$("#header").load("header.html");
    },
    routes : {
	'productList' : 'productList',
	'logout' : 'logout'
    },
    productList : function() {
	$("#right").load("prodAdm/prodList.html", function() {
	    var tem = _.template($("#right > script").html());
	    $("#right tbody").html(tem());
	    $("#left a").removeClass('clicked');
	    $("#left a[href=#productList]").addClass('clicked');
	});
    },
    logout : function() {
	var postData = {};
	postData['instr'] = "logout";
	$.post("instr.php", postData, function(data, status) {
	    if(status == "success") {
		data = JSON.parse(data);
		if(data['status'] == 200) {
		    alert("成功登出");
		    location.href = "login.html";
		}
	    }
	});
    }
});
