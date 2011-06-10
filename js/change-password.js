$(document).ready(function(){
    $('#btnChangePassword').click(function(){
        var data = "";
        var oldPassword = $('#oldPassword').val();
        var newPassword = $('#newPassword').val();
        var rePassword = $('#rePassword').val();

        data = data+'&oldPassword='+oldPassword;
        data = data+'&newPassword='+newPassword;
        data = data+'&rePassword='+rePassword;
        

        $.ajax({
            type: "POST",
            url: "/process.php",
            data: "action=change_password"+data,
            success: function(msg){
                if(msg=='old_password_not_match'){
                    showMessageError('message_alert','Mật khẩu cũ không đúng!');
                }
                if(msg=='password_not_match'){
                    showMessageError('message_alert','Mật khẩu mới không khớp!');
                }
                if(msg=='ok'){
                    showMessageSuccess('message_alert','Bạn đã đổi mật khẩu thành công!');
                }
            }
        });
    });
});

function showMessageError(html_id,message){
    $('#'+html_id).html(message);
    $('#'+html_id).removeClass('success').addClass('error');
    $('#'+html_id).show();
}
function showMessageSuccess(html_id,message){
    $('#'+html_id).html(message);
    $('#message_alert').removeClass('error').addClass('success');
    $('#'+html_id).show();
}