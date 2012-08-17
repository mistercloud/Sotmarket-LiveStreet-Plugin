<?php
/**
 * NAME: Полный
 * Полный шаблон вывода аналогичных товаров
 */
?>

<? foreach( $aProducts as $aProduct){ ?>
<div style="width: 98%;text-align:center;" >
	<a href='<?= $aProduct['url'] ?>' target="_blank"><?= $aProduct['title'] ?></a><br />
	<span style='color:red'><?= $aProduct['sale'] ?></span>Цена: <?= $aProduct['price'] ?> руб.<br />
	<a href='<?= $aProduct['url'] ?>' target="_blank"><img src='<?= $aProduct['image_src'] ?>'></a><br />
	<a href='<?= $aProduct['url'] ?>' target="_blank">Купить</a><br />
</div>
<? } ?>
