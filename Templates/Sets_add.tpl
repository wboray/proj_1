<? if(_form) { ?>
<form enctype="multipart/form-data" action="" method="post">
<input type="text" id="set_name" name="set_name"> Новая тематика<br><br>
<input type="submit" value="Добавить">
</form>
<? } else { echo _result; ?>

<?
} ?>

