<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

    if (class_exists('backend\assets\AppAsset')) {
        backend\assets\AppAsset::register($this);
    } else {
        app\assets\AppAsset::register($this);
    }

    dmstr\web\AdminLteAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
    ?>
    <?php $this->beginPage() ?>
<!doctype html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
        <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic" rel="stylesheet" type="text/css">
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>
        <!--[if lt IE 9]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div>
            <div>
                <section id="header" class="top-header">
                <?= $this->render(
		            'header.php',
		            ['directoryAsset' => $directoryAsset]
		        ) ?>
                </section>

                <aside id="nav-container" class="main-sidebar">
                <?= $this->render(
		            'nav.php',
		            ['directoryAsset' => $directoryAsset]
		        )
		        ?>
                </aside>
            </div>

            <div class="view-container">
                <section id="content" class="animate-fade-up ng-scope"><div class="page ng-scope"><?= $this->render(
		            'content.php',
		            ['content' => $content, 'directoryAsset' => $directoryAsset]
		        )
		        ?></div></section>
            </div>
        </div>
    	<?php $this->endBody() ?>
    	
<script type="text/javascript">
	$('.toggle-min').click(function(){
		if($('body').hasClass('nav-min')){
			$('body').removeClass('nav-min');
		}else{
			$('body').addClass('nav-min');
			$('ul#nav li').find('ul').hide();
			$('ul#nav li').removeClass('open');
		}
		
	});
	$('.menu-button').click(function(){
		if($('body').hasClass('on-canvas')){
			$('body').removeClass('on-canvas');
		}else{
			$('body').addClass('on-canvas');
		}
		
	});
	$('ul#nav>li>a').click(function(){
		if(!$('body').hasClass('nav-min')){
			if(!$(this).closest('li').hasClass('open')){
				$('ul#nav li').find('ul').hide('blind');
			}
			$('ul#nav li').removeClass('open');
			$(this).closest('li').addClass('open');
			$(this).closest('li').find('ul').toggle('blind');
		}
	});
</script>
    </body>
</html>
<?php $this->endPage() ?>
<?php } ?>
