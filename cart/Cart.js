Cart = Backbone.View.extend({
    initialize : function() {
	console.log(this.$el);
	this.template = _.template($("#prodCart").html());
	this.render();
    },
    el : '',
    template : null,
    render : function() {
	var temData = this.model.get('data');
	this.$el.html(this.template(temData));
    }
});

CartStore = Backbone.Model.extend({
    initialize : function() {
	var cart = [];
	if(localStorage.getItem('cart') != null)
	    cart = JSON.parse(localStorage.getItem('cart'));
	console.log(cart);
	var temData = {};
	temData['cart'] = cart;
	this.set('data', temData);
	//template = _.template($("#prodCart").html())
    },
    defaults : {
	data : null
    }
});
