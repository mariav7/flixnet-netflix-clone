<?php
  require_once("PayPal-PHP-SDK/autoload.php");

  $apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
      'AWuJX94Ytc-iMyqG_4iTyV9FyIQgLC91gY6Af2OzrCL8KPHY3Mzv5DHJnBAsJ5IPjVw3uR3EROJkWJ2r', //Client ID
      'EPXEkXBCxjAvgphm7qLYiIz1_N6CvErIrUNX0o3BConQyZZZyJm5Tr9y4HMCK_UeZZvIeG6_ODfHZtpB' //Client Secret
    )
  );
?>