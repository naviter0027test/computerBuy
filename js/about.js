$(document).ready(function() {
    $("#header").load("template/header.html",function() {
        $("#nav a[href='about.html']").addClass("choosed");
    });
    $("#footer").load("template/footer.html");
});
