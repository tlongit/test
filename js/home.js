$(document).ready(function(){
    $('#comment,.commentCon').prettyComments({
        maxHeight: 500,
        height: 20
    });
    $('#btnBlogComment').click(function (){
        var comment = $('#comment').val();
        if(comment!='Bạn đang nghĩ gì?'){
            var data = "";
            data = data+'&comment='+comment;
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/process.php",
                data: "action=blog_comment"+data,
                success: function(msg){
                    if(msg.status=='ok'){
                        var html = '<li>';
                        html = html +'<div>';
                        html = html +'<div class="divBlogCommentMain">';
                        html = html +'<img src="'+$('#my_avatar').val()+'" width="50" height="50"/>';
                        html = html +'<p>'+comment+'</p>';
                        html = html +'</div>';
                        html = html +'<div class="divBlogCommentOrther"><span><a href="javascript:;">Bình luận</a></span> <span>34 phút trước</span></div>';
                        html = html +'<div class="divPostSubCommnet">';
                        html = html +'<textarea class="commentCon" onblur="if(this.value==\'\' || this.value==\' \'){this.value=\'Bạn đang nghĩ gì?\'}" onclick="if(this.value==\'Bạn đang nghĩ gì?\'){this.value=\'\'}" >Bạn đang nghĩ gì?</textarea>';
                        html = html +'<br/><input type="button" onclick="submitComment('+msg.id+');" value="Hiển thị"/>';
                        html = html +'</div>';
                        html = html +'</div>';
                        html = html +'</li>';
                        $('#displayBlogComment').prepend(html);
                        $('#comment').val('Bạn đang nghĩ gì?');
                    }else if(msg.status=='not_login'){
                        alert('Bạn phải đăng nhập trước khi bình luận!');
                    }
                }
            });
        }
    });
    
    $('#aBlogLoadMore').click(function (){
        var last_id = $('#last_id').val();
        if(last_id!='end'){
            var mid = $('#mid').val();
            var data = "";
            data = data+'&last_id='+last_id;
            data = data+'&mid='+mid;
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/process.php",
                data: "action=load_more"+data,
                success: function(msg){
                    if(msg.status=='ok'){
                        $('#displayBlogComment').append(msg.html);
                        $('#last_id').val(msg.last_id);
                        $('.commentCon').prettyComments({
                            maxHeight: 500
                        });
                    }else if(msg.status=='end'){
                        $('#last_id').val('end');
                        $('#aBlogLoadMore').hide();
                    }
                }
            });
        }
        
    });
    
});

function submitChildComment(parent_id){
    var comment = $('#commentCon_'+parent_id).val();
    if(comment!='Bạn đang nghĩ gì?'){
        var data = "";
        data = data+'&comment='+comment;
        data = data+'&parent_id='+parent_id;
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/process.php",
            data: "action=blog_comment"+data,
            success: function(msg){
                if(msg.status=='ok'){               
                    var html = '<div class="divSubBlogComment">';
                    html = html +'<div>';
                    html = html +'<p>';
                    html = html +'<img src="'+$('#my_avatar').val()+'" width="38" height="38"/>';
                    html = html +comment;
                    html = html +'</p>';
                    html = html +'</div>';
                    html = html +'</div>';
                    $('#divListSubComment_'+parent_id).append(html);
                    $('#commentCon_'+parent_id).val('Bạn đang nghĩ gì?');
                }else if(msg.status=='not_login'){
                    alert('Bạn phải đăng nhập trước khi bình luận!');
                }
            }
        });
    }
}
