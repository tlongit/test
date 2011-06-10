<!-- Main -->
<script src="/js/detail.js" type="text/javascript"></script>
<div id="main">
    <div class="shell">
        <div id="contentVideo">

            <?php
            $listVideo = $video->listVideo();
            $i = 0;
            while ($row = mysql_fetch_array($listVideo['rs'])) {
                $rowLink = $common->getLink('video-view', $row['youtube_id']);
                $i++;
                if ($i == 1) {
            ?>
                    <div style="margin-bottom: 5px;"><h3><a href="<?php echo $rowLink; ?>" title="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></a></h3></div>
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
            <?php
                } else {
            ?>
                    <div class="colVideo">
                        <div class="videoThumb">
                            <a href="<?php echo $rowLink; ?>" title="How to get a woman to... - Funny Animation"><img width="120px" src="http://img.youtube.com/vi/<?php echo $row['youtube_id']; ?>/2.jpg"></a>
                        </div>
                        <div class="post">
                            <h3><a href="<?php echo $rowLink; ?>" title="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></a></h3>
                            <p>
                        <?php echo $row['create_date']; ?>
                    </p>
                    <div class="cl">&nbsp;</div>
                </div>
            </div>
            <?php
                    }
                }
                if ($listVideo["totalPage"] > 1) {
                    echo $common->paging($listVideo["page"], $listVideo["totalPage"], 'video-page');
                }
            ?>
            </div>

            <div id="sidebar">
                <div class="post">
                    <h2>Adv</h2>
                    <ul>
                        <li>
                            <div class="linkExchange">
                                <a href="http://www.nflgambling.us" target="_blank">National footballeague</a>
                                <!--http://www.backlink-exchanges.com/-->
                            </div>
                        </li>
                        <li style="display:none">
                            <div class="linkExchange">
                                <a href="http://www.linkok.com/">link exchanges - Free Link Exchanges Submit</a>
                            </div>
                        </li>
                        <li style="display:none">
                            <div class="linkExchange">
                                <a href="http://www.link-exchange-submit.com/">Reciprocal Link Exchange</a> Free Reciprocal Links
                            </div>
                        </li>
                        <li style="display:none">
                            <div class="linkExchange">
                                <span style="display:inline-block;width:160px;height:30px;text-align:center;border:#000 1px dotted;font-family:Arial,Helvetica,sans-serif;font-size:11px;background-color:#FFFFFF;"><strong style="display:block;padding:0px;margin:0px;">Reputation Management</strong><a href="http://www.submitexpress.com/" title="Submit Express - Search Engine Optimization Services" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;">Submit Express</a></span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        <?php
                //$hot = $article->listHotArticle();
                if ($db->num_rows($hot)) {
        ?>
                    <div id="sidebar">
                        <div class="post">
                            <h2>Hot articles</h2>
                            <ul>
                    <?php
                    while ($row = mysql_fetch_array($hot)) {
                        $rowLink = $common->getLink('view', $row['title_link']);
                    ?>
                        <li>
                            <a href="<?php echo $rowLink; ?>" title="<?php echo $row['title']; ?>"><?php echo $row['title']; ?></a>
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
