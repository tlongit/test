<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Olo2 - Home</title>
        <?php include 'js-css.php';?>
    </head>

    <body>
        <div class="page">
            <div class="header">
                <div id="logo"><a href="#"><img src="/images/logo.png" /></a></div>
                <div class="header_r_top">
                    <span><a href="/thanh-vien?mid=<?php echo $_SESSION['client']['id'];?>"><b>“Olo của tôi”</b></a>  |  <a href="/dang-ky">Đăng ký</a>  or  <a href="/dang-nhap">Đăng nhập</a> <a href="/thanh-vien?action=thoat">Thoát</a></span>
                </div>
                <div class="bgmenu">
                    <div class="bgmenu_l"></div>
                    <div class="bgmenu_bg">
                        <div id="nav">
                            <ul class="current"><li><a href="#"><b>Trang chủ</b></a></li></ul>
                            <ul class="sub_active">
                                <li><a href="#">Nhà ở, đất ở </a><font>l</font></li>
                                <li><a href="#">Nhà chung cư</a><font>l</font></li>
                                <li><a href="#">Nhà tập thể</a><font>l</font></li>
                                <li><a href="#">Đất biệt thự, Phân lô</a><font>l</font></li>

                                <li><a href="#">Khác</a></li>
                            </ul>

                            <ul class="select"><li><a href="#"><b>Blog</b>
                            <!--[if IE 7]><!--></a><!--<![endif]--><!--[if lte IE 6]><table><tr><td><![endif]-->
                                    <ul class="sub">
                                        <li><a href="#">Nhà ở, đất ở </a><font>l</font></li>
                                        <li><a href="#">Nhà chung cư</a><font>l</font></li>
                                        <li><a href="#">Nhà tập thể</a><font>l</font></li>
                                        <li><a href="#">Đất biệt thự, Phân lô</a><font>l</font></li>

                                        <li><a href="#">Khác</a></li>
                                    </ul>
                                    <!--[if lte IE 6]></td></tr></table></a><![endif]--></li></ul>


                            <ul class="select"><li><a href=""><b>Ảnh</b>
                                    <!--[if IE 7]><!--></a><!--<![endif]--><!--[if lte IE 6]><table><tr><td><![endif]-->
                                    <ul class="sub">
                                        <li><a href="#">Nhà ở, đất ở </a><font>l</font></li>
                                        <li><a href="#">Nhà chung cư</a><font>l</font></li>
                                        <li><a href="#">Nhà tập thể</a><font>l</font></li>

                                        <li><a href="#">Khác</a></li>
                                    </ul>

                                    <!--[if lte IE 6]></td></tr></table></a><![endif]--></li></ul>

                        </div>

                        <div class="boxsearch">
                            <div class="boxsearch_l"></div>
                            <div class="boxsearch_bg">
                                <div class="bginput">
                                    <input type="text" name="" value="cho thuê căn hộ" style="width:90%;" />
                                </div>
                                <div class="dmsc">
                                    <div id="contactLink"><font>l</font> Lựa chọn</div>
                                    <div id="contactForm" style="display:none;">
                                        <fieldset>
                                            <iframe id="menu4iframe" src="javascript:'';" marginwidth="0" marginheight="0" align="bottom" scrolling="no" frameborder="0" style="position:absolute; left:0; top:0px; display:block; filter:alpha(opacity=0);" ></iframe>
                                            <span id="messageSent">
                                                <span><img src="/images/arrow.gif" /><a href="#">Cần bán</a></span>
                                                <span><img src="/images/arrow.gif" /><a href="#">Cần mua</a></span>
                                                <span><img src="/images/arrow.gif" /><a href="#">Cho thuê</a></span>
                                                <span><img src="/images/arrow.gif" /><a href="#">Cần thuê</a>
                                                    <br style="clear:both;" />
                                                </span>
                                            </span>
                                        </fieldset>
                                    </div>

                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="bgmenu_r">
                        <input type="image" name="" value="" src="/images/menu_r.gif" />
                    </div>
                </div>
            </div>