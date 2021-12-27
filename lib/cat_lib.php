<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/lib/db.php';


function build_tree($data){
    
    $tree = array();
    
    foreach($data as $id => &$row){
        //var_dump($row);
        if($row['id_parent'] == 0){
            
            $tree[$id] = &$row;
        }
        else{
            $data[$row['id_parent']]['childs'][$id] = &$row;
        }
    }
    
    return $tree;
}

function db2arr($data, $field_id = "id_content"){
    //global $db;
    //var_dump($data);
    $arr = array();
    foreach ($data as $row) {
        $arr[$row[$field_id]] = $row;
    }
    return $arr;
}

//запрос всех групп
function get_cat_all() {
    global $db;

    $sql = "SELECT `id_cat`,
                    `id_parent`, 
                    `title`,
                    `slug`,
                    `description` FROM `category` ORDER BY `title`";

    $sth = $db->prepare($sql);
    $sth->execute();
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);
    return db2arr($array, 'id_cat');
}

/**
* Загрузка шаблона для вывода комментариев
**/
function getItemTemplate($items, $delimiter = '', &$i = 0){
    
    $html = '';
    foreach($items as $item){
        ob_start(); 
        include $_SERVER['DOCUMENT_ROOT'].'/views/category_tmp.php';          
        $html .= ob_get_clean();
    }
    
    return $html;
}

function getSelectTemplate($items, $delimiter = ''){
    
    $html = '';
    foreach($items as $item){
        ob_start(); 
        include $_SERVER['DOCUMENT_ROOT'].'/views/category_select_tmp.php';          
        $html .= ob_get_clean();
    }
    
    return $html;
}

function add_cat_validate($arrFields) {
	$error = false; //Нет ошибок
    $empty_fields = array(); //Незаполненные поля
    $array_mess = array(); //Массив со всеми сообщениями 
    
    //Обязательные поля для проверки
    $req_fields = array("title", "slug", "parent");

    //=========== Проверка на пустые поля ===========
    foreach ($arrFields as $key => $val) {
        if (empty($val) && in_array($key, $req_fields)) {
            // если поле пустое и находится в списке обязательных полей
            // добавляем в массив id полей для которых выводить сообщение 
            $empty_fields[] = $key;
        }
    }
    
    if (count($empty_fields) > 0) { //Если есть пустые поля
        $error = true;
        $mess = "Заполните поле";
        // формируем массив с сообением и id пустых полей
        $array_mess[] = array("mess" => $mess, "fields" => $empty_fields);
    }
    
    if ($error) { //Если есть ошибки
        // завершаем скрипт и отправляем ответ в формате JSON
        exit(json_encode(array("error" => $error, "arrMess" => $array_mess )));
    } else {
        
        $id_rec = add_record_db($arrFields);
        if ($id_rec) {
        //if (addRecordDB($arrFields)) {
        	$mess = "Запись сохранена";
        	exit(json_encode(array("error" => $error, "idRec" => $id_rec, "mess" => $mess)));
        	//exit(json_encode(array("error" => $error)));
        } else {
        	exit(json_encode(array("error" => true/*, "mess" => $mess*/)));
        }

    }
}

//Запись в БД соданной группы
function add_record_db($arrFields) {
	
	/*print_r($arrFields);*/

	global $db;
	$sth = $db->prepare("INSERT INTO `category` (id_parent,title,slug,description) VALUES (?,?,?,?)");
	
	$sth->execute(array($arrFields['parent'],
                        $arrFields['title'], 
                        $arrFields['slug'], 
                        $arrFields['desc']));

	//exit(var_dump($sql));
	//$db->exec($sql);
	return $db->lastInsertID();
	//return true;
}

//запрос одной записи по ID
function get_group_by_id($id) {
	global $db;

	$sql = "SELECT `id_group`,
					`title`,
					`url`,
                    `description` FROM `group` WHERE id=:id";

    $sth = $db->prepare($sql);
    $sth->execute(array('id' => $id));
    $array = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $array;
}

//запрос одной записи по ID для редактирования в форме
function get_group_by_id_request($id) {
	global $db;

	$sql = "SELECT `id_group`,
					`title`,
					`url`,
                    `description` FROM `group` WHERE id_group=:id";

    $sth = $db->prepare($sql);
    $sth->execute(array('id' => $id));
    $row = $sth->fetch(PDO::FETCH_ASSOC);
    
    exit(json_encode(array('id_group' => $row['id_group'], 
    						'title' => $row['title'], 
    						'url' => $row['url'], 
    						'desc' => $row['description'])));
}


//Сохранение формы после редактирования
function updata_group_validate($arrFields) {
	$error = false; //Нет ошибок
    $empty_fields = array(); //Незаполненные поля
    $array_mess = array(); //Массив со всеми сообщениями 
    
    //Обязательные поля для проверки
    $req_fields = array("name", "url");

    if ((int)$arrFields['id_group'] < 1) {
    	//exit(json_encode(array("error" => $error, "arrMess" => $array_mess )));
    	exit();
    }

    //=========== Проверка на пустые поля ===========
    foreach ($arrFields as $key => $val) {
        if (empty($val) && in_array($key, $req_fields)) {
            // если поле пустое и находится в списке обязательных полей
            // добавляем в массив id полей для которых выводить сообщение 
            $empty_fields[] = $key;
        }
    }
    
    if (count($empty_fields) > 0) { //Если есть пустые поля
        $error = true;
        $mess = "Заполните поле";
        // формируем массив с сообением и id пустых полей
        $array_mess[] = array("mess" => $mess, "fields" => $empty_fields);
    }
    
    if ($error) { //Если есть ошибки
        // завершаем скрипт и отправляем ответ в формате JSON
        exit(json_encode(array("error" => $error, "arrMess" => $array_mess )));
    } else {
        
        $row_count = update_record_db($arrFields);
        if ($row_count == 1) {
        //if (addRecordDB($arrFields)) {
        	$mess = "Запись сохранена";
        	exit(json_encode(array("error" => $error, "idRec" => $id_rec, "mess" => $mess)));
        	//exit(json_encode(array("error" => $error)));
        } else {
        	exit(json_encode(array("error" => true/*, "mess" => $mess*/)));
        }

    }
}

//Запись в БД соданной группы
function update_record_db($arrFields) {
	
	/*print_r($arrFields);*/

	global $db;
	$sth = $db->prepare("UPDATE `group` SET title=?,
											url=?,
											description=? WHERE id_group=?");
	
	$sth->execute(array($arrFields['name'], 
                        $arrFields['url'], 
                        $arrFields['desc'], 
                        $arrFields['id_group']));

	//exit(var_dump($sql));
	//$db->exec($sql);
	return $sth->rowCount();
	//return true;
}


/*

function addRecordProc($arrFields) {

    //exit($_POST['order_type']);
    //sleep(1);
    //exit(var_dump($arrOrderData));
    $error = false; //Нет ошибок
    $empty_fields = array(); //Незаполненные поля
    $array_mess = array(); //Массив со всеми сообщениями 
    
    //Обязательные поля для проверки
    $req_fields = array("model_print", "location_print", "hostname_print", "gs_print");

    if ($arrFields['gs_print'] != 4) {
        $req_fields = array("model_print", "location_print", "ip_print", "sn_print", "hostname_print", "gs_print");
    }
     
    // if (isset($arrFields['link_channel']) && !empty($arrFields['link_channel'])) {
    //     $url = filter_var($arrFields['link_channel'], FILTER_SANITIZE_URL);
    //     if (!filter_var($url, FILTER_VALIDATE_URL)) {
    //         $error = true; // Изменяем флаг наличия ошибки валидации
    //         $mess = "Некорректный URL-адрес"; // Записываем текст ошибки
    //         //Сохраняем в массив текст ошибки и имя id поля для которого выводить сообщение
    //         $array_mess[] = array("mess" => $mess, "fields" => array("link_channel"));
    //     }
    // }
        
    //=========== Проверка на пустые поля ===========
    foreach ($arrFields as $key => $val) {
        if (empty($val) && in_array($key, $req_fields)) {
            // если поле пустое и находится в списке обязательных полей
            // добавляем в массив id полей для которых выводить сообщение 
            $empty_fields[] = $key;
        }
    }
    
    if (count($empty_fields) > 0) { //Если есть пустые поля
        $error = true;
        $mess = "Заполните поле";
        // формируем массив с сообением и id пустых полей
        $array_mess[] = array("mess" => $mess, "fields" => $empty_fields);
    }
    
    if ($error) { //Если есть ошибки
        // завершаем скрипт и отправляем ответ в формате JSON
        exit(json_encode(array("error" => $error, "arrMess" => $array_mess )));
    } else {
        
            Если нет ошибок валидации - выполняем какое либо действие
            записвваем данные в БД, отправляем e-mail и т.д.
        
        $id_rec = addRecordDB($arrFields);
        if ($id_rec) {
        //if (addRecordDB($arrFields)) {
        	$mess = "Запись сохранена";
        	exit(json_encode(array("error" => $error, "idRec" => $id_rec, "mess" => $mess)));
        	//exit(json_encode(array("error" => $error)));
        } else {
        	exit(json_encode(array("error" => true/*, "mess" => $mess*//*)));
        }

    }

}*/

/*
function addRecordDB ($arrFields) {
	global $db;
	$sth = $db->prepare("INSERT INTO device (name, 
                                            ip_address, 
                                            serial_number, 
                                            location, 
                                            position, 
                                            visible, 
                                            description, 
                                            hostname) VALUES (?,?,?,?,?,?,?,?)");
	
	$sth->execute(array($arrFields['model_print'], 
                        $arrFields['ip_print'], 
                        $arrFields['sn_print'], 
                        $arrFields['location_print'], 
                        1, 1, '', 
                        $arrFields['hostname_print']));

	//exit(var_dump($sql));
	//$db->exec($sql);
	return $db->lastInsertID();
	//return true;
}

*/