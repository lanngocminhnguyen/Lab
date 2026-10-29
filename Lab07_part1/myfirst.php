<?php
   $marks = array (85, 95, 95);
   $marks[1] = 90;
   $ave = ($marks[0] + $marks[1] + $marks[2])/3;
   if ($ave >= 50) {
        $status = "PASSED";
   }
   else {
        $status = "FAILED";
   }
    echo "<p> The average score is $ave . You $status. </p>";
?>