<?php
use neTpyceB\TMCms\Routing\View;

defined('INC') or exit;

class FirstView extends View {
	public function index() {
?>
        <h3><?= $this->title ?></h3>
            <h3><?= $this->title2 ?></h3>
            <h3><?= $this->title3 ?></h3>


        <div class="text"><?= $this->text ?></div>
<?php
	}
}