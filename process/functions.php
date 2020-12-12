<?php
function singleQuote($text){
  $text = str_replace("'", "\'", $text);
  return $text;
}

function plus($text){
  $text = str_replace("+", "++", $text);
  return $text;
}

function stripper($str){
  $str = trim($str);
  $str = strip_tags($str);
  $str = htmlspecialchars($str);
  $str = stripslashes($str);
  $str = stripcslashes($str);
  return $str;
}

function pass($str){
  $str1 = md5($str);
  $str2 = hash('ripemd128', $str);
  $str = '$'.$str2.'.$'.$str1;
  return $str;
}

function randGen($len){
	$result = "";
    $chars = "0123456789abcdefghijklmnpqrstuvw0123456789";
    $charArray = str_split($chars);
    for($i = 0; $i < $len; $i++){
	    $randItem = array_rand($charArray);
	    $result .= "".$charArray[$randItem];
    }
    return $result;
}

function is_present($arr, $keyword) {
    foreach($arr as $index => $string) {
        if (strpos($string, $keyword) !== FALSE)
            return $index;
    }
}

function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}

function addNote($conn, $title, $msg, $user = 0){
  try{
    $query = $conn->prepare("INSERT into notifications (title, msg, target) values(:title, :msg, :user)");
    $query->execute(['title'=>$title, 'msg'=>$msg, 'user'=>$user]);
    return json_encode(["status"=>"success", "message"=>"Notification sent"]);
  }
  catch(PDOException $e){
    return json_encode(["status"=> "failed", "message"=>"Notification not sent".$e]);
  }
}

function loadFeed($elem, $arr){
  $feed = [];
  if($elem){
    for ($i=0; $i < count($arr); $i++) { 
      unset($elem[$arr[$i]]);
    }
    return $elem;
  }
  else{
    return $feed['data'] = "";
  }
}

function getMonth($date){
  $date = explode(" ", $date)[0];
  return explode("-", $date)[1];
}

function getMonthName($month){
  $month_array = array('01' => "Jan", '02'=>"Feb", "03"=>"Mar", "04"=>"Apr", "05"=>"May",
    "06" => "Jun", "07" => "Jul", "08"=>"Aug", "09" => "Sep", "10"=>"Oct", "11"=>"Nov", "12"=>"Dec"
  );

  if(array_key_exists($month, $month_array)){
    return $month_array[$month];
  }
  else{
    return false;
  }
}