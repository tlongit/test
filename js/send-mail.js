$(document).ready(function(){
    $('#btnSendMail').click(function(){
        var data = "";
        var to = $('#to').val();
        var title = $('#title').val();
        var message = $('#message').val();
        
        data = data+'&to='+to;
        data = data+'&title='+title;
        data = data+'&message='+message;
        
        $.ajax({
            type: "POST",
            url: "/process.php",
            data: "action=send_mail"+data,
            success: function(msg){
                if(msg=='to_empty'){
                    showMessageError('Bạn chưa nhập email người nhận!');
                }
                if(msg=='email_invalid'){
                    showMessageError('Có email bạn nhập không đúng định dạng!');
                }
                if(msg=='title_empty'){
                    showMessageError('Bạn chưa nhập tiêu đề!');
                }
                if(msg=='message_empty'){
                    showMessageError('Bạn chưa nhập nội dung gửi đi!');
                }
                if(msg=='ok'){
                    showMessageSuccess("Tin nhắn của bạn đã được gửi đi!");
                    $('#to').val('');
                    $('#title').val('');
                    $('#message').val('');
                }
            }
        });
    });



    
});


function showMessageError(message){
    $('#message_alert').html(message);
    $('#message_alert').removeClass('success').addClass('error');
    $('#message_alert').show();
}
function showMessageSuccess(message){
    $('#message_alert').html(message);
    $('#message_alert').removeClass('error').addClass('success');
    $('#message_alert').show();
}