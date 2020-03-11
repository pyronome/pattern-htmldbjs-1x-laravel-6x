<?php

namespace App;

class HTMLDB
{
    public $errorCount = 0;
    public $messageCount = 0;
    public $lastError = '';
    public $lastMessage = '';
    public $list = [];
    public $columns = [];

	public function printHTMLDBList() {

		$count = count($this->list);
		$columnCount = count($this->columns);

		$rows = [];

		for ($i = 0; $i < $count; $i++) {
			$rows[$i] = [];
			for ($j = 0; $j < $columnCount; $j++) {
				$rows[$i][$j] = htmlspecialchars_decode($this->list[$i][$this->columns[$j]]);
			} // for ($j = 0; $j < $columnCount; $j++) {
		} // for ($i = 0; $i < $count; $i++) {

		$arrayJSON = [
				'c' => $this->columns,
				'r' => $rows];

		$content = rawurlencode(json_encode($arrayJSON,
				JSON_HEX_QUOT |
				JSON_HEX_TAG |
				JSON_HEX_AMP |
				JSON_HEX_APOS));

		echo $content;

	}

	public function printResponseJSON() {

		$arrayJSON = [
				'lastMessage' => $this->lastMessage,
				'messageCount' => $this->messageCount,
				'errorCount' => $this->errorCount,
				'lastError' => $this->lastError];

		$content = rawurlencode(json_encode($arrayJSON,
				JSON_HEX_QUOT |
				JSON_HEX_TAG |
				JSON_HEX_AMP |
				JSON_HEX_APOS));

		echo $content;

	}
}