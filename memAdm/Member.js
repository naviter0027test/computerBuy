MemberSideBar = Backbone.View.extend({
    initialize : function() {
	this.template = _.template($("#leftNotLoginTem").html());
    },
    el : '',
    template : null,
    render : function() {
	this.$el.html(this.template());
    }
});
