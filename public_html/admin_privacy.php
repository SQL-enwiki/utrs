<?php 

error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('session.use_cookies', '1');

require_once('src/messages.php');
require_once('template.php');

//Template header()
skinHeader();

?>
<center><b><?php echo SystemMessages::$privpol_all['UTRSPrivPol'][$lang];?></b></center>
<p><?php echo SystemMessages::$privpol_admin['StepsForPrivacy'][$lang];?></p>

<h4><?php echo SystemMessages::$privpol_all['WikimediaLabsDisclaimerTitle'][$lang];?></h4>
<?php echo SystemMessages::$privpol_all['WikimediaLabsDisclaimer'][$lang];?>


<h4><?php echo SystemMessages::$privpol_all['WhatCollectTitle'][$lang];?></h4>
<?php echo SystemMessages::$privpol_admin['WhatCollect'][$lang];?>


<h4><?php echo SystemMessages::$privpol_all['DataStoreTitle'][$lang];?></h4>
<?php echo SystemMessages::$privpol_admin['DataStore'][$lang];?>

<h4><?php echo SystemMessages::$privpol_all['UserRightsTitle'][$lang];?></h4>
<?php echo SystemMessages::$privpol_admin['UserRights'][$lang];?>

<h4><?php echo SystemMessages::$privpol_all['ResponsibilityTitle'][$lang];?></h4>
<?php echo SystemMessages::$privpol_admin['Responsibility'][$lang];?>



<?php 

skinFooter();

?>