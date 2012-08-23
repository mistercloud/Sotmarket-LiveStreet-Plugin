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

        $oTopic->setSotmarketIds(getRequest('sotmarket_ids'));

        $oTopic->setSotmarketName(getRequest('sotmarket_name'));


    }


    /**
     * Обработка хука при создании топика. Добавляем дополнительные поля
     * @return string
     */
    public function AdditionalFields(){
        $sTemplates = '';
        $sSotmarketTemplatesPath = Plugin::GetPath(__CLASS__)  .'templates/';
        $aTemplateFiles = glob($sSotmarketTemplatesPath.'*.php');
        $aTemplateFiles = str_replace( array($sSotmarketTemplatesPath,'.php'),'',$aTemplateFiles );
        foreach($aTemplateFiles as $sTemplate){
            $sTemplates .= '<option value="'.$sTemplate.'" >'.$sTemplate.'</option>';
        }
        $this->Viewer_Assign('sTemplates',$sTemplates);

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

            if ($sText = $oTopic->checkSotmarketText($sText,$oTopic)){
                $oTopic->setTextShort($sText,$oTopic);
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

        if ($sText = $oTopic->checkSotmarketText($sText,$oTopic)){
            $oTopic->setText($sText,$oTopic);
        } else {
            return;
        }





    }


}