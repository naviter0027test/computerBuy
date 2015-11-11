View = Backbone.View.extend({
    initialize : function() {
    },
    el : "#login",
    
    events : {
	"click button" : "login"
    },

    login : function(evt) {
	this.model.set("el", this.$el);
	this.model.login();
	return false;
    }
});

Model = Backbone.Model.extend({
    initialize : function() {
    },
    defaults : {
	el : null,
	data : null
    },
    login : function() {
	var el = this.get("el");
	el.ajaxSubmit(function(data, status) {
	    if(status == "success") {
		data = JSON.parse(data);
		if(data['status'] == 500) 
		    if(data['msg'] == "已經登入了") {
			alert(data['msg']);
			location.href = "admin.html";
		    }
		    else {
			alert("登入失敗");
			$("#captchaReload").trigger('click');
		    }
		else if(data['status'] == 200) {
		    alert("成功登入");
		    location.href = "admin.html";
		}
	    }
	});
    }
});
