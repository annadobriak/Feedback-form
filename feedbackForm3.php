<?php
session_start(); 
if(!empty($_GET['exit'])){
	unset($_SESSION['auth']);
	header('Location: /feedbackTest3.php', true, 301);
exit;
}

//Валидация имени
if(!empty($_POST['name']) && mb_strlen($_POST['name']) >= 4 && mb_strlen($_POST['name']) <= 15 && (count(explode(' ', $_POST['name']))) > 0 && (count(explode(' ', $_POST['name']))) < 2){
	$_SESSION['valid_name'] = $_POST['name'];
	unset($_SESSION['error_name']);
} else{
	$_SESSION['error_name'] = 'Поле имени введено не верно!';
	unset($_SESSION['valid_name']);
}

//Валидация мыла
if(!empty($_POST['email']) && (count(explode('@', $_POST['email']))) == 2){
	$_SESSION['valid_email'] = $_POST['email'];
	unset($_SESSION['error_email']);
} else{
	$_SESSION['error_email'] = 'Поле email введено не верно!';
	unset($_SESSION['valid_email']);
}

//Валидация даты рождения
function the_day ($number, $month){
	if($month == 2){
		if($number <= 28){
			return true;
		} else{
			return false;
		}
	} elseif($month == 4 || $month == 6 || $month == 9 || $month == 11){
			if($number <= 30){
				return true;
			} else{
				return false;
			}
	}elseif($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12){
			if($number <= 31){
				return true;
			} else{
				return false;
			}																							
	} else{
	return false;
	}
}

if (!empty($_POST)){
	if(!empty($_POST['number']) && !empty($_POST['month']) && the_day($_POST['number'], $_POST['month'])){
		$_SESSION['valid_number'] = $_POST['number'];
		unset($_SESSION['error_number']);
	} else {
		$_SESSION['error_number'] = 'Введена не существующая дата!';
		unset($_SESSION['valid_number']);
	}
}

if (!empty($_POST['year']) && !empty($_POST['month']) && !empty($_POST['number'])) {
    $age = date('Y') - $_POST['year'];
    if ((date('m') - $_POST['month']) == 0 && (date('d') - $_POST['number']) < 0) {
        $_SESSION['valid_age'] = $age - 1;
    } elseif ((date('m') - $_POST['month']) < 0) {
        $_SESSION['valid_age'] = $age - 1;
    } else {
        $_SESSION['valid_age'] = $age;
    }
}


//Валидация пола
if(!empty($_POST['pol']) && ($_POST['pol'] == 1 || $_POST['pol'] == 2)){
	$_SESSION['valid_pol'] = $_POST['pol'];
	unset($_SESSION['error_pol']);
} else{
	$_SESSION['error_pol'] = 'Выберите пол!';
	unset($_SESSION['valid_pol']);
}

//Валидация текста
function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
    return str_replace($rus, $lat, $str);
}

if (!empty($_POST['text'])) {
    if (mb_strlen($_POST['text']) < 25) {
        $_SESSION['error_text'] = 'Cообщение должно содержать не менее 25 символов!';
        unset($_SESSION['valid_text']);
    } else {
        $_SESSION['valid_text'] = translit($_POST['text']);
        unset($_SESSION['error_text']);
    }
} else {
	$_SESSION['error_text'] = 'Не заполнено поле сообщения!';
	unset($_SESSION['valid_text']);
}

//*****************************************

if (!empty($_SESSION['valid_name']) && $_SESSION['valid_email'] && $_SESSION['valid_pol']  && $_SESSION['valid_number'] && $_SESSION['valid_text']){
	$_SESSION['auth'] = 1;
	
	unset($_SESSION['error_name']);
	unset($_SESSION['error_email']);
	unset($_SESSION['error_pol']);
	unset($_SESSION['error_number']);
	unset($_SESSION['error_text']);
}

header('Location: /feedbackTest3.php', true, 301);
exit;
?>



