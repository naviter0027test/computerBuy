$(document).ready(function() {
    var prodList = new ProductList({'model' : new ProdModel(), 'el' : "#content"});
    var prodcls = new ClsShow({'model' : new ProdCls(), 'el' : "#leftMenu" });
    prodcls.model.set('prodList', prodList);
});
