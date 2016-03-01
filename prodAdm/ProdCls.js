ClsTop = Backbone.View.extend({
    initialize : function() {
	var self = this;
	this.template = _.template($("#topMenuTem").html());
	this.model.on("change:data", function() {
	    self.render();
	});
    },
    events : {
	"click a" : 'changeCls'
    },
    template : null,
    render : function() {
	console.log("render");
	var data = this.model.get("data");
	this.$el.html(this.template(data));
    },
    changeCls : function(evt) {
	var cls = evt.target;
	var pos = $(cls).attr("pos");
	var data = this.model.get("data")['data'];
	var prodList = this.model.get("prodList");
	console.log(data[pos]);
	prodList.showPageByCls(data[pos]['c_id']);
	return false;
    }
});
ClsShow = Backbone.View.extend({
    initialize : function() {
	var self = this;
	this.template = _.template($("#leftMenuTem").html());
	this.model.on("change:data", function() {
	    self.render();
	});
    },
    events : {
	"click a" : 'changeCls'
    },
    template : null,
    render : function() {
	console.log("render");
	var data = this.model.get("data");
	this.$el.html(this.template(data));
    },
    changeCls : function(evt) {
	var cls = evt.target;
        $(this.$el.find("a")).removeClass("choosed");
        $(cls).addClass("choosed");
	var pos = $(cls).attr("pos");
	var data = this.model.get("data")['data'];
	var prodList = this.model.get("prodList");
	console.log(data[pos]);
	prodList.showPageByCls(data[pos]['c_id']);
	return false;
    }
});

ProdCls = Backbone.Model.extend({
    initialize : function() {
	this.classList();
    },
    defaults : {
	prodList : null,
	data : null
    },
    classList : function() {
	var self = this;
	var postData = {};
	postData['instr'] = "classList";
	$.post("instr.php", postData, function(data) {
	    data = JSON.parse(data);
	    console.log(data);
	    self.set("data", data);
	});
    }
});
