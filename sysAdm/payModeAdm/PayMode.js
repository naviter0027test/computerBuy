/*
 *  File Name :
 *      PayMode.php
 *  Describe : 
 *      取出所有付款模式，並能修改與刪除
 *      的前端操作
 *  Author :
 *      Lanker
 *  Start Date :
 *      2015.12.24
 */

PayModeEdit = Backbone.View.extend({
    initialize : function() {
        //console.log(pos);
        var payData = localStorage.getItem("payModeData");
        payData = JSON.parse(payData);
        console.log(payData);
    }
});

PayModeList = Backbone.View.extend({
    initialize : function() {
        var self = this;
        this.template = _.template($("#payModelListTem").html());
        this.model.on("change:data", function() {
            self.render();
        });
        this.model.payModeList();
    },
    events : {
        "click table a.payEdit" : "payEdit"
    },
    el : '',
    template : null,
    render : function() {
        var data = this.model.get("data");
        this.$el.html(this.template(data));
    },
    payEdit : function(evt) {
        var data = this.model.get("data");
        var pos = $(evt.target).attr("pos");
        console.log(data['data'][pos]);
        var json = JSON.stringify(data['data'][pos]);
        localStorage.setItem("payModeData", json);
    }
});

PayModeModel = Backbone.Model.extend({
    initialize : function() {
        console.log("model paymode created");
    },
    defaults : {
        'data' : null
    },
    payModeList : function() {
        var self = this;
        var postData = {};
        postData['instr'] = "shipList";
        $.post("instr.php", postData, function(data) {
            //console.log(data);
            data = JSON.parse(data);
            console.log(data);
            self.set("data", data);
        });
    }
});
