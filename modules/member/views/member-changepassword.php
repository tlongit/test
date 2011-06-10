<div class="linkmain">
    <ul>
        <li><span>Bạn đang xem:</span><a href="#"><b>Trang chủ</b></a><span>&raquo;</span>&nbsp; Blog</li>
    </ul>
</div>

<div class="container">
    <?php include 'member-left.php'; ?>

    <div class="member_c">
        <div class="title_mb_top">
            <div class="title_mb_top_bg2">
                <div class="tab_mem">
                    <ul class="tabs">
                        <li class="current"><a href="#"><b>Đổi mật khẩu</b></a></li>
                    </ul>
                </div>
            </div>
            <div class="title_mb_top_r"></div>
        </div>
        <form action="" memethod="post">
            <div class="title_mb_bg2">
                <ul>
                    <li>
                        <div class="col_l">&nbsp;</div>
                        <div class="col_r">
                            <div id="message_alert" class="error" style="display: none;">Bạn chưa nhập họ tên!</div>
                        </div>
                    </li>
                    <li>
                        <div class="col_l">Mật khẩu cũ:</div>
                        <div class="col_r">
                            <input type="text" id="oldPassword" value="" style="width:400px;" />
                        </div>
                    </li>
                    <li>
                        <div class="col_l">Mật khẩu mới:</div>
                        <div class="col_r">
                            <input type="text" id="newPassword" value="" style="width:400px;" />
                        </div>
                    </li>
                    <li>
                        <div class="col_l">Gõ lại mật khẩu mới:</div>
                        <div class="col_r">
                            <input type="text" id="rePassword" value="" style="width:400px;" />
                        </div>
                    </li>

                    <li class="end">
                        <div class="col_l">&nbsp;</div>
                        <div class="col_r"><input type="button" id="btnChangePassword" value="Đổi mật khẩu" style=" float:left; border:0; color:#FFF;" class="button" /></div>
                    </li>

                </ul>
            </div>
        </form>
        <div class="bt_mb"><span></span></div>


    </div>

</div>

<script src="/js/change-password.js" type="text/javascript"></script>