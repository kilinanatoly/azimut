$(function() {
if ($("div").is(".alert-success")){
    setTimeout(function(){$('.alert-success').fadeOut('fast')},3000);  //30000 = 30 секунд
}
    if ($("input").is("#modarendaregions-name")){
          $("#modarendaregions-name").focus();
    }
});