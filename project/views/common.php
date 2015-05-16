<?php
use neTpyceB\TMCms\Routing\Languages;
use neTpyceB\TMCms\Routing\Structure;
use neTpyceB\TMCms\Routing\View;

defined('INC') or exit;

class CommonView extends View {
	public function index() {
        $rss = new \neTpyceB\TMCms\Modules\RSS\ModuleRSS();
        echo $rss->publish();
	}

	public function header() {
		?>
			<div class="header">
                <div class="header_lngs">
                    <ul>
                        <?= $this->title ?>

                        <?php foreach (Languages::getPairs() as $k => $v): ?>
                            <li>
                                <a<?=$k == LNG ? ' class="selected"' : NULL?> href="<?=Languages::getUrl($k)?>"><?=$k?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="clear"></div>
                </div>
                <a class="logo" href="/<?=LNG?>/"><img src="<?= DIR_PUBLIC_URL ?>logo.png"></a>
                <ul>
					<?php foreach (Structure::getMainMenu() as $v): ?>
					    <li>
                                <a href="<?=Structure::getPathById($v['id'])?>"><?=$v['title']?></a>
                        </li>
					<?php endforeach; ?>
				</ul>
				<div class="clear"></div>
			</div>
        {{ a_variable }}
		<?php
	}
}