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
                        <li class="current"><a href="#"><b>Gửi thư</b></a></li>
                    </ul>
                </div>
            </div>
            <div class="title_mb_top_r"></div>
        </div>
        <div class="title_mb_bg2">
            <ul>
                <li>
                    <div class="col_l">&nbsp;</div>
                    <div class="col_r">
                        <div class="error" id="message_alert">Bạn nhập email không đúng</div>
                    </div>
                </li>
                <li>
                    <div class="col_l">Người nhận (Email):</div>
                    <div class="col_r">
                        <input type="text" id="to" value="<?php echo $_POST['to']; ?>" style="width:400px;" />
                        <br />Để gửi cho nhiều người thì giữa các email là dấu “ , ”
                    </div>
                </li>
                <li>
                    <div class="col_l">Tiêu đề:</div>
                    <div class="col_r">
                        <input type="text" id="title" value="<?php echo $_POST['title']; ?>" style="width:400px;" />
                    </div>
                </li>
                <li>
                    <div class="col_l">Nội dung:</div>
                    <div class="col_r">
                        <textarea id="message" rows="6" cols="60"><?php echo $_POST['content']; ?></textarea>
                    </div>
                </li>

                <li class="end">
                    <div class="col_l">&nbsp;</div>
                    <div class="col_r"><input type="button" id="btnSendMail" value="Gửi thư" style=" float:left; border:0; color:#FFF;" class="button" /></div>
                </li>
            </ul>
        </div>
        <div class="bt_mb"><span></span></div>
    </div>
</div>

<script src="/js/send-mail.js" type="text/javascript"></script>