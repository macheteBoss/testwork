# testwork

Адрес клиента: http://env-0320501.mycloud.by
Выполнен на Reacte.
Папка front.

Есть 2 страницы, на первой мы вводим адрес сайта и выбираем поле по которому парсим страницу. Вторая страница показывает всё что мы парсили.

Отображение мы можем настраивать. Модуль позволяет выставлять также настройки для отображения, а именно: мы можем выключать модуль, устанавливать ширину формы, местоположение её на странице, высоту поля ввода, цвет кнопки, цвет текста на кнопке, а также включать и выключать параметры по которым парсим (ссылки, картинки, блоки).

Войдём в битрикс: http://atesttim.vh115.hosterby.com/bitrix/
Логин: admin, пароль: 135798642Aa
Настройки -> Настройки модулей -> Поисковый модуль тегов.

Сам код модуля приложен в репозитории в папке roman.search . В папке api происходит ицициализация подключения.

Данные заносятся в БД. По какой-то причине на этом хостинге не хочет отдельно выдавать БД.
Поэтому проще будет перейти в панель управления хостингом и там зайти в БД.
https://user.hoster.by/services/hosting/
Логин: rburdilovskiy@mail.ru, пароль: 135798642Aa . 
Таблица в БД называется "b_search_test".
