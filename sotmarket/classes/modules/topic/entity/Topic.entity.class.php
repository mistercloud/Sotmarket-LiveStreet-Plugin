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

}
?>