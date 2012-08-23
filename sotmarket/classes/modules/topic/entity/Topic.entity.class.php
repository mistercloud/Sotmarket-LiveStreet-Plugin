<?php

/**
 * Добавление новых полей в топик
 * Поля хранятся в специальном поле extra в виде сериализованного массива
 */
class PluginSotmarket_ModuleTopic_EntityTopic extends PluginSotmarket_Inherit_ModuleTopic_EntityTopic {

    public function getSotmarketIds(){
        return $this->getExtraValue('sotmarket_ids');
    }

    public function getSotmarketName(){
        return $this->getExtraValue('sotmarket_name');
    }

    public function setSotmarketIds($data){
        $this->setExtraValue('sotmarket_ids',$data);
    }

    public function setSotmarketName($data){
        $this->setExtraValue('sotmarket_name',$data);
    }

    public function checkSotmarketText($sText,$oTopic){
        $aMaches = array();
        $sParams = '';
        if (preg_match_all('%{get_sotmarket(.*?)}%s',$sText,$aMaches)){

            foreach($aMaches[1] as $sParam){
                $sParams = trim($sParam);

                $aParams = array();
                $aTmpParams = explode(' ',$sParams);
                $sPreviosKey = '';
                foreach($aTmpParams as $sTmpParam){
                    //если нет типа (=) - это продолжение значения предыдущего тега
                    $sTmpParam = str_replace('"','',$sTmpParam);
                    $aTmpParams = explode('=',$sTmpParam);
                    if (count($aTmpParams) == 2){
                        $sKey = trim($aTmpParams[0]);
                        $sValue = trim($aTmpParams[1]);
                        $aParams[$sKey] = $sValue;
                        $sPreviosKey = $sKey;
                    } else {
                        $aParams[$sPreviosKey ] .= ' '.trim($aTmpParams[0]);
                    }
                }

                $oTmp = null;
                $sSotmBlock = smarty_function_get_sotmarket($aParams,$oTmp,$oTopic);

                $sText = preg_replace('%{get_sotmarket'.$sParam.'}%s',$sSotmBlock,$sText);
            }

        } else {
            return;
        }

        return $sText;

    }

}
?>