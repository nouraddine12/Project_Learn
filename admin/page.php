<?php

 /*

	Gategories => {
	
		Manage
		Edit
		Update
		Add
		Instert
		Delete
		Stats
	}
 */

/*$do = '';
if(isset($_GET['do'])){

	$do = $_GET['do'];

}else{
	$do = 'Manage';
}

*/

$do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

if($do == 'Manage'){

	echo 'Manage';

}elseif($do == 'Edit'){

	echo 'Edit';

}elseif($do == 'Update'){

	echo 'Update';

}elseif($do == 'Add'){

	echo 'Add';

}elseif($do == 'Instert'){

	echo 'Instert';

}elseif($do == 'Delete'){

	echo 'Delete';

}elseif($do == 'Stats'){

	echo 'Stats';

}else{
	echo "Error No Page With This Name";
}
?>