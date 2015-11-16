ClsList = Backbone.View.extend({
    initialize : function() {
	var self = this;
	this.model.clsAll();
	this.template = _.template($("#clsListTem").html());
	this.model.on("change:data", function() {
	    self.render();
	});
    },
    el : '',
    template : null,
    render : function() {
	var data = this.model.get("data");
	this.$el.html(this.template(data));
    }
});

ClsModel = Backbone.Model.extend({
    initialize : function() {
    },
    defaults : {
	data : null,
    },
    clsAll : function() {
	var self = this;
	var postData = {};
	postData['instr'] = "classList";
	$.post("instr.php", postData, function(data) {
	    data = JSON.parse(data);
	    self.set("data", data);
	});
    },
    clsAdd : function(form) {
	$(form).ajaxSubmit(function(data) {
	    console.log(data);
	});
    }
});
