$(document).ready(function() {
    $("#scriptLoad").load("template/productList.html", function() {
        var prodList = new ProductList({'model' : new ProdModel(), 'el' : "#content"});
        var prodcls = new ClsShow({'model' : new ProdCls(), 'el' : "#leftMenu" });
        //var topMenu = new ClsTop({'model' : new ProdCls(), 'el' : "#topMenu" });
        prodcls.model.set('prodList', prodList);
        //topMenu.model.set('prodList', prodList);

        $("#header").load("template/header.html",function() {
            $("#nav a[href='productList.html']").addClass("choosed");
        });
        $("#footer").load("template/footer.html");
    });
});

