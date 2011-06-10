<div class="linkmain">
    <ul>
        <li><span>Bạn đang xem:</span><a href="#"><b>Trang chủ</b></a><span>&raquo;</span><a href="#">Olo của tôi</a><span>&raquo;</span>quangpv</li>
    </ul>
</div>

<div class="container">
    <?php include 'member-left.php'; ?>

    <div class="member_c">
        <div class="title_mb_top">
            <div class="title_mb_top_bg2">
                <div class="tab_mem">
                    <ul class="tabs">
                        <li class="current"><a href="#"><b>Hộp thư đến</b></a></li>
                    </ul>
                </div>
            </div>
            <div class="title_mb_top_r"></div>
        </div>
        <?php
        $arrInbox = $member->mailInbox();
        ?>
        <div class="title_mb_bg3">
            <ul>
                <li class="top">
                    <div class="col1"><input type="checkbox" name="" value="" /></div>
                    <div class="col2"><a href="#">Xóa các thư đã chọn</a></div>
                    <div class="col3">Người gửi</div>
                    <div class="col4">Thời gian</div>
                </li>
                <?php
                $i = 0;
                foreach ($arrInbox as $key => $row) {
                    $i++;
                    ?>
                    <li<?php echo $i == count($arrInbox) ? ' class="end"' : '' ?>>
                        <div class="col1"><input type="checkbox" name="" value="<?php echo $row['id']; ?>" /></div>
                        <div class="col2 unread"><a class="clickShowMail" href="javascript:;" title="Đọc thư"><?php echo $row['title']; ?></a></div>
                        <div class="col3"><?php echo $row['sender']['fullname']; ?></div>
                        <div class="col4"><?php echo date('d/m H:i', strtotime($row['create_date'])); ?></div>
                        <div class="mailContent"><?php echo $row['content']; ?></div>
                    </li>
                    <?php
                }
                ?>


            </ul>
        </div>
        <div class="bt_mb"><span></span></div>

        <div class="dangtin_un">
            <span class="dt_un_r">
                <a href="#">Trang trước</a> | <a href="#">Trang sau</a>
            </span>
        </div>

    </div>

</div>

<script src="/js/inbox.js" type="text/javascript"></script>