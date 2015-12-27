$(function() {


    if($("#sel_regions").val()!=''){
        $(".cats_add").show()

    }
    $(".sel_city a").click(function(){
        $('.city_select_wrap').fadeIn('slow');
        return false;
    });

    $(document).on("change",".arenda_view input",function(){
        if ($(this).val()=='spros'){
            $(".span_type").text('Приобрету в аренду: ');
        }else{
            $(".span_type").text('Сдам в аренду: ');
        }

    });
    $(".span_type").click(function(){
        $('.city_select_wrap').fadeIn('slow');
        $('.arenda_view_wrap').fadeIn('slow');
        $('.cats_add').fadeIn('slow');
    });
    $(document).on("click",".main_cat_item,.main_cat_item_a",function(){
        $('body,html').animate({scrollTop: 50+'px'}, 600);
        var val = $(this);
        if($(this).hasClass('main_cat_item')){
            var title = val.find(".item_text>header").text();
            $(".first_caat").nextAll('*').remove();
            $(".first_caat").html('<span data-id="'+val.data('id')+'"><a  class="main_cat_item_a" href="#" data-id="'+val.data('id')+'">'+title + '</a></span>');
            $(".arenda_type_row").html('');
            $(".arenda_type_row").hide('')

        }else{
            var title = val.text();
        }

        $('.city_select_wrap').fadeOut('fast');
        $('.arenda_view_wrap').fadeOut('fast');
        $('.cats_add').fadeOut('fast');
        $(".main_cat_item").removeClass("active");
        $(this).toggleClass("active");

        $.ajax({
            type: "GET",
            url: "getcats?cat_id="+val.data('id'),
            success: function(html){

                if (html!='empty'){
                    $(".cats_first_list").html('<p class="ad_add_title"> Выберите категорию</p>'+html);
                    $(".cats_first_list .ad_add_title").text(title);
                    $(".cats_next").hide();
                    $(".cats_first").show('fast');
                }
                else{
                }
            }
        });
        return false;
    });

    $(document).on("click",".cats_first_list ul li>a,.cats_first_list_a",function(){
        var val = $(this);

        if (!(val.hasClass('cats_first_list_a'))){
            $(".first_caat").nextAll('*').remove();
            $(".arenda_type_row").html('');
            $(".arenda_type_row").hide();
            $(".cats_bread").append('<span data-id="'+val.data('id')+'"><a  class="cats_first_list_a" href="#" data-id="'+val.data('id')+'">'+val.text() + '</a></span>');

        }
        $('.city_select_wrap').fadeOut('fast');
        $('.arenda_view_wrap').fadeOut('fast');

        $('.cats_add').fadeOut('fast');
        $.ajax({
            type: "GET",
            url: "getcats?cat_id="+val.data('id'),
            success: function(html){
                $(".cats_next .ad_add_title").text(val.text());
                if (html!='empty'){
                    $(".cats_next_list").html(html);
                    $(".cats_first").hide();
                    $(".cats_next").show('fast');


                }else{
                    $(".first_caat").nextAll("*").remove();
                    $(".cats_bread").append('<span data-id="'+val.data('id')+'"><a  class="cats_first_list_a" href="#" data-id="'+val.data('id')+'">'+val.text() + '</a></span>');
                    $.ajax({
                        type: "GET",
                        url: "getarendatypes?id="+val.data('id'),
                        success: function(html){
                            $(".cats_next_list").html('');
                            $(".cats_first_list").html('');
                            $(".cats_next").hide();
                            $(".cats_first").hide();
                            if (html!='none'){
                                $(".cats_bread").append(' <span class="dlya">для: </span>');
                                $(".arenda_type_row").html('<div class="col-md-12"><p class="ad_add_title">Выберите тип аренды</p></div>'+html);
                                $(".cats_next").hide();
                                $(".arenda_type_row").show('fast');
                            }else{
                            }
                        }
                    });
                }
            }
        });
        return false;
    });
    $(document).on("click",".cats_next ul li>a,.cats_next_a",function(){
        var val = $(this);
        if (!(val.hasClass('cats_next_a'))){
           $('span[data-id="'+val.data('id')+'"]').nextAll('*').remove();
           $('span[data-id="'+val.data('id')+'"]').remove();
            $(".cats_bread").append('<span data-id="'+val.data('id')+'"><a  class="cats_next_a" href="#" data-id="'+val.data('id')+'">'+val.text() + '</a></span>');
            $('.arenda_type_row').empty();

        }
        $('.city_select_wrap').fadeOut('fast');
        $('.arenda_view_wrap').fadeOut('fast');
        $('.cats_add').fadeOut('fast');

        $.ajax({
            type: "GET",
            url: "getcats?cat_id="+val.data('id'),
            success: function(html){
                if (html!='empty'){
                    $(".cats_next .ad_add_title").text(val.text());
                    $(".cats_next_list").hide();
                    $(".cats_next_list").fadeIn('fast');
                    $(".cats_next_list").html(html);
                    $('.cats_next').show();
                }else{

                        $.ajax({
                            type: "GET",
                            url: "getarendatypes?id="+val.data('id'),
                            success: function(html){
                                if (html!='none'){
                                    if (!(val.hasClass('cats_next_a'))){
                                        $(".cats_bread").append(' <span class="dlya">для: </span>');

                                    }
                                    $(".arenda_type_row").html('<div class="col-md-12"><p class="ad_add_title">Выберите тип аренды</p></div>'+html);
                                    $(".cats_next").hide();
                                    $(".arenda_type_row").show('fast');
                                }else{
                                    alert('asd');
                                }
                            }
                        });
                }
            }
        });
        return false;
    });
    $(document).on("change",".arenda_type_col input:checkbox",function(){
        if ($('a').is('.arenda_type-'+$(this).val()+'')){
            $(this).parent().find(" .img_blue").show();
            $(this).parent().find(" .img_black").hide();
            $('.arenda_type-'+$(this).val()+'').remove();
        }else{
            $(this).parent().find(" .img_blue").hide();
            $(this).parent().find(" .img_black").show();
            $(".cats_bread").append('<a class="arendatype arenda_type-'+$(this).val()+'" href="#">'+$(this).parent().parent().find(".arenda_type_title").text()+'</a>');
        }
    });
    $(document).on("click",".arendatype",function(){
        return false;
    });



    $(document).on('click','.step_to_2',function(){
        $("#step_2_block").show();
        $(".step_to_3").show();
        o = $('#step_2_block').offset();

        $('body,html').animate({scrollTop: o.top-50+'px'}, 600);
    });

    $(document).on('change','.arenda_srok input',function(){
        if ($(".min_arenda_hours").prop('checked'))
        {
            $('.min_arenda_price_span').text('час');
        }
        else{
            $('.min_arenda_price_span').text('день');
        }
    });

    $(document).on('click','.step_to_3',function(){
        $("#step_3_block").show();
        $(".step_to_4").show();

        o = $('#step_3_block').offset();
        $('body,html').animate({scrollTop: o.top-50+'px'}, 600);
    });
    $(document).on('click','.step_to_4',function(){
        $("#step_4_block").show();
        $(".add_ad").show();
        o = $('#step_4_block').offset();
        $('body,html').animate({scrollTop: o.top-50+'px'}, 600);
    });
    $(".sel_regions").select2({
        placeholder: "Выберите регион",
        allowClear: true
    });
    $("#sel_cities").select2({
        placeholder: "Выберите регион",
        allowClear: true
    });


    $('.input_numbers').bind("change keyup input click", function() {
        if (this.value.match(/[^0-9]/g)) {
            this.value = this.value.replace(/[^0-9]/g, '');
        }
        var str=this.value;
        this.value = str.replace(/(\d)(?=(\d\d\d)+([^\d]|$))/g, '$1 ');

    });
    $("#w0").submit(function(){
        if ($(".arenda_types").css('display')!='none'){

            if($("#arenda_type_add").val()==null){
                $('#arenda_type_add').focus();
                return false;
            }
        }

    });

    var uri = ' Набережные Челны московский';
    var res = encodeURI(uri);
    $.ajax({
        type: "GET",
        url: "https://geocode-maps.yandex.ru/1.x/?format=json&geocode="+res+"&results=10&kind=street",
        success: function(html){
            console.log(html.response.GeoObjectCollection.featureMember);

        }
    });
    $('.n_punkt_input').bind('textchange', function() {
        $(".n_punkts").html('');
        var uri = $(this).val();
        var res = encodeURI('Набережные Челны '+uri);
        $.ajax({
            type: "GET",
            url: "https://geocode-maps.yandex.ru/1.x/?format=json&geocode="+res,
            success: function(html){

                    $(html.response.GeoObjectCollection.featureMember).each(function( index ) {
                    console.log( index + ": " + this.GeoObject.name+','+this.GeoObject.description );
                    $(".n_punkts").append('<li><a href="">'+this.GeoObject.name+','+this.GeoObject.description+'</a></li>');
                });
            }
        });
    return true;});


});