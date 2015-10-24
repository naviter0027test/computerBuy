
AdminRoutes = Backbone.Router.extend({
    initialize : function() {
	$("#left").load("left.html");
	$("#header").load("header.html");
    },
    routes : {
	'productList' : 'productList',
	'productAdd' : 'productAdd',
	'logout' : 'logout'
    },
    productList : function() {
	$("#right").load("prodAdm/prodList.html", function() {
	    //var tem = _.template($("#right > script").html());
	    //$("#right tbody").html(tem());
	    $.getScript("prodAdm/Product.js", function() {
		var prodList = new ProductList({'model' : new ProdModel(), 'el' : "#right"});
		prodList.prodList();
	    });
	    $("#left a").removeClass('clicked');
	    $("#left a[href=#productList]").addClass('clicked');
	});
    },
    productAdd : function() {
	$("#right").load("prodAdm/prodAdd.html", function() {
	    $.getScript("prodAdm/Product.js", function() {
		console.log("get product js success");
		var addForm = new Product({'model' : new ProdModel()});
	    });
	    $("#left a").removeClass('clicked');
	    $("#left a[href=#productAdd]").addClass('clicked');
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
