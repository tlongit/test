<div class="member_l">
    <div class="member_top">
        <div class="member_top_l"></div>
        <div class="member_top_bg">Quản lý cá nhân</div>
        <div class="member_top_r"></div>
    </div>
    <div class="mb_l_bg">
        <ul>
            <li class="top<?php echo $_GET['action']=='guithu'?' active':'';?>">
                <a href="/thanh-vien?mid=<?php echo $_SESSION['client']['id'];?>&action=guithu"><span></span>Gửi thư</a>
            </li>
            <li<?php echo $_GET['action']=='hopthu'?' class="active"':'';?>>
                <a href="/thanh-vien?mid=<?php echo $_SESSION['client']['id'];?>&action=hopthu"><span></span>Hộp thư</a></span>
            </li>
            <li<?php echo $_GET['action']=='thudagui'?' class="active"':'';?>>
                <a href="/thanh-vien?mid=<?php echo $_SESSION['client']['id'];?>&action=thudagui"><span></span>Thư đã gửi</a></span>
            </li>
            <li<?php echo $_GET['action']=='thongtincanhan'?' class="active"':'';?>>
               <a href="/thanh-vien?mid=<?php echo $_SESSION['client']['id'];?>&action=thongtincanhan"><span></span>Thông tin cá nhân</a></span>
            </li>
            <li<?php echo $_GET['action']=='doimatkhau'?' class="active"':'';?>>
                <a href="/thanh-vien?mid=<?php echo $_SESSION['client']['id'];?>&action=doimatkhau"><span></span>Đổi mật khẩu</a></span>
            </li>
            <li<?php echo $_GET['action']=='taianhlen'?' class="active"':'';?>>
               <a href="/thanh-vien?mid=<?php echo $_SESSION['client']['id'];?>&action=taianhlen"><span></span>Tải ảnh lên</a></span>
            </li>
            <li<?php echo $_GET['action']=='anhcuatoi'?' class="active"':'';?>>
               <a href="/thanh-vien?mid=<?php echo $_SESSION['client']['id'];?>&action=anhcuatoi"><span></span>Ảnh của tôi</a></span>
            </li>
        </ul>
    </div>
    <div class="mb_l_bt"><span></span></div>
</div>