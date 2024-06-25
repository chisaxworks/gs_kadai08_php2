// toggle

$('.add_btn').click(function () {

    if($('.add_btn').hasClass('active')){
        $('.input_wrap').slideUp(1000);
        $('.add_btn').removeClass('active');
        $('.add_btn').html('情報登録');
    }else{
        $('.input_wrap').slideDown(1000);
        $('.add_btn').addClass('active');
        $('.add_btn').html('閉じる');
    };

});