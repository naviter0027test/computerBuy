/*
 *  File Name :
 *	orderCheck.js
 *  Describe :
 *	將購物車的資料取出並填入地址
 *  Author :
 *	Lanker
 *  Modify Date :
 *	2015.12.17
 *	    填入台灣縣市鄉鎮
 */

$(document).ready(function() {
    $("#template").load("template/orderCheck.html", function() {
	var cartStore = new CartStore();
	var cartv = new Cart({'el' : "#cartShow", 'model' : cartStore});

        $("#payResult").validationEngine({
            validationEventTrigger : 'submit',
            notEmpty : true
        });


        $(".orderCreate").on("click", function() {
            var isValid = $("#payResult").validationEngine("validate");
            if(isValid == true) {
                $("#payResult").submit();
            }
            return false;
        });
        $("#payResult").submit(function() {
            var formArr = $(this).serializeArray();
            var postData = {};
            _.each(formArr, function(item) {
                postData[item['name']] = item['value'];
            });
            postData['cart'] = cartStore.toJSON()['data'];
            postData['instr'] = "createOrder";
            console.log(postData);
            $.post("instr.php", postData, function(data) {
                console.log(data);
                data = JSON.parse(data);
                console.log(data);
                if(data['status'] = 200) {
                    cartStore.clear();
                    if($("[name=payMode]:checked").val() == "ezship") {
                        $("#ezshipForm [name=rv_name]").val($("[name=buyName]").val());
                        $("#ezshipForm [name=rv_email]").val($("[name=buyEmail]").val());
                        $("#ezshipForm [name=rv_mobil]").val($("[name=buyTel]").val());
                        $("#ezshipForm [name=order_id]").val(data['order']['o_no']);
                        $("#ezshipForm [name=rturl]").val("http://"+data['myHost']+"/computerBuy/ezshipFinish.html");
                        $("#ezshipForm").submit();
                    }
                    else 
                        location.href = "orderResult.html?orderSN=" + data['order']['o_no'];
                }
            });
            return false;
        });
	$.post("js/taiwan.json", function(data) {
	    console.log(data);
	    data = data['taiwan'];
	    $("select[name=buyCity]").html("");
	    $("select[name=buyArea]").html("");
	    var city = document.createElement("option");
	    $(city).val("");
	    $(city).text("請選擇");
	    $("select[name=buyCity]").append(city);
	    for(var i in data) {
		var city = document.createElement("option");
		$(city).val(i);
		$(city).text(i);
		$("select[name=buyCity]").append(city);
	    }
	    $("select[name=buyCity]").on("change", function() {
		$("select[name=buyArea]").html("");
		var city = $(this).val();
		if(city == "") {
		    return false;
		}
		var areaArr = data[city]['area'];
		for(var i in areaArr) {
		    var area = document.createElement("option");
		    $(area).val(areaArr[i]['name']);
		    $(area).text(areaArr[i]['name']);
		    $("select[name=buyArea]").append(area);
		}
	    });
	});
        var payMethod = new PayMethod({'el' : '#payMethod', 'model' : new PayProcess()});
    });
});
