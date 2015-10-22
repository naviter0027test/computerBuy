
AdminRoutes = Backbone.Router.extend({
    initialize : function() {
	$("#left").load("left.html");
	$("#header").load("header.html");
    },
    routes : {
	'productList' : 'productList'
    },
    productList : function() {
	$("#right").load("prodAdm/prodList.html", function() {
	    var tem = _.template($("#right > script").html());
	    $("#right tbody").html(tem());
	    $("#left a").removeClass('clicked');
	    $("#left a[href=#productList]").addClass('clicked');
	});
    }
});
