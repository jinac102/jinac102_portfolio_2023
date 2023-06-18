<?php
  include $_SERVER['DOCUMENT_ROOT']."/teapot/admin/inc/db.php";
  error_reporting(E_ALL);
  ini_set("display_errors", 1);

  $i = $_POST['j'];
  $clidx = $_POST['clidx'];

  $que = "SELECT * FROM lms_lec where lec_clsnum = '$clidx' ORDER BY lidx ASC LIMIT $i";
  $res = $mysqli->query($que);
  
  $resp = array();
  while($obg = $res->fetch_object()){
    $resp[] = array('title' => $obg->lec_title, 'lidx'=>$obg->lidx, 'status'=>$obg->lec_st);
  }
  
  echo json_encode($resp);



 

  


?>