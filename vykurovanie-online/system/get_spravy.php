<?php 
  include ("connect.php");
  $spravy_get = mysqli_query($con,"SELECT * FROM `chat_vykurovanie` ORDER BY id DESC LIMIT 20") or die(mysqli_error($con));
  echo '<table style="width: 100%;">';
  	while($line = mysqli_fetch_assoc($spravy_get)){
			echo "<tr style='max-width: 100%;'>";
				$casik = date('d. M H:i',strtotime($line['time']));	
       echo "<td style='width:10%;'><i>". htmlspecialchars($casik). "</i>   </td>";
			echo "<td style='width:10%;'>[<i>" . htmlspecialchars($line['username'])."</i>]   </td>";
      echo "<td style='width:80%;'><i>" . htmlspecialchars($line['text'])."</i></td>";
			echo "</tr>";
		} 
  echo '</table>'; 
?>