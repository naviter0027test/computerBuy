ProductInfo = Backbone.View.extend({
    initialize : function() {
	this.template = _.template($("#prodPageTem").html());
    },
    el : '',
    template : null,
    showProd : function(item) {
	console.log("showProd");
	var data = this.model.get('data');
	console.log(data['data'][item]);
        data['data'][item]['item'] = item;
	this.$el.html(this.template(data['data'][item]));
    }
});

ProductList = Backbone.View.extend({
    initialize : function() {
	var self = this;
	this.model.on("change:data", function() {
	    var data = this.get('data');
	    var pageSum = this.get('pageSum');
	    var nowPage = this.get('nowPage');
	    console.log(data);
	    data['pageSum'] = pageSum;
	    data['nowPage'] = nowPage;
	    self.render(data);
	});

	this.showPage();
    },
    events : {
	'click a.addCart' : 'addCart',
	'click .prodInfo' : 'infoShow',
	"click a.seeProd" : "seeProd"
    },

    el : '',
    template : null,

    showPage : function() {
	var initData = {};
	initData['nowPage'] = this.model.get('nowPage');
        if(this.model.get("cls") != null)
            initData['cls'] = this.model.get("cls");
        console.log(initData);
	this.model.prodList(initData);
	this.template = _.template($("#prodListTem").html());
    },

    showPageByCls : function(cls) {
	var initData = {};
	initData['nowPage'] = 1;
	initData['cls'] = cls;
	this.model.prodList(initData);
	this.template = _.template($("#prodListTem").html());
    },

    infoShow : function(evt) {
        console.log(evt.target);
	var prodInfo = new ProductInfo({'model' : this.model, 'el' : "#content"});
	var btn = evt.target;
	var item = $(btn).attr("item");
	prodInfo.showProd(item);
        return false;
    },

    addCart : function(evt) {
	var cart = [];
        var tmp = localStorage.getItem('cart');
	if(tmp != null && tmp !== "") 
	    cart = JSON.parse(localStorage.getItem('cart'));
	if(cart == null)
	    cart = [];
	console.log(cart);

	var btn = evt.target;
        console.log(btn);
	var item = $(btn).attr("item");
	var data = this.model.get('data');
	console.log(data['data'][item]);

	var select = this.$el.find('select');
	var buyAmount = $(select).val();
	if(isNaN(buyAmount)) {
            buyAmount = 1;
	}

	var product = {};
	product['amount'] = buyAmount;
	product['p_id'] = data['data'][item]['p_id'];
	product['p_name'] = data['data'][item]['p_name'];
	product['p_price'] = data['data'][item]['p_price'];
	product['p_qty'] = buyAmount;
	product['p_cls'] = "主機板";
	product['subTotal'] = data['data'][item]['p_price'] * buyAmount;

	var isInCart = false;
	for(var i in cart) 
	    if(cart[i]['p_id'] == product['p_id']) {
		cart[i] = product;
		isInCart = true;
	    }
	if(!isInCart)
	    cart.push(product);
	localStorage.setItem('cart', JSON.stringify(cart));
	alert("購物車操作成功");
	return false;
    },

    seeProd : function(evt) {
	var prodInfo = new ProductInfo({'model' : this.model, 'el' : "#content"});
	var btn = evt.target;
	var item = $(btn).attr("item");
	prodInfo.showProd(item);
	return false;
    },

    render : function(data) {
	this.$el.html('');
	this.$el.html(this.template(data));
	var self = this;
	$(".pager a").on("click", function() {
	    self.model.set("nowPage", $(this).text());
	    self.showPage();
	});
    }
});

ProdModel = Backbone.Model.extend({
    initialize : function() {
    },
    defaults : {
	data : null,
	cls : null,
	pageSum : 0,
	nowPage : 1
    },
    prodList : function(initData) {
	var nowPage = initData['nowPage'];
	var postData = {};
	postData['instr'] = "maxPage";
	postData['interval'] = 9;
	if(initData['cls'])
	    postData['cls'] = initData['cls'];

	var self = this;
	$.post("instr.php", postData, function(data) {
	    data = JSON.parse(data);
	    console.log(data);
	    self.set('pageSum', data['pageSum']);
	});

	postData['instr'] = "prodList";
	postData['nowPage'] = nowPage;
	if(initData['cls'])
	    postData['cls'] = initData['cls'];

	$.post("instr.php", postData, function(data) {
	    data = JSON.parse(data);
	    self.set('data', data);
	});

        //設定現在所在頁面
        this.set("nowPage", nowPage);
        this.set("cls", initData['cls']);
    }
});
