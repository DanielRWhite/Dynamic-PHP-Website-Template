<?php
class methods {

  public function iElement($tag, $pos) {
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

  public function arrayInsert($array, $index, $val) {
    $size = count($array); //because I am going to use this more than one time
    if (!is_int($index) || $index < 0 || $index > $size) {
      return -1;
    } else {
      $temp   = array_slice($array, 0, $index);
      $temp[] = $val;
    return array_merge($temp, array_slice($array, $index, $size));
    }
  }

  public function arrayToCsv( array &$fields, $delimiter = ',', $enclosure = '"', $encloseAll = false, $nullToMysqlNull = false ) {
    $delimiter_esc = preg_quote($delimiter, '/');
    $enclosure_esc = preg_quote($enclosure, '/');
    $output = array();
    foreach ( $fields as $field ) {
        if ($field === null && $nullToMysqlNull) {
            $output[] = 'NULL';
            continue;
        }
        // Enclose fields containing $delimiter, $enclosure or whitespace
        if ( $encloseAll || preg_match( "/(?:${delimiter_esc}|${enclosure_esc}|\s)/", $field ) ) {
            $output[] = $enclosure . str_replace($enclosure, $enclosure . $enclosure, $field) . $enclosure;
        }
        else {
            $output[] = $field;
        }
    }
    return implode( $delimiter, $output );
  }

}
?>
