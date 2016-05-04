prodList = null;
memList = null;
memPage = null;

AdminRoutes = Backbone.Router.extend({
    initialize : function() {
	$("#left").load("left.html");
	$("#header").load("header.html");
    },
    routes : {
	'passAdm' : 'passAdm',
        'memList/:nowPage' : 'memList',
        'memEdit/:m_id' : 'memEdit',
	'productList' : 'productList',
	'productAdd' : 'productAdd',
	'productCls' : 'productCls',
	'prodClsAdd' : 'prodClsAdd',
	'productMod/:prodId' : 'productMod',
	'orderList' : 'orderList',
	'orderDetail' : 'orderDetail',
        'payModeList' : 'payModeList',
        'payModeEdit/:pos' : 'payModeEdit',
	'logout' : 'logout',
        '' : 'isLogin'
    },

    isLogin : function() {
        var postData = {};
        postData['instr'] = "isLogin";
        $.post("instr.php", postData, function(data) {
            //console.log(data);
            data = JSON.parse(data);
            if(data['status'] == 500) {
                alert("尚未登入");
                location.href = "login.html";
            }
        });
    },

    passAdm : function() {
	$("#right").load("login/passAdm.html", function() {
	    $("#left a").removeClass('clicked');
	    $("#left a[href=#passAdm]").addClass('clicked');
	});
    },

    memList : function(nowPage) {
	$("#right").load("memAdm/memList.html", function() {
	    $.getScript("memAdm/Member.js", function() {
                if(memList == null)
                    memList = new MemberList({'model' : new MemberModel(), 'el' : "#right"});
                memList.model.list(nowPage);
            });
	    $("#left a").removeClass('clicked');
	    $("#left a[href=#memList]").addClass('clicked');
        });
    },

    memEdit : function(m_id) {
	$("#right").load("memAdm/memEdit.html", function() {
	    $.getScript("memAdm/Member.js", function() {
                if(memPage == null)
                    memPage = new MemberPage({'model' : new MemberModel(), 'el' : "#right"});
                memPage.model.getOne(m_id);
            });
	    $("#left a").removeClass('clicked');
	    $("#left a[href=#memList]").addClass('clicked');
        });
    },

    productList : function() {
	$("#right").load("prodAdm/prodList.html", function() {
	    //var tem = _.template($("#right > script").html());
	    //$("#right tbody").html(tem());
	    $.getScript("prodAdm/Product.js", function() {
                if(prodList == null)
                    prodList = new ProductList({'model' : new ProdModel(), 'el' : "#right"});
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
    productMod : function(prodId) {
	$("#right").load("prodAdm/prodEdit.html", function() {
	    $.getScript("prodAdm/Product.js", function() {
		var prodEdit = new ProdEditPage({'el' : '#right', 'model' : new ProdModel()});
		prodEdit.showPage(prodId);
	    });
	});
    },
    orderList : function() {
	$("#right").load("orderAdm/orderList.html", function() {
	    $.getScript("orderAdm/Order.js", function() {
		var orderList = new OrderList({'el' : "#right", 'model' : new OrderModel()});
		orderList.showPage();
	    });
	    $("#left a").removeClass('clicked');
	    $("#left a[href=#orderList]").addClass('clicked');
	});
    },
    orderDetail : function() {
	$("#right").load("orderAdm/orderDetail.html", function() {
	    $.getScript("orderAdm/Order.js", function() {
		var detail = window.sessionStorage.getItem("orderDetail");
		detail = JSON.parse(detail);
		//console.log(detail);
		var orderShow = new OrderDetail({'el' : '#orderDetail', 'model' : new OrderModel()})
		orderShow.showOrder(detail);
		$("#left a").removeClass('clicked');
	    });
	});
    },
    payModeList : function() {
        $("#right").load("payModeAdm/payModeList.html", function() {
            $.getScript("payModeAdm/PayMode.js", function() {
                var payMode = new PayModeList({'el' : '#paymodeList', 'model' : new PayModeModel()});
            });
            $("#left a").removeClass('clicked');
	    $("#left a[href=#payModeList]").addClass('clicked');
        });
    },
    payModeEdit : function(pos) {
        //console.log("pay mode edit");
        $("#right").load("payModeAdm/payModeEdit.html", function() {
            $.getScript("payModeAdm/PayMode.js", function() {
                var payEdit = new PayModeEdit({'el' : "#paymodePage", 'model' : new PayModeModel()});
            });
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
