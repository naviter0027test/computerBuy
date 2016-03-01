$(document).ready(function() {
    $("#slideBanner").bxSlider({
        auto : true
    });
    $("#header").load("template/header.html",function() {
        $("#nav a[href='index.html']").addClass("choosed");
    });
    $("#footer").load("template/footer.html");
});
