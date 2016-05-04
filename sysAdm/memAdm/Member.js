
MemberList = Backbone.View.extend({
    initialize : function() {
	var self = this;
	self.template = _.template(self.$el.find("script").html());
	this.model.on("change:data", function() {
	    self.render();
	});
    },
    events : {
	"change select[name=active]" : "prodAct",
	"click table a" : "prodOper"
    },
    el : '',
    template : null,
    render : function() {
        console.log("member list render");
	var data = this.model.get("data");
	var self = this;
	data['nowPage'] = parseInt(this.model.get("nowPage"))+1;
	this.$el.html(this.template(data));
    }
});

MemberModel = Backbone.Model.extend({
    initialize : function() {
    },
    defaults : {
	el : null,
	data : null,
	nowPage : 1
    },
    list : function(nowPage) {
        var self = this;
        var postData = {};
        postData['instr'] = "memList";
        postData['nowPage'] = nowPage;

        this.set("nowPage", nowPage);

        $.post("instr.php", postData, function(data) {
            data = JSON.parse(data);
            console.log(data);
            self.set("data", data);
        });
    },
    nothing : function() {
    }
});
