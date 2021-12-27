<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/lib/cat_lib.php';

//Сохранение записи категории
if ($_POST['add_cat']) {
	add_cat_validate($_POST);
}

//Запрос данных для редактирования категории
if ($_POST['get_cat_by_id']) {
	$id = (int)$_POST['id_cat'];
	get_cat_by_id_request($id);
}

//Сохранение формы после редактирования
if ($_POST['save_edit_cat']) {
	updata_cat_validate($_POST);
}
