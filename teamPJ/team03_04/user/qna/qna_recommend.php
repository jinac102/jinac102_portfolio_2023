<?php 
    include $_SERVER['DOCUMENT_ROOT']."/teamPJ/teapot/user/inc/db.php";

    $qidx = $_POST['qidx'];
    $uid = $_POST['uid']; //uid 세션 불러오기

    $sql = "SELECT count(*) AS cnt from lms_qna_recommend where qr_qidx='{$qidx}' and uid='{$uid}'";
    $result = $mysqli->query($sql) or die("query error => ".$mysqli->error);
    $r = $result->fetch_object();


    if($r->cnt>0){
        $data = array('result' => 'error');
        echo json_encode($data);
    }else{
        $sql = "SELECT * FROM lms_qna where qidx='{$qidx}'";
        $result = $mysqli->query($sql) or die("query error => ".$mysqli->error);
        $r = $result->fetch_object();

        $new_recommend = $r->qna_recom +1;
    
        $sql = "UPDATE lms_qna set qna_recom='{$new_recommend}' where qidx='{$qidx}'";
        $result = $mysqli->query($sql) or die("query error => ".$mysqli->error);
    
    
        $sql1 = "INSERT INTO lms_qna_recommend (qr_qidx, uid) VALUES ('$qidx', '$uid')";
        $result1 = $mysqli->query($sql1) or die("query error => ".$mysqli->error);

        $data = array('result' => 'ok', 'recommend' => $new_recommend);
        echo json_encode($data);
    }
    
?>