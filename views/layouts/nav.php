<div id="nav-wrapper">
    <ul id="nav"
        data-ng-controller="NavCtrl"
        data-collapse-nav
        data-slim-scroll
        data-highlight-active>
        <li><a href="#"> <i class="fa fa-dashboard"><span class="icon-bg bg-danger"></span></i><span data-i18n="Dashboard">Dashboard</span></a></li>
        
        <?php 
        	$sql = 'SELECT ef_menu_main.MENU_MAIN_ID, 
					ef_menu_main.MENU_MAIN_NAME, 
					ef_menu_main.MENU_CLASS, 
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
         	?>
         	
         	<?php foreach($menus as $main_menu):?>
         	<?php if(empty($main_menu)) continue; ?>
         	<li>
	            <a href="#"><i class="fa fa-magic"><span class="icon-bg <?=$main_menu[0]['MENU_CLASS']?>"></span></i><span data-i18n="UI Kit"><?=$main_menu[0]['MENU_MAIN_NAME']?></span></a>
	            <ul>
	            <?php foreach($main_menu as $sub_menu):?>
	            	<li><a href="<?= \yii\helpers\Url::to([$sub_menu['MENU_LINK']]) ?>"><i class="fa fa-caret-right"></i><span data-i18n="Buttons"><?=$sub_menu['MENU_SUB_NAME']?></span></a></li>
	            <?php endforeach;?>
	            </ul>
            </li>
            <?php endforeach;?>
	                    
    </ul>
</div>