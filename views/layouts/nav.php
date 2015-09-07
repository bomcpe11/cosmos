<div id="nav-wrapper">
    <ul id="nav"
        data-ng-controller="NavCtrl"
        data-collapse-nav
        data-slim-scroll
        data-highlight-active>
        <li><a href="#"> <i class="fa fa-dashboard"><span class="icon-bg bg-danger"></span></i><span data-i18n="Dashboard">Dashboard</span></a></li>
        <li>
            <a href="#"><i class="fa fa-magic"><span class="icon-bg bg-orange"></span></i><span data-i18n="UI Kit">ผู้ดูแลระบบ</span></a>
            <ul>
                <li><a href="<?= \yii\helpers\Url::to(['/user/admin/create']) ?>"><i class="fa fa-caret-right"></i><span data-i18n="Buttons">สร้าง User</span></a></li>
            </ul>
        </li>
        <li>
            <a href="#/table"><i class="fa fa-table"><span class="icon-bg bg-warning"></span></i><span data-i18n="Tables">กองทุนสิ่งแวดล้อม</span></a>
            <ul>
                <li><a href="<?= \yii\helpers\Url::to(['/project/index']) ?>"><i class="fa fa-caret-right"></i><span data-i18n="Static Tables">บันทึก</span></a></li>
            </ul>
        </li>
        
    </ul>
</div>