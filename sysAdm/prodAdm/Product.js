ProdEditPage = Backbone.View.extend({
    initialize : function() {
	var self = this;
	this.template = _.template($("#prodEditTem").html());

	//取得商品所有分類
	this.model.prodCls();

	this.model.on("change:prod", function() {
	    self.render();

	    //上傳圖片用ajax submit
	    $("#uploadImg").submit(function() {
		$(this).ajaxSubmit(function(data, status) {
		    if(status == "success") {
			console.log(data);
			data = JSON.parse(data);
			console.log(data);
			if(data['status'] == 200) {
			    var imgName = data['info'][0]['name'];
			    self.$el.find('input[readonly]').val(imgName);
			}
		    }
		});
		return false;
	    });
	});

    },
    events : {
	"submit #editForm" : "prodModify"
    },
    el : null,
    template : null,
    render : function() {
	data = this.model.get("prod");
	clsList = this.model.get("clsList");
	data['clsList'] = clsList;
	this.$el.html(this.template(data));
    },
    showPage : function(prodId) {
	console.log(prodId);
	this.model.getProd(prodId);
    },
    prodModify : function(evt) {
	var form = evt.target;
	console.log(form);
	$(form).ajaxSubmit(function(data, status) {
	    if(status == "success") {
		console.log(data);
		data = JSON.parse(data);
		console.log(data);
	    }
	});
	return false;
    }
});

Product = Backbone.View.extend({
    initialize : function() {
	var self = this;
	this.template = _.template($("#clsTem").html());

	//上傳圖片用ajax submit
	$("#uploadImg").submit(function() {
	    $(this).ajaxSubmit(function(data, status) {
		if(status == "success") {
		    console.log(data);
		    data = JSON.parse(data);
		    console.log(data);
		    if(data['status'] == 200) {
			var imgName = data['info'][0]['name'];
			self.$el.find('input[readonly]').val(imgName);
		    }
		}
	    });
	    return false;
	});

	this.model.on("change:clsList", function() {
	    self.render();
	});

	//取得商品所有分類
	this.model.prodCls();
    },
    el : "#prodAdd",
    events : {
	"click button" : "prodAdd"
    },
    template : null,
    render : function() {
	var clsList = this.model.get("clsList");
	console.log(clsList);
	$("select[name=p_cls]").html(this.template(clsList));
    },
    prodAdd : function(evt) {
	this.model.set("el", this.$el);
	this.model.prodAdd();
	return false;
    }
});

ProductList = Backbone.View.extend({
    initialize : function() {
	var self = this;
	self.template = _.template(self.$el.find("script").html());
	this.model.on("change:data", function() {
	    self.render();
	});
    },
    events : {
	"click a" : "prodOper"
    },
    el : '',
    template : null,
    render : function() {
	var data = this.model.get("data");
	var self = this;
	data['nowPage'] = this.model.get("nowPage");
	this.$el.html(this.template(data));
	$(".pager a").on("click", function() {
	    var page = $(this).text();
	    self.model.set("nowPage", page);
	    self.model.prodList();
	    return false;
	});
    },
    prodList : function(evt) {
	this.model.prodList();
    },
    prodOper : function(evt) {
	var btn = evt.target;
	var oper = $(btn).attr("oper");
	var pos = $(btn).attr("pos");
	var data = this.model.get('data')['data'];
	//console.log(data[pos]);
	var postData = {};
	postData['instr'] = "delProduct";
	postData['p_id'] = data[pos]['p_id'];
	if(oper == "del")
	    if(confirm("是否刪除?"))
		$.post('instr.php', postData, function(data) {
		    data = JSON.parse(data);
		    console.log(data);
		    if(data['status'] == 200) {
			location.reload();
		    }
		});
	    else ;
	else if(oper == "modify") {
	    location.href = "#productMod/" + postData['p_id'];
	}
	return false;
    }
});

ProdModel = Backbone.Model.extend({
    initialize : function() {
    },
    defaults : {
	el : null,
	prod : null, //編輯單一商品的資料存放
	data : null,
	clsList : null,
	nowPage : 1
    },
    prodAdd : function() {
	var el = this.get("el");
	el.ajaxSubmit(function(data, status) {
	    if(status == "success") {
		console.log(data);
		data = JSON.parse(data);
		console.log(data);
	    }
	});
    },

    getProd : function(prodId) {
	var self = this;
	var postData = {};
	postData['instr'] = "oneProd";
	postData['p_id'] = prodId;
	$.post("instr.php", postData, function(data, status) {
	    if(status == "success") {
		console.log(data);
		data = JSON.parse(data);
		console.log(data);
		self.set("prod", data);
	    }
	});
    },

    prodCls : function() {
	var self = this;
	var postData = {};
	postData['instr'] = "classList";
	$.post("instr.php", postData, function(data, status) {
	    if(status == "success") {
		console.log(data);
		data = JSON.parse(data);
		console.log(data);
		self.set("clsList", data);
	    }
	});
    },

    prodList : function() {
	var postData = {};
	var self = this;
	postData['instr'] = "prodList";
	postData['nowPage'] = this.get("nowPage");
	postData['interval'] = 10;
	console.log(postData);
	$.post("instr.php", postData, function(data, status) {
	    if(status == "success") {
		console.log(data);
		data = JSON.parse(data);
		console.log(data);
		self.set("data", data);
	    }
	});
    }
});
