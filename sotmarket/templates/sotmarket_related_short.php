<?php
/**
 * NAME: Короткий
 * короткий шаблон вывода сопутствующих товаров
 */
?>

<? foreach( $aProducts as $aProduct){ ?>
	<a href='<?= $aProduct['url'] ?>' target="_blank"><?= $aProduct['title'] ?></a><br />
<? } ?>
