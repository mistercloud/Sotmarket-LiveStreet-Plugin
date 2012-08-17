<?php
class PluginSotmarket_ModuleText extends PluginTest2_Inherit_ModuleText {

    public function Parser($sText) {
        $sResult=parent::Parser($sText);
        return ''.$sResult;
    }
}
?>