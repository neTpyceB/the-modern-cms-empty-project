<?php
use neTpyceB\TMCms\Routing\View;

defined('INC') or exit;


class RegistrationView extends View {
	public function index() {
		$login = $this->getValue('login');
		?>
<form action="" method="post">
	<label>Login</label><input type="text" name="login">
	<br>
	<label>Password</label><input type="password" name="password">
	<br>
	<input type="submit">
</form>
		<?
	}
}