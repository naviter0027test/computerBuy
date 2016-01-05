/*
 *  File Name :
 *      PayMethod.js
 *  Describe :
 *      顯示付款方式與選擇付款方式
 *  Author :
 *      Lanker
 *  Start Date :
 *      2015.1.04
 */

PayMethod = Backbone.View.extend({
    initialize : function() {
        var self = this;
        console.log("pay method");
        this.template = _.template($("#payMethodTem").html());
        this.model.on("change:data", function() {
            self.render();
        });
        this.model.payMethodList();
    },
    events : {
        "change input[name=payMode]" : "payChange"
    },
    el : '',
    template : null,
    render : function() {
        var data = this.model.get("data");
        this.$el.html(this.template(data));
    },
    payChange : function(evt) {
        var data = this.model.get("data");
        var pos = $(evt.target).attr("pos");
        if($(evt.target).val() == "atm")
            $("#atm_5").show();
        else
            $("#atm_5").hide();
        console.log(data['data'][pos]);
        $("#shippment").text(data['data'][pos]['pm_shipment']);
    }
});

PayProcess = Backbone.Model.extend({
    initialize : function() {
        console.log("pay process");
    },
    defaults : {
        data : null
    },
    payMethodList : function() {
        var self = this;
        var postData = {};
        postData['instr'] = "shipList";
        $.post("instr.php", postData, function(data) {
            console.log(data);
            data = JSON.parse(data);
            console.log(data);
            self.set("data", data);
        });
    }
});
