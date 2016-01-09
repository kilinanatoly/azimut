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
//отправка формы Запросить договор поставки
  $(".send_form2").submit(function(){
    if ($("#tel1").val()=='' && $("#email1").val()==''){
      $(".send_form2 .success-text").text("");
      $(".send_form2 .error-text").text("Пожалуйста, заполните хотя бы одно из полей (номер телефона или email)");
    }else{
      $(".send_form2 .error-text").text("");

      $.ajax({
        type: "GET",
        url: "/site/add_call_me_message?name="+$("#name1").val()+"&email="+$("#email1").val()+"&tel="+$("#tel1").val()+"&inn="+$("#inn1").val()+"&gorod="+$("#gorod1").val()+"&comment="+$("#comment1").val()+"&product_id="+$("#product_id1").val(),
        beforeSend: function(){
          $("#call_me_modal .btn-default").text('Подождите...').css('opacity','0.70');
        },
        complete: function(){
          $("#call_me_modal .btn-default").text('Свяжитесь со мной').css('opacity','1');
        },
        success: function(html){
          if (html=='success'){
            $(".send_form2 .success-text").text("Большое спасибо за обращение, в скором времени мы свяжемся с вами");
            $(':input','.send_form2')
                .not(':button, :submit, :reset, :hidden')
                .val('')
                .removeAttr('checked')
                .removeAttr('selected');
          }
        }
      });
    }
    return false;
  });
//отправка формы Запрос на оплату
  $(".send_form3").submit(function(){
    if ($("#tel2").val()=='' && $("#email2").val()==''){
      $(".send_form3 .success-text").text("");
      $(".send_form3 .error-text").text("Пожалуйста, заполните хотя бы одно из полей (номер телефона или email)");
    }else{
      $(".send_form3 .error-text").text("");

      $.ajax({
        type: "GET",
        url: "/site/add_buy_message?name="+$("#name2").val()+"&email="+$("#email2").val()+"&tel="+$("#tel2").val()+"&inn="+$("#inn2").val()+"&gorod="+$("#gorod2").val()+"&comment="+$("#comment2").val()+"&product_id="+$("#product_id2").val(),
        beforeSend: function(){
          $("#buy_modal .btn-default").text('Подождите...').css('opacity','0.70');
        },
        complete: function(){
          $("#buy_modal .btn-default").text('Запросить счет на оплату').css('opacity','1');
        },
        success: function(html){
          if (html=='success'){
            $(".send_form3 .success-text").text("Спасибо за запрос, в скором времени мы свяжемся с Вами.");
            $(':input','.send_form3')
                .not(':button, :submit, :reset, :hidden')
                .val('')
                .removeAttr('checked')
                .removeAttr('selected');
          }
        }
      });
    }
    return false;
  });

  //отправка формы Запрос коммерческого предложения
  $(".send_form4").submit(function(){
    if ($("#tel3").val()=='' && $("#email3").val()==''){
      $(".send_form4 .success-text").text("");
      $(".send_form4 .error-text").text("Пожалуйста, заполните хотя бы одно из полей (номер телефона или email)");
    }else{
      $(".send_form4 .error-text").text("");

      $.ajax({
        type: "GET",
        url: "/site/add_price_zapros_message?name="+$("#name3").val()+"&email="+$("#email3").val()+"&tel="+$("#tel3").val()+"&product_id="+$("#product_id3").val(),
        beforeSend: function(){
          $("#zapros_price_modal .btn-default").text('Подождите...').css('opacity','0.70');
        },
        complete: function(){
          $("#zapros_price_modal .btn-default").text('Запросить счет на оплату').css('opacity','1');
        },
        success: function(html){
          if (html=='success'){
            $(".send_form4 .success-text").text("Спасибо за запрос, в скором времени мы свяжемся с Вами.");
            $(':input','.send_form4')
                .not(':button, :submit, :reset, :hidden')
                .val('')
                .removeAttr('checked')
                .removeAttr('selected');
          }
        }
      });
    }
    return false;
  });

$("#syndicated-content a").attr('title','Распечатать страницу в PDF');

  $(".add_comment_form").submit(function(){
    $(".success-text").text('');
    $.ajax({
      type: "GET",
      url: "/site/addcomment?name="+$("#commentName").val()+"&email="+$("#commentEmail").val()+"&comment="+$("#commentComment").val()+"&product_id="+$("#commentProductid").val(),
      beforeSend: function(){
        $(".add_comment_form .btn-default").text('Подождите...').css('opacity','0.70');
      },
      complete: function(){
        $(".add_comment_form .btn-default").text('Отправить').css('opacity','1');
      },
      success: function(html){
        if (html=='success'){
          $(".add_comment_form .success-text").text("Спасибо за отзыв, он появится после модерации.");
          $(':input','.add_comment_form')
              .not(':button, :submit, :reset, :hidden')
              .val('')
              .removeAttr('checked')
              .removeAttr('selected');
        }
      }
    });
    return false;
  });

  $(".call_me_main").submit(function(){
    $(".success-text").text('');
    $.ajax({
      type: "GET",
      url: "/site/callmemain?name="+$("#call_me_name").val()+"&tel="+$("#call_me_tel").val(),
      beforeSend: function(){
        $(".call_me_main .btn-default").text('Подождите...').css('opacity','0.70');
      },
      complete: function(){
        $(".call_me_main .btn-default").text('Отправить').css('opacity','1');
      },
      success: function(html){
        if (html=='success'){
          $(".call_me_main .success-text").text("Спасибо за запрос, ожидайте звонка ");
          $(':input','.call_me_main')
              .not(':button, :submit, :reset, :hidden')
              .val('')
              .removeAttr('checked')
              .removeAttr('selected');
        }
      }
    });
    return false;
  });



  $(".first_comment").click(function(){
    $("#commentName").focus();
    return false;
  });


  $("#city").change(function(){
    if ($(this).val()=="0"){
      $('.header_tel').text('+7(960)085-41-39');
    }else{
      $.ajax({
        type: "GET",
        url: "/site/get_tel?cityid="+$(this).val(),
        success: function(html){
          if (html!='fail'){
            $('.header_tel').text(html);
          }
        }
      });
    }
  });


});

