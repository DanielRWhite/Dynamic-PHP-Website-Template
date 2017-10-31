<?php
class UserInterface {


  public function generateInterface() {
    methods::iElement('html', 'start');
    if(empty($_SESSION['settings'])) {
      self::initializeSite();
    }
    self::generateHeaders();
    self::generateBody();
    methods::iElement('html', 'end');
  }

  private function initializeSite() {
    $tmp_array = array("array_set" => "true");
    $configuration_file = "../../settings/site.conf";
    foreach(file(getcwd() . "/../php/settings/site.conf") as $line) {
      if($line[0] !== "#") {
        $section = explode(" : ", $line);
        $tmp_array[$section[0]] = $section[1];
      }
    }
    $_SESSION['settings'] = $tmp_array;
  }

  private function generateHeaders() {
    methods::iElement('head', 'start');

    // Enter custom stylesheet & script locations here (directory from public/)
    $stylesheets = array(
      'css/en_default.css'
    );
    $scripts = array(
      'js/jquery.min.js'
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
      methods::execute_file('../php/html/items/toolbar.php'); // remove if your site doesn't require a toolbar/sidebar.
      switch($directory) {
        default: /** methods::execute_php('../php/html/sites/landing.php'); **/ break;
      }
    } else {
      methods::execute_file('../php/html/items/toolbar.php'); // remove if your site doesn't require a toolbar/sidebar.
      return false;
      /** methods::execute_php('../php/html/account/login.php'); **/
    }

    self::generateFooter(); // remove if your site doesn't require a footer.
    methods::iElement('body', 'end');
  }
}
?>
