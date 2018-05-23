/*
 *  File Name :
 *      Order.js
 *  Describe :
 *      展示訂單結果
 *  Author :
 *      Lanker
 *  Start Date :
 *      2015.12.22
 */

//取得網址中GET參數
function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

function getUrlParameterEscape(sParam) {
    var sPageURL = decodeURIComponent(escape(window.location.search.substring(1))),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
}

OrderShow = Backbone.View.extend({
    initialize : function() {
        var self = this;

        //設定template 模板
        this.template = _.template($("#orderShowTem").html());
        this.model.on("change:data", function() {
            self.render();
        });
    },
    el : '',
    template : null,
    events : {
    },
    render : function() {
        var data = this.model.get("data");
        this.$el.html(this.template(data));
    }
});

EzshipOrderShow = Backbone.View.extend({
    initialize : function() {
    },
    el : '',
    template : null,
    events : {
    },
    render : function() {
        var data = this.model.get("data");
        data['ezshipInfo'] = JSON.parse(data['order']['ezshipInfo']);
        data['ezshipInfo']['st_addr'] = unescape(data['ezshipInfo']['st_addr'].replace(/u/g, '%u'))
        data['ezshipInfo']['st_name'] = unescape(data['ezshipInfo']['st_name'].replace(/u/g, '%u'))
        console.log(data['ezshipInfo']);
        this.$el.html(this.template(data));
    }
});

OrderModel = Backbone.Model.extend({
    initialize : function() {
    },
    defaults : {
        data : null
    },
    getOrder : function() {
        var self = this;
        var postData = {};
        postData['instr'] = "getOrder";
        postData['orderSN'] = getUrlParameter('orderSN');
        $.post("instr.php", postData, function(data) {
            data = JSON.parse(data);
            console.log(data);
            self.set("data", data);
        });
    },
    getOrderId : function() {
        //ezship使用
        var self = this;
        var postData = {};
        postData['instr'] = "getOrder";
        postData['orderSN'] = getUrlParameterEscape('order_id');
        $.post("instr.php", postData, function(data) {
            data = JSON.parse(data);
            console.log(data);
            self.set("data", data);
        });
    }
});
