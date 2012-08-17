<?
/**
 * NAME: 3 колонки
 * Шаблон вывода аналогичных товаров в 3 колонки
 */
$iColumnsCnt = 3;
//получаем ширину для блока, в зависимости от указанного количества колонок
$iWidth = floor( 100 / $iColumnsCnt );
//счетчик товаров, нужен для раскидывания по колонкам
$iCnt = 1;
?>

<div width="98%">

	<? foreach( $aProducts as $aProduct){ ?>
	<div style="width: <?=$iWidth ?>%;text-align:center; float: left;" >
		<a href='<?= $aProduct['url'] ?>' target="_blank"><?= $aProduct['title'] ?></a><br />
		<span style='color:red'><?= $aProduct['sale'] ?></span>Цена: <?= $aProduct['price'] ?> руб.<br />
		<a href='<?= $aProduct['url'] ?>' target="_blank"><img src='<?= $aProduct['image_src'] ?>'></a><br />
		<a href='<?= $aProduct['url'] ?>' target="_blank">Купить</a><br />
	</div>

	<? if ( $iCnt%$iColumnsCnt  == 0){ ?>
		<div style="clear:both;"></div>
		<? }
	$iCnt++;
	?>

	<? } ?>

</div>