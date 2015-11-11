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
	"click a.seeProd" : "seeProd"
    },

    el : '',
    template : null,

    showPage : function() {
	var initData = {};
	initData['nowPage'] = this.model.get('nowPage');
	this.model.prodList(initData);
	this.template = _.template($("#prodListTem").html());
    },

    addCart : function(evt) {
	var cart = [];
	if(localStorage.getItem('cart') != null)
	    cart = JSON.parse(localStorage.getItem('cart'));
	if(cart == null)
	    cart = [];
	console.log(cart);

	var btn = evt.target;
	var item = $(btn).attr("item");
	var data = this.model.get('data');
	console.log(data['data'][item]);

	var select = $(btn).parent().find('select');
	var buyAmount = $(select).val();
	if(isNaN(buyAmount)) {
	    alert(buyAmount);
	    return false;
	}

	var product = {};
	product['amount'] = buyAmount;
	product['p_id'] = data['data'][item]['p_id'];
	product['p_name'] = data['data'][item]['p_name'];
	product['p_price'] = data['data'][item]['p_price'];
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
	return false;
    },

    seeProd : function() {
	console.log('seeProd');
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
	pageSum : 0,
	nowPage : 1
    },
    prodList : function(initData) {
	var nowPage = initData['nowPage'];
	var postData = {};
	postData['instr'] = "maxPage";
	postData['interval'] = 9;

	var self = this;
	$.post("instr.php", postData, function(data) {
	    data = JSON.parse(data);
	    console.log(data);
	    self.set('pageSum', data['pageSum']);
	});

	postData['instr'] = "prodList";
	postData['nowPage'] = nowPage;

	$.post("instr.php", postData, function(data) {
	    data = JSON.parse(data);
	    self.set('data', data);
	});

    }
});
