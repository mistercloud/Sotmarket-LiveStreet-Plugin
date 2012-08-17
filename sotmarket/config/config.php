<?php

$config['sotm_config'] = array(
    'SOTMARKET_SITE_ID' => 0,
    'SOTMARKET_PARTNER_ID' => 0,
    'SOTMARKET_LINK_TYPE' => 'link', //отображать ли прямую ссылку или редирект на сайт.
                                        //возможные заначение 'redirect', 'link'
    'SOTMARKET_BLOCK_TYPE' => 'informer', //ссылка на sotmarket или покупка на сайте партнера
                                          //возможные значения 'informer', 'shop'
    'SOTMARKET_BLOCK_STATUSES' => 'all', //отображать все товары или только в наличие
                                        //возможные значения 'all' , 'available'
    'SOTMARKET_LABEL_TYPE' => 'from', //тип метки в ссылке. Значения 'from', 'subref'
    'SOTMARKET_FROM' => '1111111', //метка


);

//примеры блоков
/*Config::Set('block.sotmarket_right_sotmarket_block', array(
    'path' => array('___path.root.web___/blog/sotmarket/*\.html$'),
    'blocks' => array('right' => array('blocks/block.sotmarket_right.tpl'=> array('priority'=>600))),
    'clear' => false,
));
Config::Set('block.sotmarket_right_sotmarket_block1', array(
    'path' => array('___path.root.web___/blog/sotmarket/'),
    'blocks' => array('right' => array('blocks/block.sotmarket_right.tpl'=> array('priority'=>600))),
    'clear' => false,
));
Config::Set('block.sotmarket_right_sotmarket_block2', array(
    'path' => array('___path.root.web___/'),
    'blocks' => array('right' => array('blocks/block.sotmarket_right.tpl'=> array('priority'=>600))),
    'clear' => false,
));
Config::Set('block.sotmarket_right_people_block3', array(
    'action'  => array('people'),
    'blocks' => array('right' => array('blocks/block.sotmarket_right.tpl'=> array('priority'=>600))),
    'clear' => false,
));*/


return $config;

?>