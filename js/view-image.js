$(document).ready(function(){
    $('#comment').prettyComments({
        maxHeight: 500
    });
    
    $('#sendComment').click(function(){
        var data = "";
        var comment = $('#comment').val();
        var image_id = $('#image_id').val();

        data = data+'&comment='+comment;
        data = data+'&image_id='+image_id;

        $.ajax({
            type: "POST",
            url: "/process.php",
            data: "action=image_comment"+data,
            success: function(msg){
                if(msg=='comment_empty'){
                    $('#message_alert').html('Bạn chưa nhập bình luận!');
                    $('#message_alert').removeClass('success').addClass('error');
                    $('#message_alert').show();
                }
                if(msg=='not_login'){
                    $('#message_alert').html('Bạn cần phải <a href="/dang-nhap">đăng nhập</a> đề gửi bình luận!');
                    $('#message_alert').removeClass('success').addClass('error');
                    $('#message_alert').show();
                }
                if(msg=='ok'){
                    
                    $('#commentContainer').append('<div>'+$("#myFullname").val()+":"+comment+'</div>');
                    $('#comment').val('');
                }
            }
        });
    });
    
});