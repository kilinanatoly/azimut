$(function() {
    $(document).on("change",".p1_check",function(){
        if ($(this).prop('checked')){
            var ch = $(this).closest('div').next();
            ch.find('input').each(function(i,elm){
                $(elm).prop('checked',true);
            });
        }
        else{
            var ch = $(this).closest('div').next();
            ch.find('input').each(function(i,elm){
                $(elm).prop('checked',false);
            });
        }
    });
    //$("#demo li").hide();
    $("#menu > ul> li ul").hide();

    $("#menu >ul li").each(function (i,elm) {
        if (!$(elm).find(' ul').length){
                $(elm).find('span.pl').after("<span class='tch'>.</span>");
                $(elm).find('span.pl').remove();
                $(elm).find('a.pll').attr('href', '#');
        }
    });

        $(document).on('click','.pl',function(){
            elm=$(this).parent().find('>ul');
            if (elm.css('display')=='none'){
                elm.show();
            }else{
                elm.hide();
            }
            return false;
        });
    $("#modarendatree-name").focus();
        if ($("input").is("#arendatypes-name")){
            $("#arendatypes-name").focus();
        }
    if ($("input").is("#characteristics-name")){
        $("#characteristics-name").focus();
    }
    if ($("div").is(".alert-success")){
        setTimeout(function(){$('.alert-success').fadeOut('fast')},3000);  //30000 = 30 секунд
    }
});