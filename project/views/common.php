<?php

use neTpyceB\TMCms\Routing\Languages;
use neTpyceB\TMCms\Routing\Structure;
use neTpyceB\TMCms\Routing\View;

defined('INC') or exit;

class CommonView extends View
{
    public function index()
    {

    }

    public function header()
    {
        ?>
        <div class="header">
            <div class="header_lngs">
                <ul>
                    <?= $this->main_title ?>

                    <?php foreach (Languages::getPairs() as $k => $v): ?>
                        <li>
                            <a<?= $k == LNG ? ' class="selected"' : '' ?>
                                href="<?= Languages::getUrl($k) ?>"><?= $k ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="clear"></div>
            </div>
            <a class="logo" href="/">Logo here</a>
            <ul>
                <?php foreach (Structure::getMainMenu() as $v): ?>
                    <li>
                        <a href="<?= Structure::getPathById($v['id']) ?>"><?= $v['title'] ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="clear"></div>
        </div>
        <?php
    }
}