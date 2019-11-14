<?php
session_start();
echo 'Домашнее задание №3<br/><br/>';

function month($num){
	if($num == 1){
		return 'Январь';
	} elseif ($num == 2){
		return 'Февраль';
	} elseif ($num == 3){
		return 'Март';
	} elseif ($num == 4){
		return 'Апрель';
	} elseif ($num == 5){
		return 'Май';
	} elseif ($num == 6){
		return 'Июнь';
	} elseif ($num == 7){
		return 'Июль';	
	} elseif ($num == 8){
		return 'Август';
	} elseif ($num == 9){
		return 'Сентябрь';
	} elseif ($num == 10){
		return 'Октябрь';
	} elseif ($num == 11){
		return 'Ноябрь';
	} elseif ($num == 12){
		return 'Декабрь';
	}
}

$s = $_SESSION;
$gody = array(2, 3, 4);
// var_dump($s);

if (!empty($s['auth'])){  ?>
	<div>
		<p>Ваше имя:<span><?php echo $s['valid_name']; ?></span></p>
		<p>Ваше email:<span><?php echo $s['valid_email']; ?></span></p>
		<p>Вам: <span><?php echo $_SESSION['valid_age'];
                            echo in_array(substr($_SESSION['valid_age'], -1), $gody) ? ' года' : ' лет' ?></span>
        </p>
        <p>Ваш пол: <span><?php echo $s['valid_pol'] == 1 ? 'Мужчина' : 'Женщина' ?></span></p>
        <p>Ваше сообщение:<br><span><?php echo $s['valid_text']; ?></span></p>
        <div>
        	<a href="/feedbackForm3.php?exit=1">Назад к форме </a>
        </div>
    </div>

    <?php } else { ?>

<form action="/feedbackForm3.php" method="post">


<label for="id1">Укажите Ваше имя: </label>
<input id="id1" type="text" name="name" placeholder="Name" value="<?php echo !empty($s['valid_name']) ? $s['valid_name'] : ''; ?>" />
<?php
echo !empty($s['error_name']) ? '<span style="color: red;">'.$s['error_name'].'</span>' : ''; 
?>
</br>
<!-- ************************************************ -->
</br>
<label for="id2">Укажите Ваш email: </label>
<input id="id2" type="text" name="email" placeholder="example@gmail.com" value="<?php echo !empty($s['valid_email']) ? $s['valid_email'] : ''; ?>" />
<?php
echo !empty($s['error_email']) ? '<span style="color: red;">'.$s['error_email'].'</span>' : ''; 
?>
</br>
<!-- ************************************************ -->
</br>
<span>Укажите дату Вашего рождения: </span>
<select name="number">
	<option  disabled selected value="0">Число</option>
	<?php for($i = 1; $i <= 31; $i++){ ?>
	<option value="<?php echo $i ?>"<?php echo !empty($s['valid_number']) && $s['valid_number'] == $i ? 'selected' : ''; ?>><?php echo $i; ?> </option>
	<?php } ?>
	</select>
<?php
echo !empty($s['error_number']) ? '<span style="color: red;">'.$s['error_number'].'</span>' : ''; 
?>
<select name="month">
	<option disabled selected  value="0">Месяц</option>
	<?php for($i = 1; $i <= 12; $i++){ ?>
	<option value="<?php echo $i ?>"<?php echo !empty($s['valid_month']) && $s['valid_month'] == $i ? 'selected' : ''; ?>><?php echo month($i); ?> </option>
	<?php } ?>
	</select>
<?php
echo !empty($s['error_month']) ? '<span style="color: red;">'.$s['error_month'].'</span>' : ''; 
?>
<select name="year">
	<option disabled selected value="0">Год</option>
	<?php for($i = 1950; $i <= 2019; $i++){ ?>
	<option value="<?php echo $i ?>"<?php echo !empty($s['valid_year']) && $s['valid_year'] == $i ? 'selected' : ''; ?>><?php echo $i; ?> </option>
	<?php } ?>
	</select>
<?php
echo !empty($s['error_year']) ? '<span style="color: red;">'.$s['error_year'].'</span>' : ''; 
?>
</br>
<!-- ************************************************ -->
</br>
<span>Выберите пол: </span>
<input type="radio" name="pol" value="1" <?php echo !empty($s['valid_pol']) && $s['valid_pol'] == 1 ? 'checked' : ''; ?> /> M
<input type="radio" name="pol" value="2" <?php echo !empty($s['valid_pol']) && $s['valid_pol'] == 2 ? 'checked' : ''; ?>/> W

<?php
echo !empty($s['error_pol']) ? '<span style="color: red;">'.$s['error_pol'].'</span>' : ''; 
?>
</br>
<!-- ************************************************ -->
<p>Оставте отзыв: </p>
<textarea cols="30" rows="10" placeholder="Your message..." name="text">
	<?php echo !empty($s['valid_text']) ? $s['valid_text'] : ''; ?>
</textarea>
	<?php
		echo !empty($s['error_text']) ? '<span style="color: red;">'.$s['error_text'].'</span>' : ''; 
	?>
</br>

<!-- ************************************************ -->

	<button type="submit">Отправить</button>
</form>

 <?php } ?>