$(document).ready(function() {
    var login = new View({'model' : new Model()});
    $("#captchaReload").on("click", function() {
	$($(this).find('img')).attr('src', "instr.php?instr=captchaShow&cls=login&timestamp=" + new Date().getTime());
	return false;
    });
});

