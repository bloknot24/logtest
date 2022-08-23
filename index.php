<?php

use app\classes\Add;
use app\interfaces\LoggerInterface;

function autoloader($class) {
    $class = str_replace("\\", "/", $class); // разница в начертании путей в OC
    $file = __DIR__ . "/$class.php";
    if(file_exists($file)) {
        require_once $file;
    }
}
spl_autoload_register('autoloader');

$add = new Add;

// Если система не работоспособна
$add->emergency('Авария');

// Если нужно срочно принять меры
$add->alert('Тревога');

// Если ошибка критическая
$add->critical('Критическая ошибка в ' . __FILE__ . ' и строке ' . __LINE__);

// Если просто какая-либо ошибка
$add->error('Ошибка в ' . __FILE__);

// Если просто предупреждение, не являющееся ошибкой
// $add->warning('Предупреждение в ' . __FILE__); // Пример в форме

// Если просто замечание
// $add->notice('Замечание в файле ' . __FILE__); // Пример в форме

// Если просто информационное сообщение
// $add->info('Сообщение отправлено'); // Пример в форме

// Информация про отладку
$add->debug('Отладка успешна');

$isSend = false;
if(isset($_POST['formId'])) {
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $name = htmlspecialchars($name);

        if(preg_match('/^[A-Za-zА-ЯЁа-яё0-9 .,!?]*$/iu', $name) == 0) {
            $error = 'Спецсимволы запрещены!';
            $add->warning('Возможно попытка SQL-инъекции'); // При попытке SQL-запроса получим лог в warning
        }
        elseif($name == '') {
			$error = 'Поле не может быть пустым!';
            $add->notice('Попытка не заполнить поле');
		} else {
            $isSend = true;
            $add->info("Сообщение $name успешно отправлено"); // Сообщение успешно отправлено и в лог info
            $log = $add->addInfo($name, $context = []);
            file_put_contents('logs/messages.log', $log . "\n", FILE_APPEND);
        }
    }
}

?>
<? if(!$isSend):?>
<form method="post">
    <label for="name">Oтпарвить сообщение:</label><br>
    <input type="text" name="name" value="<?=@$name?>">
    <input type="submit" name="formId" value="Отправить">
        <p><?=@$error?></p>
</form>
<? else: ?>
<p>Сообщение успешно отправлено!</p>
<a href="/">Назад</a>
<? endif; ?>
