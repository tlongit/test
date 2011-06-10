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
                <ul>
                    <li>
                        <div class="col_l">Chọn ảnh:</div>
                        <div class="col_r">
                            <input type="file" id="images" />
                            <input type="hidden" id="isUploadImage" value="0"/>
                            <div id="imagesList"></div>
                        </div>
                    </li>
                    <li class="end">
                        <div class="col_l">&nbsp;</div>
                        <div class="col_r">
                            <input type="hidden" id="mid" value="<?php echo $_SESSION['client']['id'];?>"/>
                            <input type="button" id="uploadImage" value="Tải lên" style=" float:left; border:0; color:#FFF;" class="button" />
                        </div>
                    </li>

                </ul>
        </div>
        <div class="bt_mb"><span></span></div>


    </div>

</div>

<script src="/js/image.js" type="text/javascript"></script>