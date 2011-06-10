<div class="linkmain">
    <ul>
        <li><span>Bạn đang xem:</span><a href="#"><b>Trang chủ</b></a><span>&raquo;</span><a href="#">Olo của tôi</a><span>&raquo;</span><?php echo $_SESSION['client']['fullname']; ?></li>
    </ul>
</div>

<div class="container">
    <?php include 'member-left.php'; ?>
    <?php
    $profile = $member->profile();
    ?>
    <div class="member_c">
        <div class="title_mb_top">
            <div class="title_mb_top_bg2">
                <div class="tab_mem">
                    <ul class="tabs">
                        <li class="current"><a href="#"><b>Thông tin cá nhân</b></a></li>
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
                    <div class="col_l">Ảnh đại diện</div>
                    <div class="col_r">
                        <span style="float: left; width: 100%">
                            <a href="javascript:;" onclick="createAvatarWindow();">
                                Sửa ảnh
                            </a>
                        </span>
                        <span style="float: left;">
                            <img id="avatar" src="<?php echo $profile['profile']['avatar']; ?>" width="58" height="58"/>
                        </span>
                        <span style="float: left;margin-left: 20px;">
                            <input type="hidden" id="mid" value="<?php echo $_SESSION['client']['id']; ?>"/>
                            <input type="file" id="avatarUpload" />
                        </span>
                        <div id="cropbox_div_container" style="width: 520px;">
                            <img src="<?php echo str_replace('a-', '', $profile['profile']['avatar']); ?>" id="cropbox"/>
                            <input type="hidden" id="reloadAvatarCrop" value="0" />
                            <input type="hidden" id="x" name="x" />
                            <input type="hidden" id="y" name="y" />
                            <input type="hidden" id="w" name="w" />
                            <input type="hidden" id="h" name="h" />
                            <input type="button" id="btnCreateAvatar" value="Tạo ảnh" class="button" style="border:0; color:#FFF;margin-top: 5px;"/>
                        </div>

                    </div>
                </li>
                <li>
                    <div class="col_l">Họ tên</div>
                    <div class="col_r"><input type="text" id="fullname" value="<?php echo $profile['profile']['fullname']; ?>" style="width:300px;" /></div>
                </li>
                <li>
                    <div class="col_l">Email</div>
                    <div class="col_r"><?php echo $profile['profile']['email']; ?></div>
                </li>
                <li>
                    <div class="col_l">Tỉnh/Thành phố</div>
                    <div class="col_r">
                        <?php
                        $city = $geo->getCity();
                        ?>
                        <select id="city" name="city" style="width: 200px;">
                            <option value="0">Chọn tỉnh/tp của bạn...</option>
                            <?php
                            while ($row = $db->fetch_array($city)) {
                                if($row['id']==$profile['profile']['city_id']){
                                    echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                }else{
                                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                }
                                
                            }
                            ?>
                        </select>
                    </div>
                </li>
                <li>
                    <div class="col_l">Quận/Huyện</div>
                    <div class="col_r">
                        <select id="district" name="district" style="width: 200px;">
                            <option value="0">Chọn quận/huyện của bạn...</option>
                            <?php
                            while ($row = $db->fetch_array($profile['rsDistricts'])) {
                                if($row['id']==$profile['profile']['geo_id']){
                                    echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                }else{
                                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </li>
                <li>
                    <div class="col_l">Bản đồ</div>
                    <div class="col_r">
                        <a href="javascript:;" onclick="createMapWindow();">Ẩn/Hiện bản đồ</a>
                    </div>
                    <div id="anHienBanDo">

                        <div style="margin: 5px 0;">
                            Tìm địa danh: <input type="text"  id="txtSearchMap" onkeydown="if (event.keyCode == 13){getByAddress($(this).val())}" value="" style="width:250px;" />
                            <span>Hãy tìm vị trí chính xác nhà bạn từ vệ tinh!</span>
                            <br/>
                            <input type="button" value="Lưu vị trí" class="button" id="saveMap" onclick="setMapProfile();" style="border:0; color:#FFF;float: right;"/>
                            <span id="displayAddress"></span>
                        </div>

                        <input type="hidden" id="mapLatLonTemp" name="map" value="0"/>
                        <input type="hidden" id="mapLatLon" name="map" value="0"/>
                        <div id="mapDisplayArea" style="width:100%; height:500px;float:left;"></div>
                    </div>

                </li>


                <li class="end">
                    <div class="col_l">&nbsp;</div>
                    <div class="col_r"><input type="button" id="saveProfile" value="Lưu thay đổi" style=" float:left; border:0; color:#FFF;" class="button" /><span class="link">hoặc  <a href="#">Hủy</a></span></div>
                </li>

            </ul>
        </div>

        <div class="bt_mb"><span></span></div>



    </div>

</div>

<script src="/js/profile.js" type="text/javascript"></script>