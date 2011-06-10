<div class="linkmain">
    <ul>
        <li><span>Bạn đang xem:</span><a href="#"><b>Trang chủ</b></a><span>&raquo;</span>&nbsp; Gửi thư</li>
    </ul>
</div>

<div class="container">
    <?php include 'member-left.php'; ?>

    <div class="member_c">
        <div class="title_mb_top">
            <div class="title_mb_top_bg2">
                <div class="tab_mem">
                    <ul class="tabs">
                        <li class="current"><a href="#"><b>Tải ảnh lên</b></a></li>
                    </ul>
                </div>
            </div>
            <div class="title_mb_top_r"></div>
        </div>

        <div class="title_mb_bg2">
            <div style="padding: 10px;">
                <?php
                $rsImage = $member->myImage();
                while ($row = $db->fetch_array($rsImage['rs'])) {
                    echo '<span id="image_id_' . $row['id'] . '" style="float:left;margin:5px;">
                                <a class="viewImage" href="thanh-vien?mid=' . $row['mid'] . '&image_id=' . $row['id'] . '&action=xemanh">
                                    <img src="' . $row['image'] . '"/>
                                </a>
                                <a href="/thanh-vien?mid='.$_GET['mid'].'&image_id='.$row['id'].'&action=chinhsuaanh" class="editImage" title="Chỉnh sửa ảnh này"></a>
                                <span onclick="javascript:removeImage(' . $row['id'] . ');" class="removeImage" title="Xóa ảnh này"></span>
                          </span>';
                }
                ?>
            </div>
        </div>
        <div class="bt_mb"><span></span></div>
        <div class="dangtin_un">
            <span class="dt_un_r">
                <?php
                $page = $rsImage['page'];
                if($page<1){
                    $page=1;
                }else{
                    $pagePre = $page-1;
                    $pageNext = $page+1;
                    if($rsImage['page']<=1){
                        $htmlPre = 'javascript:;';
                    }else{
                        $htmlPre = '/thanh-vien?mid='.$_GET['mid'].'&action=anhcuatoi&page='.$pagePre;
                    }
                    if($rsImage['page']==$rsImage['totalPage']){
                        $htmlNext = 'javascript:;';
                    }else{
                        $htmlNext = '/thanh-vien?mid='.$_GET['mid'].'&action=anhcuatoi&page='.$pageNext;
                    }
                }
                
                ?>
                <a href="<?php echo $htmlPre;?>">Trang trước</a> | <a href="<?php echo $htmlNext;?>">Trang sau</a>
            </span>
        </div>
    </div>
</div>

<script src="/js/my-image.js" type="text/javascript"></script>