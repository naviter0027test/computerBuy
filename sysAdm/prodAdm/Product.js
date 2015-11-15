Product = Backbone.View.extend({
    initialize : function() {
	var self = this;
	$("#uploadImg").submit(function() {
	    $(this).ajaxSubmit(function(data, status) {
		if(status == "success") {
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
    },
    el : "#prodAdd",
    events : {
	"click button" : "prodAdd"
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
    }
});

ProdModel = Backbone.Model.extend({
    initialize : function() {
    },
    defaults : {
	el : null,
	data : null,
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
