<?php

class PluginSotmarket_HookSotmarket extends Hook {

    public function RegisterHook() {
        $this->AddHook('topic_show', 'FullTopicShow');
        $this->AddHook('topics_list_show', 'TopicsShow');
        $this->AddHook('template_form_add_topic_topic_end','AdditionalFields');

        $this->AddHook('topic_add_before','SaveTopic');
        $this->AddHook('topic_edit_before','SaveTopic');
        $this->AddHook('topic_edit_show','EditTopic');
    }

    public function EditTopic($aParams){
        $oTopic = $aParams['oTopic'];

        $_REQUEST['topic_sotmarket_ids'] = '';
        $_REQUEST['topic_sotmarket_name'] = '';


        if ($oTopic->getSotmarketIds()){
            $_REQUEST['topic_sotmarket_ids'] = $oTopic->getSotmarketIds();
        }

        if ($oTopic->getSotmarketName()){
            $_REQUEST['topic_sotmarket_name'] = $oTopic->getSotmarketName();
        }
    }

    /**
     * Обработка превью после сохранения топика
     */
    public function SaveTopic($aParams) {
        $oTopic=$aParams['oTopic'];

        if (getRequest('sotmarket_ids')) {
            $oTopic->setSotmarketIds(getRequest('sotmarket_ids'));
        }

        if (getRequest('sotmarket_name')) {
            $oTopic->setSotmarketName(getRequest('sotmarket_name'));
        }

    }


    /**
     * Обработка хука при создании топика. Добавляем дополнительные поля
     * @return string
     */
    public function AdditionalFields(){

        return $this->Viewer_Fetch(Plugin::GetTemplatePath(__CLASS__).'additional_fields.tpl');

    }

    /**
     * Обработка тега сотмаркет в коротких новостях
     * @param $aData
     */
    public function TopicsShow($aData){

        $aTopics = $aData['aTopics'];

        //в каждом из топиков смотрим есть ли тег
        foreach($aTopics as $oTopic){
            $sText = $oTopic->getTextShort();

            if ($sText = $this->checkText($sText,$oTopic)){
                $oTopic->setTextShort($sText,$oTopic);
            } else {
                return;
            }

        }

    }

    /**
     * Обрабатываем тег сотмаркета в полном посте
     *
     */
    public function FullTopicShow($aData) {
        //@param ModuleTopic_EntityTopic $oTopic
        $oTopic = $aData['oTopic'];
        $oSotmarketPlugin = PluginSotmarket::getInstance();
        $oSotmarketPlugin->setCurrentTopic($oTopic);
        $sText = $oTopic->getText();

        if ($sText = $this->checkText($sText,$oTopic)){
            $oTopic->setText($sText,$oTopic);
        } else {
            return;
        }





    }

    protected function checkText($sText,$oTopic){
        $aMaches = array();
        $sParams = '';
        if (preg_match('%{get_sotmarket(.*?)}%s',$sText,$aMaches)){
            $sParams = trim($aMaches[1]);
        } else {
            return;
        }

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

        $sText = preg_replace('%{get_sotmarket.*?}%s',$sSotmBlock,$sText);

        return $sText;

    }
}