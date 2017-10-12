<?php
include 'src/bin/methods.php';
include 'src/requests/Request.php';
include 'src/user-interface/UserInterface.php';

class main {

  public function initialize() {
    if(Request::checkForRequest()) {
      Request::handleRequest();
    } else {
      UserInterface::generateInterface();
    }
  }

}
?>
