
<!DOCTYPE html>

<?php
$active= "";

require('../components/database_connection.inc.php');

require('../components/header.inc.php');

include('../components/profile_body.inc.php');

require('../components/footer.inc.php');
?>

<title>Профил: <?php echo $userInfo['first_name'] . " " . $userInfo['last_name']?></title>