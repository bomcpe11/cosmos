<?php
use yii\bootstrap\Nav;

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?php /*Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    '<li class="header">Menu Yii2</li>',
                    ['label' => '<i class="fa fa-file-code-o"></i><span>Gii</span>', 'url' => ['/gii']],
                    ['label' => '<i class="fa fa-dashboard"></i><span>Debug</span>', 'url' => ['/debug']],
                    [
                        'label' => '<i class="glyphicon glyphicon-lock"></i><span>Sing in</span>', //for basic
                        'url' => ['/site/login'],
                        'visible' =>Yii::$app->user->isGuest
                    ],
                ],
            ]
        ); */
        ?>

        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>ตารางรหัส</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= \yii\helpers\Url::to(['/clnsport']) ?>"> CLN0I010 บันทึกชนิดกีฬา</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/clnboundaryinj']) ?>"> CLN0I020 บันทึกบริเวณที่บาดเจ็บ</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/clncauseinj']) ?>"> CLN0I030 บันทึกสาเหตุการบาดเจ็บ</a>
                    </li>
                    <li><a href="#"> CLN0I040 บันทึกวิธีการรักษา</a>
                    </li>
                    <li><a href="#"> CLN0I050 บันทึกคำนำหน้านาม</a>
                    </li>
                    <li><a href="#"> CLN0I060 บันทึกเวลามาตรฐานการให้บริการ</a>
                    </li>
                    <!-- 
                    <li><a href="<?= \yii\helpers\Url::to(['/gii']) ?>"><span class="fa fa-file-code-o"></span> Gii</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/debug']) ?>"><span class="fa fa-dashboard"></span> Debug</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>บันทึก</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= \yii\helpers\Url::to(['/clnsport']) ?>"> CLN1I010 บันทึกระเบียนผู้ป่วย</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/clnsport']) ?>"> CLN1I020 บันทึกการบาดเจ็บ</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/clnsport']) ?>"> CLN1I010 บันทึกกิจกรรมย่อย</a>
                    </li>
                </ul>
            </li>
        </ul>

    </section>

</aside>
