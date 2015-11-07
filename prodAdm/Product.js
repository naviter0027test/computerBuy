ProductList = Backbone.View.extend({
    initialize : function() {
	var self = this;
	this.model.on("change:data", function() {
	    var data = this.get('data');
	    var pageSum = this.get('pageSum');
	    var nowPage = this.get('nowPage');
	    console.log(data);
	    data['pageSum'] = pageSum;
	    data['nowPage'] = nowPage;
	    self.render(data);
	});

	this.showPage();
    },
    el : '',
    template : null,
    showPage : function() {
	var initData = {};
	initData['nowPage'] = this.model.get('nowPage');
	this.model.prodList(initData);
	this.template = _.template($("#prodListTem").html());
    },
    render : function(data) {
	this.$el.html('');
	this.$el.html(this.template(data));
	var self = this;
	$(".pager a").on("click", function() {
	    self.model.set("nowPage", $(this).text());
	    self.showPage();
	});
    }
});

ProdModel = Backbone.Model.extend({
    initialize : function() {
    },
    defaults : {
	data : null,
	pageSum : 0,
	nowPage : 1
    },
    prodList : function(initData) {
	var nowPage = initData['nowPage'];
	var postData = {};
	postData['instr'] = "maxPage";
	postData['interval'] = 9;

	var self = this;
	$.post("instr.php", postData, function(data) {
	    data = JSON.parse(data);
	    console.log(data);
	    self.set('pageSum', data['pageSum']);
	});

	postData['instr'] = "prodList";
	postData['nowPage'] = nowPage;

	$.post("instr.php", postData, function(data) {
	    data = JSON.parse(data);
	    self.set('data', data);
	});

    }
});
