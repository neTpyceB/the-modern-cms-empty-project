<?php
use neTpyceB\TMCms\Routing\View;

defined('INC') or exit;

class GalleryView extends View {
	public function index() {
?>
        <h3><?= $this->title ?></h3>
        <div class="text"><?= $this->text ?></div>
        <div>Galleries, list of every session</div>
<?
	}
}