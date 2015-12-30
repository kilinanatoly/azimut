$(document).ready(function(){
  $('.your-class').slick({
  });

  $('.hui').slick({
  slidesToShow: 6,
  slidesToScroll: 1,
  autoplay: false,
  autoplaySpeed: 2000,
});


  if ($('div').is('.characteristics')){
    $.ajax({
      type: "GET",
      url: "/site/getcharacteristics?id="+$("#parent_id").val(),
      success: function(html){
        if (html!='empty'){
          $('.characteristics').html(html);
        }
        else{
        }
      }
    });
  }
});