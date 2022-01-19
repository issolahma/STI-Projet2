<?php

setcookie ("email", "", time() - 3600);
setcookie ("msgId", "", time() - 3600);
setcookie ("PHPSESSID", "", time() - 3600);

session_destroy();

header("Location: login.php");