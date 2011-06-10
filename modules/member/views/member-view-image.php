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
        <?php
        $imageDetail = $member->viewImage();
        ?>
        <div class="title_mb_bg2">
            <div style="padding: 10px;">
                <img src="<?php echo $imageDetail['arrRs']['real_image']; ?>" width="728px"/>
            </div>
            <div id="commentContainer" style="padding: 10px;">
                <?php
                while ($row = $db->fetch_array($imageDetail['rsComment'])) {
                    echo '<div>';
                    echo $row['fullname'].': '.$row['comment'];
                    echo '</div>';
                }
                ?>
            </div>
            <div style="padding: 10px;">
                
                <div id="message_alert" style="padding: 10px;display: none;"></div>
                <div style="padding: 10px;">
                    <textarea id="comment" rows="1" cols="60"></textarea><br/>
                    <input type="hidden" id="image_id" value="<?php echo intval($_GET['image_id']);?>"/>
                    <input type="hidden" id="myFullname" value="<?php echo $_SESSION['client']['fullname'];?>"/>
                    <input id="sendComment" type="button" value="Gửi" />
                </div>
            </div>
        </div>
        <div class="bt_mb"><span></span></div>
    </div>
</div>
<script src="/js/view-image.js" type="text/javascript"></script>