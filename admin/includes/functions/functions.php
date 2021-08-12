<?php

/*

	** Title Function
	** Has the Variable $pageTitle And Echo Default Title

*/


	function getTitle(){
		global $pageTitle;
		if(isset($pageTitle)){
			echo $pageTitle;
		}else{
			echo 'Default';
		}
	}




	/*

		** Redirect Function [This Function Accept Parameters ]
		** $errorMsg = Echo The Error Message[Error | Success | Warning]
		** $seconds = Seconds Before Redirect

	*/

	function redirectHome($theMsg, $url = null, $seconds = 3){
		if($url === null){
			$url = 'index.php';
			$link = 'Homepage';
		}else{

			if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== ''){
			$url = $_SERVER['HTTP_REFERER'];
			$link = 'Previous Page';
		}else{
			$url = 'index.php';
			$link = 'HomePage';
		}

		}
		echo $theMsg;
		echo "<div class='alert alert-info'> You Will Be Redirected To $link after $seconds Seconds.</div>";

		header("refresh:$seconds;url=$url");
		exit();
	}





	/*
		** Function To Check Item In Database
		** Check Item Function v1.0
		** $select = The Item To Select[Example: user, item, category]
		** $from = The Table To Select From[Example: users, items, categories]
		** $value = The Value of Select [Example: noureddine, box, electronics]

	*/

	function checkItem($select, $from, $value){
		global $con;
		$statement = $con->prepare("SELECT $select FROM $from WHERE $select = ?");
		$statement->execute(array($value));
		$count = $statement->rowCount();

		return $count;
	}



	/*
		** Check Number of Item v1.0
		** Function To Count Number Of Item Rows

	*/

	function countItems($item, $table){
		global $con;
		$stmt2 = $con->prepare("SELECT COUNT($item) FROM $table");
		$stmt2->execute();
		return $stmt2->fetchColumn();
	}
 ?>