<!-- content block -->
<div class="content">
	<?php
	if ($bid) {
		$result = $conn->query("SELECT id, title, content FROM page WHERE id = '$bid'");
	}
	$row = $result->fetch_assoc();
	echo $row['content'];
	?>
</div>
