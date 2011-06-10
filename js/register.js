$(document).ready(function(){
    $('#btnRegister').click(function(){
        var data = "";
        var fullname = $('#fullname').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var re_password = $('#re_password').val();

        data = data+'&fullname='+fullname;
        data = data+'&email='+email;
        data = data+'&password='+password;
        data = data+'&re_password='+re_password;

        $.ajax({
            type: "POST",
            url: "/process.php",
            data: "action=register"+data,
            success: function(msg){
                if(msg=='fullname_empty'){
                    $('#message_alert').html('Bạn chưa nhập họ tên!');
                    $('#message_alert').show();
                }
                if(msg=='email_error'){
                    $('#message_alert').html('Email không đúng định dạng!');
                    $('#message_alert').show();
                }
                if(msg=='email_exist'){
                    $('#message_alert').html('Email này đã được đăng ký sử dụng!');
                    $('#message_alert').show();
                }
                
                if(msg=='password_empty'){
                    $('#message_alert').html('Bạn chưa nhập mật khẩu!');
                    $('#message_alert').show();
                }
                if(msg=='password_not_match'){
                    $('#message_alert').html('Mật khẩu không trùng nhau!');
                    $('#message_alert').show();
                }
                if(msg=='password_short'){
                    $('#message_alert').html('Mật khẩu phải ít nhất 6 ký tự!');
                    $('#message_alert').show();
                }
                if(msg=='ok'){
                    $('#message_alert').html('Cám ơn, Bạn đã đăng ký thành công!');
                    $('#message_alert').removeClass('error').addClass('success');
                    $('#message_alert').show();
                }
            }
        });
    });



    
});