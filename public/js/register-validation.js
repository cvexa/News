$(function(){
    $('#email').on('keyup', function(){
        duplicateEmail($(this));
    });

    $('#password').on('keyup', function(){
                    // console.log(this.value.length < 8);
                    if(this.value.length < 8){
                        $('.short-password').stop(true, true).fadeIn(500);
                        $('#submit-register').removeClass('submit-stop-password').addClass('submit-stop-password');
                    }else{
                        $('.short-password').stop(true, true).fadeOut(500);
                        $('#submit-register').removeClass('submit-go-password').removeClass('submit-stop-password').addClass('submit-go-password');
                    }
                });

    function duplicateEmail(element){
        var email = $(element).val();
        var url = $('.route-no-show').attr('data-route');
        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $( 'meta[name="csrf-token"]' ).attr( 'content' )
            },
            url: url,
            data: {email:email},
            dataType: "json",
            success: function(data, textStatus, xhr) {
                if(data.status === 'not_valid'){
                    $('.success-email').stop(true, true).fadeOut(500);
                    $('.error-taken').stop(true, true).fadeOut(500);
                    $('.error-not-valid').stop(true, true).fadeIn(500);
                    $('#submit-register').removeClass('submit-stop').addClass('submit-stop');
                }
                if(data.status === 'taken'){
                    $('.success-email').stop(true, true).fadeOut(500);
                    $('.error-not-valid').stop(true, true).fadeOut(500);
                    $('.error-taken').stop(true, true).fadeIn(500);
                    $('#submit-register').removeClass('submit-stop').addClass('submit-stop');
                }
                if(data.status === 'free'){
                    $('.error-not-valid').stop(true, true).fadeOut(500);
                    $('.error-taken').stop(true, true).fadeOut(500);
                    $('.success-email').stop(true, true).fadeIn(500);
                    $('#submit-register').removeClass('submit-go').removeClass('submit-stop').addClass('submit-go');
                }
            },
            error: function (XHR, exception) {
                console.log(XHR.status);
            }
        });
    }

    $("#register-form").on("submit", function(e){
        if($('#submit-register').hasClass('submit-go') && $('#submit-register').hasClass('submit-go-password')){
            return true;
        }else{
            return false;
            e.preventDefault();
        }
    });
});