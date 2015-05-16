<?php
use neTpyceB\TMCms\Routing\View;

defined('INC') or exit;

class ContactsView extends View {
	public function index() {
?>
        <h3><?= $this->title ?></h3>
        <div class="text"><?= $this->text ?></div>
        <div>Phone, email, map, feedback form</div>
<?
	}
}