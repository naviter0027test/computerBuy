
AdminRoutes = Backbone.Router.extend({
    initialize : function() {
    },
    routes : {
	'newsAdmLeft' : 'allBlogShow'
    },
    allBlogShow : function() {
	console.log('test');
    }
});
