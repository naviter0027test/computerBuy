Cart = Backbone.View.extend({
    initialize : function() {
	console.log(this.$el);
	this.template = _.template($("#prodCart").html());
	this.render();
    },
    events : {
        "click a[name=delProd]" : "delProd"
    },
    el : '',
    template : null,
    render : function() {
	var temData = this.model.get('data');
	this.$el.html(this.template(temData));
    },
    isClear : function() {
        return this.model.isNull();
    },
    delProd : function(evt) {
        console.log(evt.target);
        var pos = $(evt.target).parent().attr("pos");
        console.log(pos);
        this.model.delProd(pos);
        this.render();
        if(this.isClear()) {
            alert("購物車沒東西");
            location.href = "index.html";
        }
        return false;
    }
});

CartStore = Backbone.Model.extend({
    initialize : function() {
	var cart = [];
        var tmp = localStorage.getItem('cart');
	if(tmp != null && tmp !== "") {
            console.log(tmp);
            cart = JSON.parse(tmp);
        }
	var temData = {};
	temData['cart'] = cart;
	this.set('data', temData);
	//template = _.template($("#prodCart").html())
    },
    defaults : {
	data : null
    },
    clear : function() {
	localStorage.setItem("cart", null);
    },
    delProd : function(pos) {
        var cart = JSON.parse(localStorage.getItem('cart'));
        cart.splice(pos, 1);
	var temData = {};
	temData['cart'] = cart;
	this.set('data', temData);
	localStorage.setItem("cart", JSON.stringify(cart));
    },
    isNull : function() {
        if(localStorage.getItem('cart') == null)
            return true;
        cart = localStorage.getItem('cart');
        console.log(cart);
        if(cart == {})
            return true;
        else if(cart == null)
            return true;
        cart = JSON.parse(cart);
        if(cart.length == 0)
            return true;
        else
            return false;
    }
});
