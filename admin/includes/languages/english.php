<?php 

function lang($phase){
	static $lang = array(
		'ADMIN AREA' => 'Admin Area',
		'LOGS' => 'Logs',
		'ADMIN' => 'Admin',
		'GATEGORY' => 'Gategory',
		'HOME' => 'Home',
		'DASHBOARD' => 'Dashboard',
		'SETTINGS' => 'Settings',
		'LOUGOUT' => 'Logout',
		'EDIT PROFILE' => 'Edit Profile',
		'MEMBERS' => 'Members',
		'STATISTICS' => 'Statistics',
		'ITEMS' => 'Items',
		'USERNAME' => 'Username',
		'PASSWORD' => 'Password',
		'EMAIL' => 'Email',
		'FULL NAME' => 'Full Name',
		'UPDATE_' => 'Update',
		'ADD_' => 'Add',
		'' => '',
		'' => '',
	);
	return $lang[$phase];
}

 ?>