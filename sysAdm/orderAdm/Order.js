OrderList = Backbone.View.extend({
    initialize : function() {
	var self = this;
	self.template = _.template(self.$el.find("script").html());
	this.model.on("change:data", function() {
	    self.render();
	});
    },
    template : null,
    render : function() {
	var data = this.model.get("data");
	console.log(data);
	this.$el.html(this.template(data));
    },
    showPage : function() {
	this.model.list();
    }
});

OrderModel = Backbone.Model.extend({
    initialize : function() {
    },
    defaults : {
	data : null
    },
    list : function() {
	var postData = {};
	var self = this;
	postData['instr'] = "orderList";
	//postData['nowPage'] = this.get("nowPage");
	//postData['interval'] = 10;
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
