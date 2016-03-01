$(document).ready(function() {
    $("#header").load("template/header.html",function() {
        $("#nav a[href='service.html']").addClass("choosed");
    });
    $("#footer").load("template/footer.html");
});

