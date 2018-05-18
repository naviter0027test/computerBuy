$(document).ready(function() {
    $("#template").load("template/orderResult.html", function() {
        var order = new OrderShow({'model' : new OrderModel(), 'el' : "#orderShow"});
        order.model.getOrder();
    });
    $("#header").load("template/header.html");
    $("#footer").load("template/footer.html");
});
