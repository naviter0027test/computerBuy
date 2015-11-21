
AdminRoutes = Backbone.Router.extend({
    initialize : function() {
	$("#left").load("left.html");
	$("#header").load("header.html");
    },
    routes : {
	'passAdm' : 'passAdm',
	'productList' : 'productList',
	'productAdd' : 'productAdd',
	'productCls' : 'productCls',
	'prodClsAdd' : 'prodClsAdd',
	'productMod' : 'productMod',
	'logout' : 'logout'
    },
    passAdm : function() {
	$("#right").load("login/passAdm.html", function() {
	    $("#left a").removeClass('clicked');
	    $("#left a[href=#passAdm]").addClass('clicked');
	});
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
		var addForm = new Product({'model' : new ProdModel()});
	    });
	    $("#left a").removeClass('clicked');
	    $("#left a[href=#productAdd]").addClass('clicked');
	});
    },
    productCls : function() {
	$("#right").load("prodAdm/classList.html", function() {
	    $.getScript("prodAdm/Clsfication.js", function() {
		var clsObj = new ClsList({'el' : "#clsShow", 'model' : new ClsModel()});
	    });
	    $("#left a").removeClass('clicked');
	    $("#left a[href=#productCls]").addClass('clicked');
	});
    },
    prodClsAdd : function() {
	$("#right").load("prodAdm/clsAdd.html", function() {
	    $.getScript("prodAdm/Clsfication.js", function() {
		var clsMdl = new ClsModel();
		$("#clsAdd").submit(function() {
		    clsMdl.clsAdd();
		    return false;
		});
	    });
	    $("#left a").removeClass('clicked');
	    $("#left a[href=#prodClsAdd]").addClass('clicked');
	});
    },
    productMod : function() {
	$("#right").load("prodAdm/prodEdit.html", function() {
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
