OrderList = Backbone.View.extend({
    initialize : function() {
	var self = this;
	self.template = _.template(self.$el.find("script").html());
	this.model.on("change:data", function() {
	    self.render();
	});
    },
    events : {
	"click .pager a" : "changePage"
    },
    template : null,
    render : function() {
	var data = this.model.get("data");
	var itemShowAmount = this.model.get("itemShowAmount");
	data['pageSum'] = Math.ceil(data['orderAmount'] / itemShowAmount);
	data['nowPage'] = this.model.get("nowPage");
	console.log(data);
	this.$el.html(this.template(data));
    },
    changePage : function(evt) {
	var page = evt.target;
	console.log(page);
	this.model.set("nowPage", $(page).text()-1);
	this.showPage();
	return false;
    },
    showPage : function() {
	this.model.list();
    }
});

OrderModel = Backbone.Model.extend({
    initialize : function() {
    },
    defaults : {
	nowPage : 0,
	itemShowAmount : 10,
	data : null
    },
    list : function() {
	var postData = {};
	var self = this;
	postData['instr'] = "orderList";
	postData['nowPage'] = this.get("nowPage");
	postData['itemShowAmount'] = this.get("itemShowAmount");
	//console.log(postData);
	$.post("instr.php", postData, function(data, status) {
	    if(status == "success") {
		console.log(data);
		data = JSON.parse(data);
		self.set("data", data);
	    }
	});
    }
});
