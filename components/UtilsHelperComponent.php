<?php
namespace app\components;

use yii\base\Component;

class UtilsHelperComponent extends Component{
	public $content;
	
	public function init(){
		parent::init();
		$this->content= 'Hello Yii 2.0';
	}
	
	public function display($content=null){
		if($content!=null){
			$this->content= $content;
		}
		echo Html::encode($this->content);
	}

        public function convThFormatDate($strdate , $format_input , $format_output) {
            $months = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"] ;
            switch ($format_input) {
                case 'dd MM yyyy' :
                    $format_input_array = explode(' ', $strdate);
                    $num_month =  array_search($format_input_array[1], $months)  + 1 ;
                    switch ($format_output) {
                        case 'dd/mm/yyyy' :
                            return $format_input_array[0] . '/' . $num_month . '/' . $format_input_array[2] ;
                    }
                    break ;
            }
            return "" ;
        }
        
        public function getCardTypeLov() {
            return array(   '1' => 'บัตรประชาชน',
                            '2' => 'ข้าราชการ', 
                            '3' => 'นักเรียน', 
                            '4' => 'นักศึกษา', 
                            '5' => 'หนังสือเดินทาง', 
                            '6' => 'คนต่างด้าว', 
                        ) ;
        }

        public function getSeqNum10() {
            return array(   '1' => '1',
                            '2' => '2', 
                            '3' => '3', 
                            '4' => '4', 
                            '5' => '5', 
                            '6' => '6', 
                            '7' => '7', 
                            '8' => '8', 
                            '9' => '9', 
                            '10' => '10',                           
                        ) ;
        }
}
?>
