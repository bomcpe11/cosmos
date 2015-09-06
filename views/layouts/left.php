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

        <ul class="sidebar-menu">
        	
        <?php 
        	$sql = 'SELECT ef_menu_main.MENU_MAIN_ID, 
					ef_menu_main.MENU_MAIN_NAME, 
					ef_menu_sub.MENU_SUB_ID, 
					ef_menu_sub.MENU_SUB_NAME, 
					ef_menu_sub.MENU_LINK FROM ef_menu_main, 
					ef_menu_sub 
			where ef_menu_sub.MENU_MAIN_ID=ef_menu_main.MENU_MAIN_ID 
				and ef_menu_sub.STATUS= :status 
				and ef_menu_main.STATUS= :status
			ORDER BY ef_menu_main.SEQ ASC, ef_menu_sub.SEQ ASC';
        	
        	$connection = Yii::$app->db;
        	$data = $connection->createCommand($sql, ['status' => 'A'])->queryAll();
        	
        	$menus = [];
        	foreach ($data as $row){
        		$menus[$row['MENU_MAIN_ID']][] = $row;
        	}
        	
//         	echo '<pre>';
//         	print_r($menus);
//         	echo '</pre>';
//         	exit();
        	
        	/*-----------------------------*/
        	
//         	$curr_id = 0;
//         	foreach($data as $row){ 
        	
// 	        	if($curr_id != $row['MENU_MAIN_ID']){
// 	        		echo '<li class="treeview">
// 			                <a href="#">
// 			                    <i class="fa fa-share"></i> <span>'.$row['MENU_MAIN_NAME'].'</span>
// 			                    <i class="fa fa-angle-left pull-right"></i>
// 			                </a>
// 			                <ul class="treeview-menu">';
// 	        	}
	        	
// 	        	echo '<li><a href="'.\yii\helpers\Url::to([$row['MENU_LINK']]).'"> '.$row['MENU_SUB_NAME'].'</a></li>';
	        	
// 	        	if($curr_id != $row['MENU_MAIN_ID']){
// 	        		echo '</ul>
// 	            	</li>';
// 	        	}
// 	        	$curr_id = $row['MENU_MAIN_ID'];
//          	}
         	
         	?>
         	
         	<?php foreach($menus as $main_menu):?>
         	<?php if(empty($main_menu)) continue; ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span><?=$main_menu[0]['MENU_MAIN_NAME']?></span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                	<?php foreach($main_menu as $sub_menu):?>
                    <li><a href="<?= \yii\helpers\Url::to([$sub_menu['MENU_LINK']]) ?>"> <?=$sub_menu['MENU_SUB_NAME']?></a>
                    </li>
                    <?php endforeach;?>
                </ul>
            </li>
            <?php endforeach;?>
<!--             <li class="treeview"> -->
<!--                 <a href="#"> -->
<!--                     <i class="fa fa-share"></i> <span>Administrator</span> -->
<!--                     <i class="fa fa-angle-left pull-right"></i> -->
<!--                 </a> -->
<!--                 <ul class="treeview-menu"> -->
<!--                    <li><a href="<?= \yii\helpers\Url::to(['/user/admin/create']) ?>"> V1 ลงทะเบียนผู้ใช้งาน</a> -->
<!--                     </li> -->
<!--                 </ul> -->
<!--             </li> -->
<!--             <li class="treeview"> -->
<!--                 <a href="#"> -->
<!--                     <i class="fa fa-share"></i> <span>กองทุนสิ่งแวดล้อม</span> -->
<!--                     <i class="fa fa-angle-left pull-right"></i> -->
<!--                 </a> -->
<!--                 <ul class="treeview-menu"> -->
<!--                    <li><a href="<?= \yii\helpers\Url::to(['/project/create']) ?>"> บันทึก</a> -->
<!--                     </li> -->
<!--                 </ul> -->
<!--             </li> -->
<!--             <li class="treeview"> -->
<!--                 <a href="#"> -->
<!--                     <i class="fa fa-share"></i> <span>บันทึก</span> -->
<!--                     <i class="fa fa-angle-left pull-right"></i> -->
<!--                 </a> -->
<!--                 <ul class="treeview-menu"> -->
<!--                    <li><a href="<?= \yii\helpers\Url::to(['/clnsport']) ?>"> CLN1I010 บันทึกระเบียนผู้ป่วย</a> -->
<!--                     </li> -->
<!--                    <li><a href="<?= \yii\helpers\Url::to(['/clnsport']) ?>"> CLN1I020 บันทึกการบาดเจ็บ</a> -->
<!--                     </li> -->
<!--                    <li><a href="<?= \yii\helpers\Url::to(['/clnsport']) ?>"> CLN1I010 บันทึกกิจกรรมย่อย</a> -->
<!--                     </li> -->
<!--                 </ul> -->
<!--             </li> -->
        </ul>

    </section>

</aside>
