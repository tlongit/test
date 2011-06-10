<div class="linkmain">
    <ul>
        <li><span>Bạn đang xem:</span><a href="#"><b>Trang chủ</b></a><span>&raquo;</span><a href="#">Olo của tôi</a><span>&raquo;</span>quangpv</li>
    </ul>
</div>

<div class="container">
    <?php include 'member-left.php'; ?>

    <div class="member_c">



        <script src="/js/tabs.js" type="text/javascript"></script>
        <div class="tab">
            <div class="tab-sub">
                <ul class="idTabs">
                    <li><a rel="status" class="share_tab status selected" href="#tab1" id="share-status"><b><span class="icon01 ico51 inline-block">&nbsp;</span>Trạng thái</b></a></li>
                    
                    <li><a rel="uplink" class="share_tab uplink" href="#tab2" id="share-link"><b><span class="icon01 ico31 inline-block">&nbsp;</span>Liên kết</b></a></li>
                    <li><a rel="music" class="share_tab video" href="#tab3" id="share-photo"><b><span class="icon01 ico33 inline-block">&nbsp;</span>Nhạc/Video</b></a></li>
                    <li><a target="_parent" href=""><b><span class="icon01 ico32 inline-block">&nbsp;</span>Bài viết</b></a></li>
                </ul>
                <div class="clear"></div>
            </div>

            <div class="tab-content">
                <form name="shareform" enctype="multipart/form-data" method="post" action="#">
                    <input type="hidden" value="1" id="hcurrentmodule" name="hcurrentmodule">
                    <input type="hidden" value="4" id="hfk" name="hfk">
                    <input type="hidden" value="1" id="hfkt" name="hfkt">
                    <input type="hidden" value="index" id="hcurrentaction" name="hcurrentaction">
                    <input type="hidden" value="status" id="blastType" name="blastType">
                    <input type="hidden" value="Nhận xét về liên kết này" id="blastValue" name="blastValue">

                    <div class="tab-content-main">
                        <!--Tab1-->
                        <div style="display: block;" id="tab1">
                            <div class="innerTab">
                                <div class="arrow-top"></div>
                                <div class="clear"></div>

 <input type="hidden" id="my_avatar" value="<?php echo $_SESSION['client']['avatar']; ?>"/>
                                <textarea id="comment" onblur="if(this.value=='' || this.value==' '){this.value='Bạn đang nghĩ gì?'}" onclick="if(this.value=='Bạn đang nghĩ gì?'){this.value=''}" >Bạn đang nghĩ gì?</textarea>

                                <span >
                                    <input type="button" class="btnBlogComment" id="btnBlogComment" value="Chia sẻ"/>
                                </span>
                                

                            </div>
                        </div>
                        <!--Tab2-->
                        <div style="display:none;" id="tab2">
                            <div class="innerTab">
                                <div class="arrow-top"></div>
                                <div class="clear"></div>
                                  <div id="usharelinkform" class="sub-section infosubsection" style="display: block;">
                                <div class="sub-section-main"  style="margin-bottom: 10px">
                                    <ul>
                                        <li class="label">
                                            <h3>Liên kết:</h3>
                                        </li>
                                        <li>
                                            <input type="text" id="postlink" class="general w255" name="lienket" style="color: rgb(51, 51, 51);">&nbsp;&nbsp;
                                        </li>
                                    </ul>
                                    <div class="btn-left-05">
                                        <input type="button" id="attach_link" name="chiase" value="Duyệt" class="button btn-right-05">
                                    </div>

                                    <div class="clear"></div>


                                </div>
                                         <input type="hidden" id="my_avatar" value="<?php echo $_SESSION['client']['avatar']; ?>"/>
                                <textarea id="comment" onblur="if(this.value=='' || this.value==' '){this.value='Mô tả cho liên kêt này'}" onclick="if(this.value=='Mô tả cho liên kêt này'){this.value=''}" >Mô tả cho liên kêt này</textarea>

                                <span >
                                    <input type="button" class="btnBlogComment" id="btnBlogComment" value="Chia sẻ"/>
                                     </span>
                            </div>
                            </div>
                        </div>
                        <!--Tab3-->
                        <div style="display: none;" id="tab3">
                            <div class="innerTab">
                                <div class="arrow-top"></div>
                                <div class="clear"></div>
                                    <div id="usharelinkform" class="sub-section infosubsection" style="display: block;">
                                <div class="sub-section-main"  style="margin-bottom: 10px">
                                    <ul>
                                        <li class="label">
                                            <h3>Mã nhúng/liên kết:</h3>
                                        </li>
                                        <li>
                                            <textarea id="postlink" class="general w255" name="lienket" style="height: 50px" ></textarea>
                                        </li>
                                    </ul>
                                    <div class="btn-left-05">
                                        <input type="button" id="attach_link" name="chiase" value="Duyệt" class="button btn-right-05">
                                    </div>

                                    <div class="clear"></div>
                                    
                               
                                </div>
                                         <input type="hidden" id="my_avatar" value="<?php echo $_SESSION['client']['avatar']; ?>"/>
                                <textarea id="comment" onblur="if(this.value=='' || this.value==' '){this.value='Mô tả cho file này'}" onclick="if(this.value=='Mô tả cho liên kêt này'){this.value=''}" >Mô tả cho liên kêt này</textarea>

                                <span >
                                    <input type="button" class="btnBlogComment" id="btnBlogComment" value="Chia sẻ"/>
                                     </span>
                            </div>
                            </div>
                        </div>
                        
                     
                    </div>

                </form>
            </div>
        </div>
        <div class="listnews">


            <?php
            $listComment = $blog->listComment(1);

            if ($listComment['rs']) {
            ?>
                <ul id="displayBlogComment">
                <?php
                while ($row = $db->fetch_array($listComment['rs'])) {
                    $last_id = $row['id'];
                    $member_info = $member->getById(intval($row['mid']));
                    $listChildComment = $blog->listChildComment($row['id']);
                ?>
                    <li>
                        <div>
                            <div class="divBlogCommentMain">
                                <img src="<?php echo $member_info['avatar']; ?>" width="50" height="50"/>
                                <span style="float:left">
                                <p style="width: 475px"><?php echo $row['content']; ?></p>
                                <span class="right"><a onclick="stream.remove('809220','101','1272060847');return false;" href="javascript:;"><img width="1" height="1" class="icon01 ico18-img delete" alt="" src="http://banbecdn.net/images/graphics/blank_img.gif" ></a></span>
                                <div class="clear"></div>
                                <p><?php echo $date_fomat->diff(strtotime($row['create_date'])); ?> <span><a href="javascript:;">Bình luận</a></span> </p>
                                </span>
                            </div>
                           
                        <?php
                        if (!$listChildComment['rs']) {
                        ?>
                            <div class="divPostSubCommnet">
                                <textarea id="commentCon_<?php echo $row['id']; ?>" class="commentCon" onblur="if(this.value=='' || this.value==' '){this.value='Bạn đang nghĩ gì?'}" onclick="if(this.value=='Bạn đang nghĩ gì?'){this.value=''}" >Bạn đang nghĩ gì?</textarea>
                                <input class="btnBlogComment" type="button" onclick="submitChildComment(<?php echo $row['id']; ?>);" value="Chia sẻ"/>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <?php
                        if ($listChildComment['rs']) {
                    ?>
                            <div id="divListSubComment_<?php echo $row['id']; ?>">
                        <?php
                            while ($rowChild = $db->fetch_array($listChildComment['rs'])) {
                                $memberChildInfo = $member->getById(intval($rowChild['mid']));
                        ?>
                                <div class="divSubBlogComment highlight">

                                    <img src="<?php echo $memberChildInfo['avatar']; ?>" width="32" height="32"/>
                            <?php echo $rowChild['content']; ?>

                            </div>
                        <?php
                            }
                        ?>
                            <div class="divSubBlogComment highlight">
                                <textarea id="commentCon_<?php echo $row['id']; ?>" class="commentCon" onblur="if(this.value=='' || this.value==' '){this.value='Bạn đang nghĩ gì?'}" onclick="if(this.value=='Bạn đang nghĩ gì?'){this.value=''}" >Bạn đang nghĩ gì?</textarea>
                                <span >
                                <input type="button" class="btnBlogComment" onclick="submitChildComment(<?php echo $row['id']; ?>);" value="Bình luận"/>
                                </span>
                            </div>    
                        </div>


                    <?php
                        }
                    ?>
                    </li>
                <?php
                    }
                ?>

                </ul>
            <?php
                }
            ?>
                <input type="hidden" id="last_id" value="<?php echo $last_id; ?>"/>
                <input type="hidden" id="mid" value="<?php echo intval($_GET['mid']); ?>"/>
            <div style="float: left; padding: 10px; width: 100%;"><a href="javascript:;" id="aBlogLoadMore">Xem thêm</a></div>
        </div>


    </div>

</div>
<script src="/js/home.js" type="text/javascript"></script>