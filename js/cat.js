$(function(){

	//Перезагрузка сьраницы после закрытия модального окна
	function reload_after_close_modal(modal_id) {
		var addModal = document.getElementById(modal_id);
    	addModal.addEventListener('hide.bs.modal', function (event) {
        location.reload();
    });
	}

/********** Добавление канала в БД ************/

	$('#add-cat-btn').on('click', function(event){
		console.log('#add-cat-btn');
		$(this).attr('disabled','disabled');

		var id_parent = $('#input-add-cat_parent').val();
		var add_cat_title = $('#input-add-cat_title').val();
		var add_cat_slug = $('#input-add-cat_slug').val();
		var add_cat_desc = $('#input-add-cat_desc').val();

		$.ajax({
	        type: 'POST',
	        url: '../request/cat_request.php',
	        dataType: 'json',
	        data: {'add_cat' : true, // флаг отправки формы
	               'title': add_cat_title,
	               'slug': add_cat_slug,
	               'desc': add_cat_desc,
	               'parent': id_parent
	              },
	        //Функция обработки ответа при успешной отправке
	        success: function(res){
	            //console.log(res);
	            if (!res.error) {
	                //console.log(res);
	                
	                $('.input-add-cat').removeClass('is-invalid');
	                $('button#add-cat-btn').removeAttr('disabled');
	                $('#add-cat-message-wrap').html('<div class="alert alert-success" role="alert">'+ res.mess +'</div>');
	            } else {
	                if (res.error) { //Если ключ error true, т.е. ошибка
	                    $.each(res.arrMess, function(){ //Перебираем массив arrMess
	                        var mess = this.mess; //Сохраняем сообщение в переменную
	                        //Перебираем вложенный массив fields
	                        //по id нахожим поля для которых выводить сообщения
	                        $.each(this.fields, function(){
	                            //Вставляем текст сообщения
	                            $("#message-add-cat_" + this).text(mess);
	                            //добавляем для input красный бордер
	                            $("#input-add-cat_" + this).addClass('is-invalid');
	                        });
	                    });
	                }
	                $('#add-cat-message-wrap').html('<div class="alert alert-danger" role="alert">Запись не добавлена</div>');
	                $('.input-add-cat').on('focus', function(e) { $(this).removeClass('is-invalid'); $('#add-cat-message-wrap').remove();});
	                $('button#add-cat-btn').removeAttr('disabled');
	            }
	        },
	        //ошибка, нет ответа от сервера
	        error: function(){
	                    $('button#add-cat-btn').removeAttr('disabled');
	                    $('#add-print-message').html('<div class="alert alert-danger" role="alert">Запись не добавлена</div>');
	                    alert('Ошибка сервера при добавлении группы.');
	        }
	    });//$.ajax({
	   	reload_after_close_modal('addCatModal');
	});//$('#add-cat-btn').on('click', function(event){


/********** Редактирование канала ************/

	$('.edit-channel-item').on('click', function(event){//открытие формы редактирования 
		var editBtnObj = $(this);
		var edit_cat_id = editBtnObj.closest('.row-item').attr('data-channel-id-item');
		//console.log(edit_cat_id);

		$.ajax({
			type: 'POST',
            url: '../request/cat_request.php',
            dataType: 'json',
            data: {'get_cat_by_id' : true, // флаг отправки формы
                   'id_cat': edit_cat_id,
                  },
            success: function(res) {
            	//console.log(res.title);
            	$('#input-edit-cat_name').val(res.title);
            	$('#input-edit-cat_url').val(res.url);
            	$('#input-edit-cat_desc').val(res.desc);
            	$('#save-edit-cat-btn').attr('data-channel-id-item', edit_cat_id);

	            $('#editcatModal').modal('show');

            },
            error:  function() {
            	alert("Ошибка запроса данных для редактирования.");
            }
		});

	});//$('.edit-channel-item').on('click', function(event){

	$('#save-edit-cat-btn').on('click', function(event){

		//console.log($(this).attr('data-channel-id-item'));
		//return;

		var edit_cat_name = $('#input-edit-cat_name').val();
		var edit_cat_url = $('#input-edit-cat_url').val();
		var edit_cat_desc = $('#input-edit-cat_desc').val();
		var edit_cat_id = $(this).attr('data-channel-id-item');

		$.ajax({
	        type: 'POST',
	        url: '../request/cat_request.php',
	        dataType: 'json',
	        data: {'save_edit_cat' : true, // флаг отправки формы
	        		'id_cat': edit_cat_id,
	               'name': edit_cat_name,
	               'url': edit_cat_url,
	               'desc': edit_cat_desc
	              },
	        //Функция обработки ответа при успешной отправке
	        success: function(res){
	            //console.log(res);
	            if (!res.error) {
	                //console.log(res);
	                
	                $('.input-edit-cat').removeClass('is-invalid');
	                $('button#seve-edit-cat-btn').removeAttr('disabled');
	                $('#edit-cat-message-wrap').html('<div class="alert alert-success" role="alert">'+ res.mess +'</div>');
	            } else {
	                if (res.error) { //Если ключ error true, т.е. ошибка
	                    $.each(res.arrMess, function(){ //Перебираем массив arrMess
	                        var mess = this.mess; //Сохраняем сообщение в переменную
	                        //Перебираем вложенный массив fields
	                        //по id нахожим поля для которых выводить сообщения
	                        $.each(this.fields, function(){
	                            //Вставляем текст сообщения
	                            $("#message-edit-cat_" + this).text(mess);
	                            //добавляем для input красный бордер
	                            $("#input-edit-cat_" + this).addClass('is-invalid');
	                        });
	                    });
	                }
	                $('#edit-cat-message-wrap').html('<div class="alert alert-danger" role="alert">Запись не добавлена</div>');
	                $('.input-edit-cat').on('focus', function(e) { $(this).removeClass('is-invalid'); });
	                $('button#save-edit-cat-btn').removeAttr('disabled');
	            }
	        },
	        //ошибка, нет ответа от сервера
	        error: function(){
	                    $('button#save-edit-cat-btn').removeAttr('disabled');
	                    $('#edit-cat-message-wrap').html('<div class="alert alert-danger" role="alert">Запись не добавлена</div>');
	                    alert('Ошибка сервера при обновлении группы.');
	        }
	    });//$.ajax({
	    reload_after_close_modal('editcatModal');	
	});//$('#save-edit-cat-btn').on('click', function(event){

});