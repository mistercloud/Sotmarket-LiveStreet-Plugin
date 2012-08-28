<?php
class PluginSotmarket_ModuleText extends PluginTest_Inherit_ModuleText {

    public function Parser($sText) {
        $sResult=parent::Parser($sText);
        if (!$this->User_GetUserCurrent()->isAdministrator()){
            //удаляем все теги сотмаркета
            $sResult = preg_replace('%{get_sotmarket.*?}%s','',$sResult);
        }
        return $sResult;
    }
}
?>