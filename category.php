<?php require_once $_SERVER['DOCUMENT_ROOT'].'/request/cat_request.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <title>YTFV | Категории</title>

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
                <li><a href="/group.php" class="text-white-50">Группы</a></li>
                <li><a href="/category.php" class="text-white-50">Категории</a></li>
                <li><a href="" class="text-white-50">Настройки</a></li>
                <li><a href="" class="text-white-50">Пользователи</a></li>
              </ul>
            </div>
          </div>
          <div class="col-10 px-5 pt-3 pb-5">
            <div class="row">
              <div class="col-12 pb-3">
                <h4>Добавить категорию</h4>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#addCatModal" id="add-сat-btn">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"/>
                  </svg>
                </button>
              </div>
            </div>
            <div class="row">
              <div class="col-9 pt-5 cat-table-wrap">
                <?php 
                  $all_cat = get_cat_all(); 
                  $cat_tree = build_tree($all_cat);
                  $cat_html = getItemTemplate($cat_tree);
                  $cat_select_html = getSelectTemplate($cat_tree);
                  //var_dump($cat_select_html);
                  // echo "<pre>";
                  // print_r($cat_tree);
                  // echo "</pre>";
                ?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col" width="5%" class="text-center">#</th>
                      <th scope="col" width="5%" class="text-center">ID</th>
                      <th scope="col" class="text-center">Заголовок</th>
                      <th scope="col" class="text-center">Slug</th>
                      <th scope="col" width="15%">&nbsp;</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?= $cat_html ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <!-- Форма добавления группы -->
                <div class="modal fade" id="addCatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="">Добавить категорию</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form>
                           <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Родительская категория</label>
                            <select class="form-select input-add-cat" id="input-add-cat_parent" aria-label="Default select example">
                              <option value="0" selected>Нет родителя</option>

                              <?= $cat_select_html ?>
                            </select>
                            <div class="invalid-feedback message-add-cat" id="message-add-cat_parent"></div>
                          </div>
                          <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Название</label>
                            <input type="text" class="form-control input-add-cat" id="input-add-cat_title">
                            <div class="invalid-feedback message-add-cat" id="message-add-cat_title"></div>
                          </div>
                          <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Slug</label>
                            <input type="text" class="form-control input-add-cat" id="input-add-cat_slug">
                            <div class="invalid-feedback message-add-cat" id="message-add-cat_slug"></div>
                          </div>
                          <div class="mb-3">
                            <label for="message-text" class="col-form-label">Описание</label>
                            <textarea class="form-control input-add-cat" id="input-add-cat_desc"></textarea>
                            <div class="invalid-feedback message-add-cat" id="message-add-cat_desc"></div>
                          </div>
                        </form>
                        <div id="add-cat-message-wrap">
                          <!-- <div class="alert alert-danger visually-hidden" role="alert" >A simple danger alert—check it out!</div> -->
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary" id="add-cat-btn">Сохранить</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Форма редактирования группы -->
                <div class="modal fade" id="editCatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="editcatModal">Редактировать группу</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Название</label>
                            <input type="text" class="form-control input-edit-cat" id="input-edit-cat_name">
                            <div class="invalid-feedback message-add-cat" id="message-add-cat_name"></div>
                          </div>
                          <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">URL</label>
                            <input type="text" class="form-control input-edit-cat" id="input-edit-cat_url">
                            <div class="invalid-feedback message-add-cat" id="message-add-cat_url"></div>
                          </div>
                          <div class="mb-3">
                            <label for="message-text" class="col-form-label">Описание</label>
                            <textarea class="form-control input-edit-cat" id="input-edit-cat_desc"></textarea>
                            <div class="invalid-feedback message-edit-cat" id="message-edit-cat_desc"></div>
                          </div>
                        </form>
                        <div id="edit-cat-message-wrap">
                          <!-- <div class="alert alert-danger visually-hidden" role="alert" >A simple danger alert—check it out!</div> -->
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="button" class="btn btn-primary" id="save-edit-cat-btn">Сохранить</button>
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
    <script src="/js/cat.js"></script>


  </body>
</html>