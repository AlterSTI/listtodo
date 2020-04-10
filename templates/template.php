<?php
    /**
     * @var $arResult array
     */
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Список дел</title>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="templates/css/style.css"/>
</head>
<body>
<div class="calendar">
    <table id="calendar2">
        <thead>
        <tr><td>‹<td colspan="5"><td>›</tr>
        <tr><td>Пн</td><td>Вт</td><td>Ср</td><td>Чт</td><td>Пт</td><td>Сб</td><td>Вс</td></tr>
        <tbody>
    </table>
</div>
<div class="edit-form" data-item-id="0">
    <div class="edit-form-title">Создание нового дела</div>
    <table class="form-table">
        <tr>
           <th>Дата</th><th>Комментарий</th>
        </tr>
        <tr>
            <td class="date-input">
                <input type="date" name="date-input"/>
            </td>
            <td class="comment-area">
                <textarea name="comment-area-input">

                </textarea>
            </td>
        </tr>
    </table>
    <a href="#" class="button-save">Сохранить</a>
</div>
<div class="deals">
    <div class="deals-title">Список Дел</div>
    <?include_once 'table_template.php'?>
</div>
<footer>
    <script src="templates/js/calendar.js"></script>
    <script src="templates/js/ajax_request_ms.js"></script>
</footer>
</body>
</html>