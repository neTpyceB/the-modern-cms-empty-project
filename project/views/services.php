<?php
use neTpyceB\TMCms\Routing\View;

defined('INC') or exit;

class ServicesView extends View {
	public function index() {
?>
        <h3><?= $this->title ?></h3>
        <div class="text"><?= $this->text ?></div>
        <div>
            Services of masters
            <br>
            Portretnaja, modelnaja, portfolio
            <br>
            Produkti
            <br>
            Katalogi, reklamnie materiali
            <br>
            Predmetnaja
            <br>
            Vijezdnaja - meroprijatija, reportazi, jubilei, torzestva, devicniki
            <br>
            Detskaja
            <br>
            Semejnaja
            <br>
            Arhiekturnaja
            <br>
            Eroticeskaja, nju, obnazennaja
            <br>
            Svadbi
            <br>
        </div>
<?
	}
}