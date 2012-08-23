	<? foreach( $aProducts as $aProduct){ ?>
		<a href='<?= $aProduct['url'] ?>' target="_blank"><?= $aProduct['title'] ?></a><br />
	<? } ?>