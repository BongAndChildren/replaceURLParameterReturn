<?
# URL query 분석 [http://php.net/manual/kr/function.parse-url.php]
if(!function_exists('parse_query')) {
function parse_query($var) {
  /**
   *  Use this function to parse out the query array element from
   *  the output of parse_url().
   */
  $var  = parse_url($var, PHP_URL_QUERY);
  $var  = html_entity_decode($var);
  $var  = explode('&', $var);
  $arr  = array();

  foreach($var as $val) {
    $x          = explode('=', $val);
    $arr[$x[0]] = $x[1];
  }
  unset($val, $x, $var);
  return $arr;
}
}

# 보기 방식에 따른 URL 리턴
# mode : scale, mode, sort
# value : 24,40,80,list,imgs,album,date,view,subject
if(!function_exists('getURLType')) {
function getURLType($mode, $value) {
  global $_SERVER;

  $aURLquery = parse_query($_SERVER['REQUEST_URI']);
  $aURLquery[$mode] = $value;

  $aQuery = array();
  foreach($aURLquery as $key=>$val) {
    if($val) $aQuery[] = $key."=".$val;
  }

  $url_query = $_SERVER['PHP_SELF']."?".implode('&',$aQuery);

  return $url_query;
}
}
?>