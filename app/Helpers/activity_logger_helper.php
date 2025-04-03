<?php
function activity_logger_store($data)
{
	$db = \Config\Database::connect();

	$builder = $db->table('activity_logs');

	$builder->insert([
		'action' => $data['action'],
		'refer' => $data['refer'],
		'message' => $data['message'],
		'value' => $data['value'],
		'by' => $data['by']
	]);
}