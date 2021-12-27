<?php require_once $_SERVER['DOCUMENT_ROOT'].'/request/group_request.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <title>YTFV | Группы</title>

  </head>
  <body>
  	<!-- <div class="header">
	    <div class="container-fluid">
	    	<div class="row">
	    		<div class="col-2 bg-dark">Сайт рыбатекст поможет дизайнеру</div>
	    		<div class="col-10">Сайт рыбатекст поможет дизайнеру, верстальщику, вебмастеру сгенерировать несколько абзацев более менее осмысленного текста рыбы на русском языке, а начинающему оратору отточить навык публичных выступлений в домашних условиях. </div>
	    	</div>
    	</div>
    </div> -->
    <div class="main">
      <div class="container-fluid">
        <div class="row" style="height:100vh; position:relative">
          <div class="col-2 bg-dark">
            <div class="left-menu list-unstyled">
              <ul class="list-unstyled text-white-50">
                <li><a href="/" class="text-white-50">Загрузить записи</a></li>
                <li><a href="/filter.php" class="text-white-50">Фильтр записей</a></li>
                <li><a href="group.php" class="text-white-50">Группы</a></li>
                <li><a href="/category.php" class="text-white-50">Категории</a></li>
                <li><a href="" class="text-white-50">Настройки</a></li>
                <li><a href="" class="text-white-50">Пользователи</a></li>
              </ul>
            </div>
          </div>
          <div class="col-10 px-5 pt-3 pb-5">
            <div class="row">
              <div class="col-12 pb-3">
                <h4>Добавить группу</h4>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#addGroupModal" id="add-channel-btn">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                  </svg>
                </button>
              </div>
            </div>
            <div class="row">
              <div class="col-9 pt-5 cat-table-wrap">

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col" width="5%" class="text-center">#</th>
                      <th scope="col" width="5%" class="text-center">ID</th>
                      <th scope="col" class="text-center">Заголовок</th>
                      <th scope="col" class="text-center">URL</th>
                      <th scope="col" width="15%">&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $all_group = get_group_all(); ?>
                    <?php foreach ($all_group as $group_item) : ?>
                      <tr class="row-item" data-channel-id-item="<?= $group_item['id_group'] ?>">
                        <th scope="row" class="text-end"><?= ++$i ?></th>
                        <td class="text-end"><?= $group_item['id_group'] ?></td>
                        <td><?= $group_item['title'] ?></td>
                        <td><?= $group_item['url'] ?></td>
                        <td class="text-center">
                          <button type="button" class="btn btn-secondary btn-sm edit-channel-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                              <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg>
                          </button>
                          <button type="button" class="btn btn-secondary btn-sm del-channel-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                              <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                              <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                          </button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <!-- Форма добавления группы -->
                <div class="modal fade" id="addGroupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addGroupModal">Добавить группу</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Название</label>
                            <input type="text" class="form-control input-add-group" id="input-add-group_name">
                            <div class="invalid-feedback message-add-group" id="message-add-group_name"></div>
                          </div>
                          <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">URL</label>
                            <input type="text" class="form-control input-add-group" id="input-add-group_url">
                            <div class="invalid-feedback message-add-group" id="message-add-group_url"></div>
                          </div>
                          <div class="mb-3">
                            <label for="message-text" class="col-form-label">Описание</label>
                            <textarea class="form-control input-add-group" id="input-add-group_desc"></textarea>
                            <div class="invalid-feedback message-add-group" id="message-add-group_desc"></div>
                          </div>
                        </form>
                        <div id="add-group-message-wrap">
                          <!-- <div class="alert alert-danger visually-hidden" role="alert" >A simple danger alert—check it out!</div> -->
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary" id="add-group-btn">Сохранить</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Форма редактирования группы -->
                <div class="modal fade" id="editGroupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editGroupModal">Редактировать группу</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Название</label>
                            <input type="text" class="form-control input-edit-group" id="input-edit-group_name">
                            <div class="invalid-feedback message-add-group" id="message-add-group_name"></div>
                          </div>
                          <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">URL</label>
                            <input type="text" class="form-control input-edit-group" id="input-edit-group_url">
                            <div class="invalid-feedback message-add-group" id="message-add-group_url"></div>
                          </div>
                          <div class="mb-3">
                            <label for="message-text" class="col-form-label">Описание</label>
                            <textarea class="form-control input-edit-group" id="input-edit-group_desc"></textarea>
                            <div class="invalid-feedback message-edit-group" id="message-edit-group_desc"></div>
                          </div>
                        </form>
                        <div id="edit-group-message-wrap">
                          <!-- <div class="alert alert-danger visually-hidden" role="alert" >A simple danger alert—check it out!</div> -->
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary" id="save-edit-group-btn">Сохранить</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery.js"></script>
    <script src="/js/group.js"></script>


  </body>
</html>