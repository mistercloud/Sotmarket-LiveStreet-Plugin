<?php

/**
 * Запрещаем напрямую через браузер обращение к этому файлу.
 */
if (!class_exists('Plugin')) {
    die('Hacking attempt!');
}

include_once(dirname(__FILE__).'/common/include.php');
class PluginSotmarket extends Plugin {

    protected $aInherits=array(
        'entity'  =>array('ModuleTopic_EntityTopic')
    );


    protected static $oInstance;
    protected $oTopic = null;
    public function Activate() {
        return true;
    }

    public function Init() {


    }

    public static function getInstance(){
        if (!self::$oInstance){
            self::$oInstance = new PluginSotmarket();
        }

        return self::$oInstance;
    }

    public function Deactivate() {
        return true;
    }

    public function getData($sType, $aProductIds, $sProductName, $iCnt = 1,$sTemplate = 'sotmarket_info_base',$sImageSize = 'default',$aCategories){
        $aConfig = Config::Get('plugin.sotmarket.sotm_config');
        $aConfig['home_url'] = '';

        $oSotmarketProduct = new SotmarketProduct($aConfig,array(),$sType);
        try {
            $sReturn = $oSotmarketProduct->getProducts( $aProductIds, $sProductName, $iCnt , $sTemplate, $sImageSize, $aCategories );
        } catch (Exception $e) {
            $sReturn = $e->getMessage();
            $sReturn = iconv('cp1251','utf-8',$sReturn);
        }

        return $sReturn;

    }

    public function setCurrentTopic($oTopic){
        $this->oTopic = $oTopic;
    }

    public function getCurrentTopic(){

        return $this->oTopic;
    }
}

function smarty_function_get_sotmarket($params, &$smarty = null, $oTopic = null) {

    //проверяем данные перед вызовом

    $aTypes = array('products','related','analog');
    if ( !isset($params['type']) || (!isset($params['product_id']) && !isset($params['product_name'])) && !in_array($params['type'],$aTypes)){
        return 'Не установлен тип или товар';
    }

    $aProductIds = array();
    if ( !empty($params['product_id']) ){
        $aProductIds = explodeProductId( $params['product_id'] );
        $params['product_id'] = trim($params['product_id']);
        $aTmpProductIds = explode(',',$params['product_id']);
        foreach($aTmpProductIds as $iProductId){
            $iProductId = (int) $iProductId;
            if ( $iProductId ){
                $aProductIds[] = $iProductId;
            }
        }
    }

    $sProductName = '';
    if ( !$aProductIds && !empty($params['product_name'])){
        $sProductName = trim($params['product_name']);
    }

    //если не указаны id и имя пробуем брать из дополнительных полей
    if (!$sProductName && !$aProductIds){
        if (!$oTopic){
            return;
        }
        $sProductName = $oTopic->getSotmarketName();
        $aProductIds = $oTopic->getSotmarketIds();
        if (!$sProductName && !$aProductIds){
            return;
        }
    }

    $iCnt = 1;
    if ( isset( $params['cnt'] ) ){
        $params['cnt'] = (int)$params['cnt'];
        if ($params['cnt'] > 0){
            $iCnt = $params['cnt'];
        }
    }

    $sTemplate = 'sotmarket_info_base';
    if (isset($params['template'])){
        $sTemplate = $params['template'];
    }

    $sImageSize = 'default';
    if ( isset( $params['image_size']) ){
        $aImageSizes = array(
            "100x100",
            "140x200",
            "300x250" ,
            "1200x1200",
            "100x150",
            "50x50",
            "default"
        );

        if ( in_array( $params['image_size'], $aImageSizes ) ){
            $sImageSize = $params['image_size'];
        }
    }

    $aCategories = array();
    if ( isset( $params['categories'] ) ) {
        $aTmpCategories = explode( ',',$params['categories'] );
        foreach( $aTmpCategories as $iCategory ){
            $iCategory = (int) $iCategory;
            if ($iCategory > 0 ){
                $aCategories[] = $iCategory;
            }
        }
    }



    $oSotmarket = PluginSotmarket::getInstance();

    //если явно указано что нужно брать инфу из дополнительных полей топика
    if (isset($params['topic_additional']) && $params['topic_additional']){
        $oTopic = $oSotmarket->getCurrentTopic();
        if ($oTopic){
            $aProductIds = $oTopic->getSotmarketIds();
            $sProductName = $oTopic->getSotmarketName();
        } else {
            return;
        }

    }

    return $oSotmarket->getData($params['type'],$aProductIds,$sProductName,$iCnt,$sTemplate,$sImageSize,$aCategories);
}

//если редирект
if (isset($_GET['srdr'])){
    $sUrl = urldecode(base64_decode($_GET['srdr']));
    header('Location: '.$sUrl);
    die();
}