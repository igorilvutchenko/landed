<?php

$db = mysqli_connect('localhost', 'root', '', 'landed');

if (!$db)
	die('Не удалось подключиться к базе данных.');

$per_page = 2;
$page = $_GET['page'] ?? 1;
$offset = $page * $per_page - $per_page;
$limit = $per_page;

$sql = "
		SELECT * 
		FROM `users`
		";

$allUsers = mysqli_num_rows(mysqli_query($db, $sql));
$result = mysqli_query($db, $sql);
$counter = ceil($allUsers/$limit);

do {
	$j = $page*2 - $limit;

	$query = "
		SELECT *
		FROM `users`
		ORDER BY `id` ASC
		LIMIT {$offset}, {$limit}
		";

	$rowResult = mysqli_query($db, $query);
	while($row = mysqli_fetch_assoc($rowResult))
	{
	    $users[] =$row;
	}
	echo '<pre>';
	var_dump($users);
	echo '</pre>';
	echo "Страница: " . $page . "</br>";
	if ($page == $counter) {
		$page = 0;
	}

	$pagination = $page + 1;
	echo '<a href = "pagination.php?page=' . $pagination . '">' . $pagination . '</a>';
	break;
	} while ($j < $counter);
	
mysqli_close($db);