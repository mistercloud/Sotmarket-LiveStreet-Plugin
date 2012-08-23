<?php

class PluginSotmarket_ModuleTopic extends PluginSotmarket_Inherit_ModuleTopic {


    public function GetTopicsAdditionalData($aTopicId,$aAllowData=null) {
        $aTopics = parent::GetTopicsAdditionalData($aTopicId,$aAllowData);

        foreach($aTopics as $oTopic){
            $sText = $oTopic->getTextShort();

            if ($sText = $oTopic->checkSotmarketText($sText,$oTopic)){
                $oTopic->setTextShort($sText,$oTopic);
            }

        }
        return $aTopics;
    }
}