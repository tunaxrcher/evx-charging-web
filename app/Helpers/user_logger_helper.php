<?php
function logger_store($data)
{
	$db = \Config\Database::connect();

	$builder = $db->table('user_logs');

	$builder->insert([
		'event_id' => get_event_id($data['event']),
		'detail' => $data['detail'],
		'ip' => $data['ip'],
		'user_id' => $data['user_id'],
		'username' => $data['username']
	]);
}

// function getLogAll()
// {
// 	$EmployeeLogModel = new \App\Models\EmployeeLogModel();
// 	$data['employee_log_otday'] = $EmployeeLogModel->getEmployeeLogTodayAllday();

// 	$data['js_critical'] = '<script src="' . base_url('/assets/app/js/employee/employeeLog.js') . '"></script>';
// 	return $data;
// }

function get_event_id($event)
{
	$event_id = 0;

	switch ($event) {
		case 'เข้าสู่ระบบ':
			$event_id = 1;
			break;

		case 'ออกจากระบบ':
			$event_id = 2;
			break;

		case 'เพิ่ม':
			$event_id = 3;
			break;

		case 'อัพเดท':
			$event_id = 4;
			break;

		case 'ลบ':
			$event_id = 5;
			break;

		default:
			$event_id = 6;
	}

	return $event_id;
}