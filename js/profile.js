var jcrop_api;
function set_avatar_wh(coords){
    if (parseInt(coords.w) > 0)    {
        $('#x').val(coords.x);
        $('#y').val(coords.y);
        $('#w').val(coords.w);
        $('#h').val(coords.h);
    }
}

function checkCrop(){
    if (parseInt($('#w').val())){ 
        return true;
    }else{
        alert('Bạn hãy chọn một vùng để tạo avatar!');
        return false;
    }
    
};

function createAvatarWindow(){
    $('#cropbox_div_container').dialog({
        width:625,
        title:"Tạo ảnh đại diện",
        open: function(event, ui) {
            if($('#reloadAvatarCrop').val()=="1"){
                jcrop_api.destroy();
                $('#cropbox').attr('src', $('#avatar').attr('src').replace("a-", "")+"?time=" + new Date().getTime());
                jcrop_api = $.Jcrop('#cropbox',{
                    onChange: set_avatar_wh,
                    onSelect: set_avatar_wh,
                    aspectRatio: 1,
                    boxWidth: 600
                });
                $('#reloadAvatarCrop').val("0");
            }
        }
    });
}
function createMapWindow(){
    $('#anHienBanDo').dialog({
        width:800,
        title:"Chọn ví trí chính xác từ bản đồ",
        height:610,
        open: function(event, ui) {
            if($("#city option:selected").val()!="0"){
                //load map
                if(typeof(map)=='undefined'){
                    map_initialize();
                }
                if($("#city option:selected").val()!="0"){
                    getByAddress($("#city option:selected").text()+", Vietnam");
                }else{
                    getByAddress("Ha noi, Vietnam");
                }
            }else{
                if(typeof(map)=='undefined'){
                    map_initialize();
                }
                getByAddress("Ha noi, Vietnam");
            }
        }
    });
}

function setMapProfile(){
    $("#mapLatLon").val($("#mapLatLonTemp").val());
    $("#anHienBanDo").dialog('close');
}
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
$(document).ready(function(){
    jcrop_api = $.Jcrop('#cropbox',{
        onChange: set_avatar_wh,
        onSelect: set_avatar_wh,
        aspectRatio: 1,
        boxWidth: 600
    });
    $('#cropbox_div_container').hide();

    $('#saveProfile').click(function(){
        var data = "";
        var fullname = $("#fullname").val();
        var city = $("#city").val();
        var district = $("#district").val();
        var mapLatLon = $("#mapLatLon").val();
        var mapAddress = $("#displayAddress").html();
        data = data+"&fullname="+fullname;
        data = data+"&city="+city;
        data = data+"&district="+district;
        data = data+"&mapLatLon="+mapLatLon;
        data = data+"&mapAddress="+mapAddress;
        $.ajax({
            type: "POST",
            url: "/process.php",
            data: "action=save_profile"+data,
            success: function(msg){
                if(msg=='fullname_empty'){
                    showMessageError('Bạn chưa nhập họ tên!');
                }
                if(msg=='error_district'){
                    showMessageError('Bạn chưa chọn quận/huyện!');
                }
                if(msg=='ok'){
                    showMessageSuccess("Cập nhật thông tin cá nhân thành công!");
                }
            }
        });
    });
    
    
    $('#btnCreateAvatar').click(function(){
        if(checkCrop()){
            var data = "";
            var x = $("#x").val();
            var y = $("#y").val();
            var w = $("#w").val();
            var h = $("#h").val();
            data = data+"&x="+x;
            data = data+"&y="+y;
            data = data+"&w="+w;
            data = data+"&h="+h;
            $.ajax({
                type: "POST",
                url: "/process.php",
                data: "action=create_avatar"+data,
                success: function(avatar){
                    $("#avatar").attr("src", avatar +"?time"+ new Date().getTime());
                    $('#cropbox_div_container').dialog('close');
                    $("#x").val('');
                    $("#y").val('');
                    $("#w").val('');
                    $("#h").val('');
                }
            });
        }
        
    });
    
    if($('#avatarUpload').length>0){
        $('#avatarUpload').uploadify({
            'uploader'  : '/js/uploadify/uploadify.swf',
            'script'    : '/js/uploadify/avatar.php',
            'cancelImg' : '/js/uploadify/cancel.png',
            'buttonImg' : '/js/uploadify/btnupload.gif',
            'fileExt'   : '*.jpg;*.gif;*.png',
            'multi'     : false,
            'auto'      : true,
            'removeCompleted' : true,
            'width'      : 95,
            'height'     : 23,
            'scriptData'  : {
                'upload_type':'avatar',
                'mid':$('#mid').val()
            },
            'onAllComplete' : function(event,data) {
                $.ajax({
                    type: "POST",
                    url: "/process.php",
                    data: "action=get_member_avatar&mid="+$('#mid').val(),
                    success: function(avatar){
                        $('#avatar').attr('src', avatar);
                        $('#reloadAvatarCrop').val("1");
                        
                    }
                });
                
            }
        });
    }
    if($('#city').length>0){
        $('#city').change(function(){
            $.ajax({
                type: "POST",
                url: "/process.php",
                data: "action=get_district&city_id="+$(this).val(),
                success: function(options){
                    $('#district').html(options);
                    
                }
            });
        });
    }
    
    
    
    setTimeout('$("#anHienBanDo").hide()',500);
    
    $("#saveMap").click(function(){
        $('#box-map').css('display','none');
        $('#fade').css('display','none');
        $('#upload_pid').show();
        $('#upload_did').show();
        $('#mode_price').show();
        $('#upload_cid').show();
        $('#upload_sub_cid').show();
	
        $("#imgClearSavedMap").css('display', '');
        //$('#showMapPopup').click();
        $('#box-map').css('display','none');
        $('#fade').css('display','none');
	       
        //save position: latlng, address       
        $('#txtTempLatLng').val($('#txtMapLatLng').val());
        //alert($('#txtTempLatLng').val());
        $('#txtTempAddress').val($('#txtMapAddress').val());       
        $('#displayAddress').html($('#txtMapAddress').val());
        $('#txtAddress').val('ÄÆ°á»ng/Phá» PhÆ°á»ng, Quáº­n/Huyá»n, Tá»nh/TP');
        return false;
    });
    
});

