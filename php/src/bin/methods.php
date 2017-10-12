<?php
class methods {

  public function iElement($tag, $pos = "start") {
    switch($pos) {
      case 'start':
        print_r("<$tag>");
        break;
      case 'end':
        print_r("</$tag");
        break;
      default:
        print_r("<$tag>");
        break;
    }
  }

  public function urlArray() {
    return explode('/', ltrim($_SERVER['REQUEST_URI'], '/'), 15);
  }

  public function execute_php($code) {
    ob_start();
    print eval('?>'. file_get_contents($code));
    $output = ob_get_contents();
    ob_end_clean();
    print $output;
  }

}
?>
