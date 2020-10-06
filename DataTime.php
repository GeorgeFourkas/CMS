<?php
  date_default_timezone_set("Europe/Athens");
  $CurrentTime= time();
  $DateTime = strftime("%d-%B-%Y %H:%M:%S",$CurrentTime);
  echo $DateTime;
 ?>
