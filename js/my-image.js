$(document).ready(function(){
    /*
    $("a.viewImage").fancybox({
        'overlayShow'	: false,
        'transitionIn'	: 'elastic',
        'transitionOut'	: 'elastic'
    });
    */
    });

function editImage(mid,image_id){
    window.location = "/thanh-vien?mid="+mid+"&image_id="+image_id+"&action=chinhsuaanh"
}
function removeImage(image_id){
    if (confirm("Bạn có chắc muốn xóa ảnh này không?")) {
        $.ajax({
            type: "POST",
            url: "/process.php",
            data: "action=delete_image&image_id="+image_id,
            success: function(msg){
                if(msg=='ok'){
                    $('#image_id_'+image_id).remove();
                }
            }
        });
    }
}
