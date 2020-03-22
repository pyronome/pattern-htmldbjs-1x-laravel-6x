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

	public function requestPOSTRow($requests = NULL,
			$prefix = '',
			$protectedColumns = [],
			$forceNew = false)
	{
		$row = [];

		$requestKeys = array_keys($requests);
		$requestKeyCount = count($requestKeys);

		for ($i = 0; $i < $requestKeyCount; $i++) {
			if (in_array($requestKeys[$i], $protectedColumns)) {
				continue;
			} // if (in_array($requestKeys[$i], $protectedColumns)) {
			$row[$requestKeys[$i]] = $requests[$requestKeys[$i]];
		} // for ($i = 0; $i < $requestKeyCount; $i++) {

		if (isset($requests[$prefix . 'id'])) {
            $row['id'] = intval($requests[$prefix . 'id']);
		} else {
			$row['id'] = 0;
        } // if (isset($requests[$prefix . 'id'])) {

        if ($forceNew) {
            $row['id'] = 0;
        } // if ($forceNew) {

		return $row;
	}

	public function assignRowToObject(&$object, $row) {
		$rowKeys = array_keys($row);
		$rowKeyCount = count($rowKeys);
		$property = '';

		for ($i = 0; $i < $rowKeyCount; $i++) {
			$property = $rowKeys[$i];
			if (property_exists($object, $property)) {
				$object->$property = $row[$property];
			} // if (property_exists($object, $property)) {
		} // for ($i = 0; $i < $rowKeyCount; $i++) {

		return;
	}
}