<option value="<?= $item['id_cat'] ?>"><?= $delimiter.$item['title'] ?></option>
<?php
	if($item['childs']) {
		echo getSelectTemplate($item['childs'], $delimiter.'&mdash;'.'&nbsp;');
	}
?>
	
