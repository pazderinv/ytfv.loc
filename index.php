<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <title>YTFV | Записи</title>

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
                <h4>Загрузить записи</h4>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                <div class="input-group">
                  <select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                    <option selected>Choose...</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                  <button class="btn btn-outline-secondary" id="select-channel" type="button">Выбрать</button>
                </div>
              </div>
              <div class="col-4">
                <div class="input-group">
                  <input type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                  <button class="btn btn-outline-secondary" type="button" id="upload-html-file">Загрузить файл</button>
                </div>
              </div>
              <div class="col-2 text-center">
                <button type="button" class="btn btn-outline-secondary" id="load-rec-file">Записи из файла</button>
              </div>
              <div class="col-2">
                <button type="button" class="btn btn-outline-secondary" id="load-rec-url">Записи по URL</button>
              </div>
            </div>
            <div class="row mt-5">
              <div class="col-12" id="table-rec-wrap">
                <table class="table table-bordered mt-3">
                  <thead>
                    <tr>
                      <th scope="col" class="text-end" width="2%">#</th>
                      <th scope="col" class="text-center">Заголовок</th>
                      <th scope="col">Мин.</th>
                      <th scope="col">web ID</th>
                      <th scope="col">Публикация</th>
                      <th scope="col" class="text-center" width="2%">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="check-all-rec">
                        </div>
                      </th>
                      <th scope="col" width="6%">
                        <a class="btn btn-secondary btn-sm" id="save-rec-check" href="#" role="button">
                         <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-save-fill" viewBox="0 0 16 16">
                            <path d="M8.5 1.5A1.5 1.5 0 0 1 10 0h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h6c-.314.418-.5.937-.5 1.5v7.793L4.854 6.646a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l3.5-3.5a.5.5 0 0 0-.708-.708L8.5 9.293V1.5z"/>
                          </svg>
                        </a>
                        <a class="btn btn-secondary btn-sm" id="delete-rec-checked" href="#" role="button">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                          </svg>
                        </a>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="row-rec-item" data-rec-item-id="">
                      <th scope="row" class="text-end">100</th>
                      <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, aliquid.</td>
                      <td>12:34</td>
                      <td>rf456gfvX</td>
                      <td>2 года 10 мес</td>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input check-rec-item" type="checkbox" value="">
                        </div>
                      </td>
                      <td>
                        <span class="del-row-item">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                          </svg>
                        </span>
                      </td>
                    </tr>
                    <tr class="row-rec-item" data-rec-item-id="">
                      <th scope="row" class="text-end">2</th>
                      <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam, voluptatem!</td>
                      <td>35:16</td>
                      <td>gMrf456gf</td>
                      <td>5 мес</td>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input check-rec-item" type="checkbox" value="">
                        </div>
                      </td>
                      <td>
                        <span class="del-row-item">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                          </svg>
                        </span>
                      </td>
                    </tr>
                    <tr class="row-rec-item" data-rec-item-id="">
                      <th scope="row" class="text-end">3</th>
                      <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque, placeat.</td>
                      <td>5:01</td>
                      <td>gMrf45Rh5</td>
                      <td>10 часов</td>
                      <td>
                        <div class="form-check">
                          <input class="form-check-input check-rec-item" type="checkbox" value="">
                        </div>
                      </td>
                      <td>
                        <span class="del-row-item">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                          </svg>
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div><!-- блок для загрузки таблицы -->
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="/js/bootstrap.bundle.min.js"></script>

  </body>
</html>