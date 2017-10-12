<?php
class UserInterface {


  public function generateInterface() {
    methods::iElement('html', 'start');
    self::generateHeaders();
    self::generateBody();
    methods::iElement('html', 'end');
  }

  private function generateHeaders() {
    methods::iElement('head', 'start');

    // Enter custom stylesheet & script locations here (directory from public/)
    $stylesheets = array(
      'css/en_default.css'
    );
    $scripts = array(
      'js/jquery.min.js',
    );
    foreach($stylesheets as $link) {
      print_r("<link rel='stylesheet' type='text/css' href='$link'>");
    }
    foreach($scripts as $link) {
      print_r("<script type='text/javascript' src='$link'></script>");
    }
    methods::iElement('head', 'end');
  }

  private function generateBody() {
    methods::iElement('body', 'start');
    $directory = methods::urlArray()[0];

    // if they aren't signed in via $_SESSION, redirect them to the login page otherwise, redirect them to the landing page.
    if(!empty($_SESSION['email_address'])) {
      methods::execute_php('../php/html/items/toolbar.php'); // remove if your site doesn't require a toolbar/sidebar.
      switch($directory) {
        default: /** methods::execute_php('../php/html/sites/landing.php'); **/ break;
      }
    } else {
      return false;
      /** methods::execute_php('../php/html/account/login.php'); **/
    }

    self::generateFooter(); // remove if your site doesn't require a footer.
    methods::iElement('body', 'end');
  }
}
?>
