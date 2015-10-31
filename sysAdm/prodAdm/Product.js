Product = Backbone.View.extend({
    initialize : function() {
	self = this;
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
	this.model.on("change:data", function() {
	    self.template = _.template(self.$el.find("script").html());
	    self.render();
	});
    },
    el : '',
    template : null,
    render : function() {
	var tbody = this.$el.find("tbody");
	var data = this.model.get("data");
	$(tbody).html(this.template(data));
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
	data : null
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
	self = this;
	postData['instr'] = "prodList";
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
