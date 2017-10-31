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

  public function execute_file($code) {
    ob_start();
    print eval('?>'. file_get_contents($code));
    $output = ob_get_contents();
    foreach($_SESSION['settings'] as $item => $value) {
      if(strpos($output, '{' . $item . '}') !== false) {
        $output = str_replace('{' . $item . '}', $value, $output);
      }
    }
    ob_end_clean();
    print $output;
  }

}
?>
