<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/primary';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

    public function menuActive( $menu )
    {
        if (Yii::app()->controller->id ==  $menu) {
            return "active";
        }
    }

    public function customDatePickerWidget(){
        echo $this->renderPartial('//layouts/custom_date_picker');
    }

    public function getPrimaryHexColors(){
        return array(
            0 => '#0E6BA8',
            1 => '#F9DC5C',
            2 => '#ED254E',
            3 => '#FF08D7',
            4 => '#F8B500',
            5 => '#0fda23',
            6 => '#c89bbf',
            7 => '#5fb268',
            8 => '#d55b40',
            9 => '#e3f6bd',
            10 => '#6e216d',
            11 => '#413aaf',
            12 => '#0192e3',
            13 => '#a5069b',
            14 => '#d52874',
            15 => '#fd8f86',
            16 => '#adcac4',
            17 => '#fb4511',
            18 => '#5d6deb',
            19 => '#d13f8f',
            20 => '#eabbf9',
            21 => '#a5a4fd',
            22 => '#679fe2',
            23 => '#806255',
            24 => '#0f1d10',
            25 => '#07ebcc',
            26 => '#121b8c',
            27 => '#811def',
            28 => '#b38809',
            29 => '#ad44a6',
            30 => '#4901bc',
        );
    }

    public function getHexColors( $count ){
        $colors = [];
        $mainColors = $this->getPrimaryHexColors();
        for($i=0; $i<= $count; $i++){
            $colors[] = $mainColors[$i];
        }
        return $colors;
    }

    function random_rgba_color(){
        $rgbColor = array();

        foreach(array('r', 'g', 'b') as $color){
            //Generate a random number between 0 and 255.
            $rgbColor[$color] = mt_rand(0, 255);
        }
        return "rgba(".$rgbColor["r"].", ".$rgbColor["g"].", ".$rgbColor["b"].", 1)";
    }

    public function create_hex_colors($max){
        $colors = [];
        for($i=0; $i<= $max; $i++){
            $colors[] = $this->rand_hex_color();
        }
        return $colors;
    }

    function rand_hex_color() {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}
