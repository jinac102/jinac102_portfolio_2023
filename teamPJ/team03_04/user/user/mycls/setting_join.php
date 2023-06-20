<?php
session_start();
//db 연결
include $_SERVER["DOCUMENT_ROOT"]."/teapot/admin/inc/db.php";
include $_SERVER["DOCUMENT_ROOT"]."/teapot/admin/inc/coupon_lib.php";

//넘어온 값을 변수 지정
$userid = $_POST["user_id"];
$username = $_POST["username"];
$userfile = $_FILES["upfile"];
$userphone = $_POST["userphone"];
$email = $_POST["useremail"];
$uidx = $_POST['uidx'];
// $user_st = 1;
// $super = 0;

print_r($userid);
// print_r($username);
// print_r($userfile);
// print_r($userphone);
// print_r($email);
// print_r($uidx);

if ( $_FILES[ 'upfile' ] ) {
  $uploaded_file_name_tmp = $_FILES[ 'upfile' ][ 'tmp_name' ];
  $uploaded_file_name = $_FILES[ 'upfile' ][ 'name' ];
  // print_r($uploaded_file_name);
  $upload_folder =$_SERVER['DOCUMENT_ROOT']."/teapot/user/upload";
  move_uploaded_file( $uploaded_file_name_tmp, "$upload_folder/$uploaded_file_name");

  $profile_img = $_SERVER['DOCUMENT_ROOT']."/teapot/user/upload/".$uploaded_file_name;
}


  $sql = "UPDATE lms_user set 
  userid='{$userid}', username='{$username}', user_file='{$profile_img}', userphone='{$userphone}', email='{$email}' where uidx='$uidx'";
  $fs=$mysqli->query($sql) or die($mysqli->error);       
  // if($fs){
  //  echo "<script>
  //   alert('수정 되었습니다.');
  //   location.href='./user_setting.php';
  //   </script>";
  // };

?>