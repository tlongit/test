$(document).ready(function(){
    
    if($('#images').length>0){
        $('#images').uploadify({
            'uploader'  : '/js/uploadify/uploadify.swf',
            'script'    : '/js/uploadify/image.php',
            'cancelImg' : '/js/uploadify/cancel.png',
            'buttonImg' : '/js/uploadify/btnupload.gif',
            'fileExt'   : '*.jpg;*.gif;*.png',
            'multi'     : true,
            'queueSizeLimit' : 10,
            'auto'      : false,
            'removeCompleted' : true,
            'width'      : 95,
            'height'     : 23,
            'queueID'    : 'imagesList',
            'scriptData'  : {'upload_type':'images'},
            'onSelect' : function(event,ID,fileObj,data) {
                if(fileObj.name!='' && $('#isUploadImage').val()!=1){
                    $('#isUploadImage').val("1");
                }
            },
            'onCancel': function(event,ID,fileObj,data) {
                if(data.fileCount==0){
                    $('#isUploadImage').val("0");
                }
            },
            'onAllComplete' : function(event,data) {
                //location.reload(true);
            }
        });
    }

    $('#uploadImage').click(function(){
        if($('#isUploadImage').val()==1){
            $('#images').uploadifySettings('scriptData',{
                        'mid':$("#mid").val()
                    });
            $('#images').uploadifyUpload();
        }else{
            alert("Bạn chưa chọn ảnh để tải lên!");
        }
        
    });
    
});