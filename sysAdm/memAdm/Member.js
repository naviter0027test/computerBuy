
MemberList = Backbone.View.extend({
    initialize : function() {
        console.log("member list created!");
    },
    events : {
	"change select[name=active]" : "prodAct",
	"click table a" : "prodOper"
    },
    el : '',
    template : null,
    render : function() {
    }
});

MemberModel = Backbone.Model.extend({
    initialize : function() {
        console.log("member model created!");
    },
    defaults : {
	el : null,
	data : null,
	nowPage : 1
    },
    nothing : function() {
    }
});
