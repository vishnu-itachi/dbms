<!DOCTYPE html>
<html>

<body style="background=white">
	<h1 style="color=blue">My first PHP page</h1>
	<h1 style="color=blue">My second PHP page</h1>
	<?php
		require_once("connect.php");
		$result = mysqli_query($conn, "SELECT * from first;");
		echo $result->num_rows;
		mysqli_close($conn);
	?>
</body>

</html>