<?php

if (isset($_GET['method'])) {
  if ($_GET['method'] == 'checkEmail') {
    header('content-type: application/javascript; encoding:utf-8;');
    echo checkEmail($_GET['email'], $_GET['user_emails']);
  }
}

function checkEmail($email, $user_emails)
{  
  $all_emails = explode(",", $user_emails);

  foreach ($all_emails as $item) {
    if ($item == $email) {
      return json_encode(true);
    }
  }

  return json_encode(false);
}

//url for checkEmail : http://localhost/test/api.php?method=checkEmail&email=some.email@gmail.com&user_emails=all_user_email_array

 ?>