$(function(){

	//Перезагрузка сьраницы после закрытия модального окна
	function reload_after_close_modal(modal_id) {
		var addModal = document.getElementById(modal_id);
    	addModal.addEventListener('hide.bs.modal', function (event) {
        location.reload();
    });
	}

/********** Добавление канала в БД ************/

	$('#add-group-btn').on('click', function(event){
		console.log('#add-group-btn');
		$(this).attr('disabled','disabled');

		var add_group_name = $('#input-add-group_name').val();
		var add_group_url = $('#input-add-group_url').val();
		var add_group_desc = $('#input-add-group_desc').val();

		$.ajax({
	        type: 'POST',
	        url: '../request/group_request.php',
	        dataType: 'json',
	        data: {'add_group' : true, // флаг отправки формы
	               'name': add_group_name,
	               'url': add_group_url,
	               'desc': add_group_desc
	              },
	        //Функция обработки ответа при успешной отправке
	        success: function(res){
	            //console.log(res);
	            if (!res.error) {
	                //console.log(res);
	                
	                $('.input-add-group').removeClass('is-invalid');
	                $('button#add-group-btn').removeAttr('disabled');
	                $('#add-group-message-wrap').html('<div class="alert alert-success" role="alert">'+ res.mess +'</div>');
	            } else {
	                if (res.error) { //Если ключ error true, т.е. ошибка
	                    $.each(res.arrMess, function(){ //Перебираем массив arrMess
	                        var mess = this.mess; //Сохраняем сообщение в переменную
	                        //Перебираем вложенный массив fields
	                        //по id нахожим поля для которых выводить сообщения
	                        $.each(this.fields, function(){
	                            //Вставляем текст сообщения
	                            $("#message-add-group_" + this).text(mess);
	                            //добавляем для input красный бордер
	                            $("#input-add-group_" + this).addClass('is-invalid');
	                        });
	                    });
	                }
	                $('#add-group-message-wrap').html('<div class="alert alert-danger" role="alert">Запись не добавлена</div>');
	                $('.input-add-group').on('focus', function(e) { $(this).removeClass('is-invalid'); });
	                $('button#add-group-btn').removeAttr('disabled');
	            }
	        },
	        //ошибка, нет ответа от сервера
	        error: function(){
	                    $('button#add-group-btn').removeAttr('disabled');
	                    $('#add-print-message').html('<div class="alert alert-danger" role="alert">Запись не добавлена</div>');
	                    alert('Ошибка сервера при добавлении группы.');
	        }
	    });//$.ajax({
	   	reload_after_close_modal('addGroupModal');
	});//$('#add-group-btn').on('click', function(event){


/********** Редактирование канала ************/

	$('.edit-channel-item').on('click', function(event){//открытие формы редактирования 
		var editBtnObj = $(this);
		var edit_group_id = editBtnObj.closest('.row-item').attr('data-channel-id-item');
		//console.log(edit_group_id);

		$.ajax({
			type: 'POST',
            url: '../request/group_request.php',
            dataType: 'json',
            data: {'get_group_by_id' : true, // флаг отправки формы
                   'id_group': edit_group_id,
                  },
            success: function(res) {
            	//console.log(res.title);
            	$('#input-edit-group_name').val(res.title);
            	$('#input-edit-group_url').val(res.url);
            	$('#input-edit-group_desc').val(res.desc);
            	$('#save-edit-group-btn').attr('data-channel-id-item', edit_group_id);

	            $('#editGroupModal').modal('show');

            },
            error:  function() {
            	alert("Ошибка запроса данных для редактирования.");
            }
		});

	});//$('.edit-channel-item').on('click', function(event){

	$('#save-edit-group-btn').on('click', function(event){

		//console.log($(this).attr('data-channel-id-item'));
		//return;

		var edit_group_name = $('#input-edit-group_name').val();
		var edit_group_url = $('#input-edit-group_url').val();
		var edit_group_desc = $('#input-edit-group_desc').val();
		var edit_group_id = $(this).attr('data-channel-id-item');

		$.ajax({
	        type: 'POST',
	        url: '../request/group_request.php',
	        dataType: 'json',
	        data: {'save_edit_group' : true, // флаг отправки формы
	        		'id_group': edit_group_id,
	               'name': edit_group_name,
	               'url': edit_group_url,
	               'desc': edit_group_desc
	              },
	        //Функция обработки ответа при успешной отправке
	        success: function(res){
	            //console.log(res);
	            if (!res.error) {
	                //console.log(res);
	                
	                $('.input-edit-group').removeClass('is-invalid');
	                $('button#seve-edit-group-btn').removeAttr('disabled');
	                $('#edit-group-message-wrap').html('<div class="alert alert-success" role="alert">'+ res.mess +'</div>');
	            } else {
	                if (res.error) { //Если ключ error true, т.е. ошибка
	                    $.each(res.arrMess, function(){ //Перебираем массив arrMess
	                        var mess = this.mess; //Сохраняем сообщение в переменную
	                        //Перебираем вложенный массив fields
	                        //по id нахожим поля для которых выводить сообщения
	                        $.each(this.fields, function(){
	                            //Вставляем текст сообщения
	                            $("#message-edit-group_" + this).text(mess);
	                            //добавляем для input красный бордер
	                            $("#input-edit-group_" + this).addClass('is-invalid');
	                        });
	                    });
	                }
	                $('#edit-group-message-wrap').html('<div class="alert alert-danger" role="alert">Запись не добавлена</div>');
	                $('.input-edit-group').on('focus', function(e) { $(this).removeClass('is-invalid'); });
	                $('button#save-edit-group-btn').removeAttr('disabled');
	            }
	        },
	        //ошибка, нет ответа от сервера
	        error: function(){
	                    $('button#save-edit-group-btn').removeAttr('disabled');
	                    $('#edit-group-message-wrap').html('<div class="alert alert-danger" role="alert">Запись не добавлена</div>');
	                    alert('Ошибка сервера при обновлении группы.');
	        }
	    });//$.ajax({
	    reload_after_close_modal('editGroupModal');	
	});//$('#save-edit-group-btn').on('click', function(event){

});