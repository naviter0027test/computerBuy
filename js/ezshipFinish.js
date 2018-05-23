$(document).ready(function() {
    $("#template").load("template/orderResult.html", function() {
        var order = new EzshipOrderShow({'model' : new OrderModel(), 'el' : "#orderShow"});
        order.template = _.template($("#ezshipOrderShowTem").html());

        var ezshipInfo = {};
        ezshipInfo['st_cate'] = getUrlParameterEscape("st_cate");
        ezshipInfo['st_code'] = getUrlParameterEscape("st_code");
        ezshipInfo['st_name'] = getUrlParameterEscape("st_name");
        ezshipInfo['webtemp'] = getUrlParameterEscape("webtemp");
        ezshipInfo['st_addr'] = getUrlParameterEscape("st_addr");
        ezshipInfo['st_tel'] = getUrlParameterEscape("st_tel");
        ezshipInfo['st_id'] = getUrlParameterEscape("st_id");
        var postData = {};
        postData['instr'] = "ezshipStore";
        postData['orderSN'] = getUrlParameterEscape("order_id");
        postData['ezshipInfo'] = ezshipInfo;
        $.post("instr.php", postData, function(data) {
            data = JSON.parse(data);
            console.log(data);
            if(data['status'] != 200) {
                console.log(data);
                alert(data['msg']);
            }
            order.model.getOrderId();
        });

        order.model.on("change:data", function() {
            order.render();
        });
    });
    $("#header").load("template/header.html");
    $("#footer").load("template/footer.html");
});
