OrderDetail = Backbone.View.extend({
    initialize : function() {
	var self = this;
	this.template = _.template($("#orderDetailTem").html());
	this.model.on("change:order", function() {
	    var order = this.get("order");
	    var detail = this.get("detail");
	    detail['detail'] = order;
	    self.render(detail);
	});
    },
    template : null,
    showOrder : function(detail) {
	this.model.set("detail", detail);
	this.model.set("orderId", detail['o_id']);
	this.model.oneOrder();
    },
    render : function(detail) {
	this.$el.html(this.template(detail));
    }
});

OrderList = Backbone.View.extend({
    initialize : function() {
	var self = this;
	self.template = _.template(self.$el.find("script").html());
	this.model.on("change:data", function() {
	    self.render();
	});
    },
    events : {
        "change table select[name=active]" : "changeAct",
	"click table a[name=detailShow]" : "detailShow",
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
    changeAct : function(evt) {
        var active = $(evt.target).val();
	var pos = $(evt.target).attr("pos");
	var data = this.model.get('data')['orders'];
        var postData = {};
        postData['instr'] = "orderActive";
        postData['o_id'] = data[pos]['o_id'];
        postData['active'] = active;
        $.post("instr.php", postData, function(data) {
            data = JSON.parse(data);
            if(data['status'] == 200) {
                alert("修改成功");
            }
            else
                console.log(data);
        });
    },
    detailShow : function(evt) {
	var pos = $(evt.target).attr("pos");
	console.log(pos);
	var data = this.model.get('data')['orders'];
	console.log(data[pos]);
	window.sessionStorage.setItem("orderDetail", JSON.stringify(data[pos]));
        location.href = $(evt.target).attr("href");
    },
    showPage : function() {
	this.model.list();
    }
});

OrderModel = Backbone.Model.extend({
    initialize : function() {
    },

    defaults : {
	detail : null,
	orderId : null,
	order : null,
	nowPage : 0,
	itemShowAmount : 10,
	data : null
    },

    oneOrder : function() {
	var postData = {};
	var self = this;
	postData['instr'] = "oneOrder";
	postData['o_id'] = this.get("orderId");
	$.post("instr.php", postData, function(data, status) {
	    if(status == "success") {
		console.log(data);
		data = JSON.parse(data);
		console.log(data);
		self.set("order", data);
	    }
	});
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
