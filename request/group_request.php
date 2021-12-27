<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/lib/group_lib.php';

//Сохранение записи группы
if ($_POST['add_group']) {
	add_group_validate($_POST);
}

//Запрос данных для редактирования группы
if ($_POST['get_group_by_id']) {
	$id = (int)$_POST['id_group'];
	get_group_by_id_request($id);
}

//Сохранение формы после редактирования
if ($_POST['save_edit_group']) {
	updata_group_validate($_POST);
}
