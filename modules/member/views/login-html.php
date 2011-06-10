<div class="title_dk">Đăng nhập</div>
<div class="dn_left">
    <form action="" method="post">
    <div class="line_dn">
        <ul>
            <?php
            if(isset ($_POST['email'])){
            ?>
            <li>
                <div class="dn_l">&nbsp;</div>
                <div class="dn_r">
                    <span class="error">Email hoặc mật khẩu không đúng!</span>
                </div>
            </li>
            <?php
            }
            ?>
            <li>
                <div class="dn_l">Email</div>
                <div class="dn_r">
                    <input type="text" name="email" value="" style="width:200px;" />
                </div>
            </li>
            <li>
                <div class="dn_l">Mật khẩu</div>
                <div class="dn_r">
                    <input type="text" name="password" value="" style="width:200px;" /><br />
                </div>
            </li>
            <li>
                <div class="dn_l">&nbsp;</div>
                <div class="dn_r">
                    <input type="checkbox" name="remember" value="1" style="border:0;" />
                    <font>Ghi nhớ tôi</font>
                </div>
            </li>
            <li>
                <div class="dn_l">&nbsp;</div>
                <div class="dn_r">
                    <input type="submit" name="" value="Đăng nhập" style="border:0; float:left; color:#FFF;" class="button" />
                    <font class="link"><a href="#">Quên mật khẩu ?</a></font>
                </div>
            </li>
        </ul>
    </div>
</form>
</div>
<div class="dn_right">
    <span class="note">
	Nếu bạn chưa có tài khoản ?<br />
        <a href="/dang-ky"><input type="button" name="" value="Đăng ký mới" class="button" /></a>
    </span>
</div>