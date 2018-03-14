<?php

$db = mysqli_connect('localhost', 'root', '', 'landed');

if (!$db)
	die('Не удалось подключиться к базе данных.');

if(!isset($_GET['page']))
{
	$page = 1;
}
else
{
	$page = $_GET['page'];
}

$sql = "
		SELECT * 
		FROM `users`
		";

$allUsers = mysqli_num_rows(mysqli_query($db, $sql));

$result = mysqli_query($db, $sql);
while($row = mysqli_fetch_assoc($result))
{
    $users[] =$row;
}

$counter = ceil($allUsers/$limit);
do {
	$j = $page*2 - 2;
		echo '<pre>';
		var_dump($users[$j]);
		echo '</pre>';

		echo '<pre>';
		var_dump($users[$j+1]);
		echo '</pre>';

		echo $page;
		if ($page == $counter) {
			$page = 0;
		}
		echo '<a href = "pagination.php?page=' . $page . '">' . $page . '</a>';
		break;
	} while ($i < $counter);
mysqli_close($db);