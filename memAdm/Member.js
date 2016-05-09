MemberSideBar = Backbone.View.extend({
    initialize : function() {
    },
    el : '',
    template : null,
    render : function() {
        var isLogin = this.model.get("isLogin");
        if(isLogin) {
            this.template = _.template($("#leftLoginTem").html());
            location.href = "#memHome";
        }
        else
            this.template = _.template($("#leftNotLoginTem").html());
	this.$el.html(this.template());
    }
});

MemberPanel = Backbone.View.extend({
    initialize : function() {
    },
    el : '',
    events : {
        "submit form" : "subAjax"
    },
    template : null,
    render : function() {
        this.template = _.template($("#memHome").html());
	this.$el.html(this.template());
    },
    subAjax : function() {
        var self = this;
        var form = this.$el.find("form");
        $(form).ajaxSubmit(function(data) {
            console.log(data);
            data = JSON.parse(data);
            if(data['status'] == 200) {
                self.model.set("isLogin", true);
                alert("登入成功");
            }
            else {
                if(data['msg'] == "please input password")
                    alert("請輸入密碼");
                else if(data['msg'] == "Exception: not find member")
                    alert("輸入的帳號或密碼錯誤");
                self.model.set("isLogin", false);
            }
        });
        return false;
    }
});

MemberModel = Backbone.Model.extend({
    initialize : function() {
        console.log("model");
    },
    defaults : {
	'data' : null,
        'isLogin' : null
    },
    getPage : function(page) {
        var self = this;
        var postData = {};
        postData['instr'] = "pageShow";
        postData['page'] = page;
        $.post("instr.php", postData, function(data) {
            data = JSON.parse(data);
            console.log(data);
            self.set("data", data);
        });
    },
    isLogin : function() {
        var self = this;
        var postData = {};
        postData['instr'] = "isLogin";
        $.post("instr.php", postData, function(data) {
            data = JSON.parse(data);
            console.log(data);
            if(data['status'] == 200) 
                self.set("isLogin", true);
            else
                self.set("isLogin", false);
        });
    }
});
