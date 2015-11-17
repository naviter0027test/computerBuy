ClsList = Backbone.View.extend({
    initialize : function() {
	var self = this;
	this.model.clsAll();
	this.template = _.template($("#clsListTem").html());
	this.model.on("change:data", function() {
	    self.render();
	});
    },
    events : {
	'click a' : 'operating'
    },
    el : '',
    template : null,
    render : function() {
	var data = this.model.get("data");
	this.$el.html(this.template(data));
    },

    operating : function(evt) {
	var btn = evt.target;
	var data = this.model.get("data");
	var pos = $(btn).attr("pos");
	var oper = $(btn).attr("oper");
	if(oper == "del") {
	    this.model.clsDel(data['data'][pos]['c_id'])
	}
	return false;
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
	$("#clsAdd").ajaxSubmit(function(data) {
	    data = JSON.parse(data);
	    console.log(data);
	    if(data['status'] == 200)
		alert("新增成功");
	    else 
		alert("新增失敗");
	});
    },
    clsDel : function(c_id) {
	var self = this;
	var postData = {};
	postData['instr'] = "classDel";
	postData['c_id'] = c_id;
	$.post("instr.php", postData, function(data) {
	    data = JSON.parse(data);
	    if(data['status'] == 200) {
		alert("刪除成功");
		self.clsAll();
	    }
	});
    }
});
