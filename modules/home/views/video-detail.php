<!-- Main -->
<script src="/js/detail.js" type="text/javascript"></script>
<div id="main">
    <div class="shell">
        <div id="contentVideo">
            <?php
            $rs = $video->detailVideo();
            $row = $rs['rs'];

            $config['title'] = $row['title'] . ' - ' . $config['title'];
            $config['description'] = $row['title'] . ', ' . $config['description'];
            $config['keyword'] = $row['title'] . ', ' . $config['keyword'];
            ?>
            <div style="margin-bottom: 10px;"><h2><?php echo $row['title']; ?></h2></div>
            <div class="sharelink" style="margin-bottom: 5px;">
                <div style="float:right;">
                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style ">
                        <a class="addthis_button_preferred_1"></a>
                        <a class="addthis_button_preferred_2"></a>
                        <a class="addthis_button_preferred_3"></a>
                        <a class="addthis_button_preferred_4"></a>
                        <a class="addthis_button_compact"></a>
                        <a class="addthis_counter addthis_bubble_style"></a>
                    </div>
                    <script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
                    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4dafa2855e3394ef"></script>
                    <!-- AddThis Button END -->
                </div>
                <a style="float:right; margin-right:5px;" class="linkhay" href="http://linkhay.com/submit" target="_blank">Linkhay</a>
            </div>
            <object width="640" height="385">
                <param name="movie" value="http://www.youtube.com/v/<?php echo $row['youtube_id']; ?>?fs=1&hl=en_US&version=3"></param>
                <param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param>
                <embed src="http://www.youtube.com/v/<?php echo $row['youtube_id']; ?>?fs=1&hl=en_US&version=3" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="640" height="385"></embed>
            </object>
            <div style="margin-bottom: 20px;">&nbsp;</div>
        </div>

        <?php
            if ($db->num_rows($rs['rsNewer']) || $db->num_rows($rs['rsOlder'])) {
        ?>
                <div id="sidebar">
                    <div class="post">
                        <h2>Other videos</h2>
                        <ul>
                    <?php
                    while ($rowNewer = mysql_fetch_array($rs['rsNewer'])) {
                        $rowLink = $common->getLink('video-view', $rowNewer['youtube_id']);
                    ?>
                        <li>
                            <a href="<?php echo $rowLink; ?>" title="<?php echo $rowNewer['title']; ?>"><?php echo $rowNewer['title']; ?></a>
                        </li>
                    <?php
                    }
                    ?>

                    <?php
                    while ($rsOlder = mysql_fetch_array($rs['rsOlder'])) {
                        $rowLink = $common->getLink('video-view', $rsOlder['youtube_id']);
                    ?>
                        <li>
                            <a href="<?php echo $rowLink; ?>" title="<?php echo $rsOlder['title']; ?>"><?php echo $rsOlder['title']; ?></a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>

            </div>
        </div>
        <?php
                }
        ?>
        <div class="cl">&nbsp;</div>
    </div>
</div>
<!-- End Main -->
