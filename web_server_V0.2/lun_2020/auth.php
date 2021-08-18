<?php
session_start();

function getLoginState(){
    if ( $_SESSION['auth'] == true ) {
        $data = [
          'loginState' => true
        ];
      } else {
        $data = [
          'loginState' => false
        ];
      }
      return $data;
}
if($_POST['mode']=='login'){
    if($_POST['username'] == 'teacher' && $_POST['password'] == 'dicdic' ){
      $_SESSION['auth'] = true;
    }
    $data = array_merge(getLoginState());
    echo json_encode($data);
}
if ( $_POST['mode'] == 'logout' ) {
    unset($_SESSION['auth']);
    echo 'logout success';
  }
  if ( $_POST['mode'] == 'getLoginState' ) {
    $data = getLoginState();
    echo json_encode($data);
  }
  if ( $_POST['mode'] == 'getAll' ) {
    //Get LoginState and UserProfile
    $data = array_merge(getLoginState());
    echo json_encode($data);
  }
?>