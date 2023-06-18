<?php
  session_start();
  $_SESSION['TITLE'] = "학습Q&A List";
  include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_header_head.php";
?>
<link rel="stylesheet" href="../css/qna/qna_list.css" />
<?php
  include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_header.php";
?>

<!-- pagination -->
<?php
  $qidx = $_GET['qidx'];
  $sql = "SELECT * FROM lms_qna WHERE qidx='{$qidx}'";
  $result = $mysqli->query($sql);
  $row = $result -> fetch_assoc();

  // Pagenation
  if(isset($_GET['page'])){
      $page = $_GET['page'];
  } else {
      $page = 1;
  }
  $pagesql = "SELECT COUNT(*) as qidx from lms_qna";
  $page_result = $mysqli->query($pagesql);
  $page_row = $page_result->fetch_assoc();
  //print_r($page_row['qidx']);
  $row_num = $page_row['qidx']; //전체 게시물 수

  $list = 10; //페이지당 출력할 게시물 수
  $block_ct = 5;
  $block_num = ceil($page/$block_ct);//page9,  9/5 1.2 2
  $block_start = (($block_num -1)*$block_ct) + 1;//page6 start 6
  $block_end = $block_start + $block_ct -1; //start 1, end 5

  $total_page = ceil($row_num/$list); //총42, 42/5
  if($block_end > $total_page) $block_end = $total_page;
  $total_block = ceil($total_page/$block_ct);//총32, 2

  $start_num = ($page -1) * $list;
  // echo ($start_num);
  //pagination

  $category = $_GET['search_type'];
  $keyword = $_GET['search_term'];
  if($category == "title"){
      $catname = "제목";
  }
  if($category == "content"){
      $catname = "내용";
  }
  if($category == "author"){
      $catname = "글쓴이";
  }

?>

<main>
<div class="banner">
    <div class="title content_container d-flex justify-content-between align-items-center">
        <div class="desc">
          <h2 class="suit_bold_xl">학습 Q&amp;A</h2>
          <p class="suit_rg_m">학습 관련한 궁금한 점은 무엇이든 물어보세요! Teapot이
      해결해드립니다.</p>
        </div>
        <div class="img">
          <img src="../img/qna/Question_banner.png" alt="question_mark" />
        </div>
    </div>
</div>
  <div class="lists qna_container">
    <p>- 학습 Q&amp;A 작성은 강의학습에서 가능합니다.</p>
    <ul>
        <?php
        // $qna_hit = $_POST[ 'qna_hit' ];
        // $qna_recom = $_POST[ 'qna_recom' ];
        // $sql = "INSERT INTO lms_qna (qna_hit, qna_recom) VALUES ('{$qna_hit}', '{$qna_recom}')";
        // $result = $mysqli->query($sql) or die("query error => ".$mysqli->error);

        // $sql = "SELECT * from lms_qna where qidx='".$qidx."'";
        // $result = $mysqli->query($sql) or die("query error => ".$mysqli->error);
        // $r = $result->fetch_object();
        // $r = $qna_hit[ 'qna_hit' ]+1;

        $sql = "SELECT * FROM lms_qna WHERE $category like '%keyword%' ORDER BY qidx asc limit $start_num,$list";
        $result = $mysqli->query($sql) or die("query error => ".$mysqli->error);
        while($rs = $result->fetch_object()){
            $rsc[]=$rs;
        }

        if(isset($rsc)){ 
            foreach($rsc as $r){
        ?>
        
        <li class="list" onclick="location.href='qna_read.php?qidx=<?php echo $r->qidx;?>'">
            <div>
                <div class="d-flex justify-content-between">
                    <div class="class_name_and_best d-flex gap-2 suit_rg_s">
                        <p class="class_name"><?php echo $r->qna_lecture;?></p>
                        <!-- 
                          <?php
                            // if(추천을 많이 받은 리스트 3개는){
                            //     echo "<p class='best'>BEST!</p>";
                            // }else{
                            //     그렇지 않으면 베스트는 없음
                            // }
                          ?>
                        -->
                    </div>
                    <p class="write_date"><?php echo $r->regdate;?></p>
                </div>
                <p class="question_title suit_bold_m">
                    <?php echo $r->qna_title;?>
                </p>
                <div class="d-flex justify-content-between suit_rg_s">
                  <div class="d-flex gap-3">
                    <div class="reply_status">
                        <?php if($r->reply_st == 0){ ?>
                            <p class="unanswered">답변대기</p>
                        <?php }else{  ?>
                            <p class="answered">답변완료</p>
                        <?php } ?>
                    </div>
                    <div class="hit d-flex gap-3 suit_rg_s">
                        <div class="views d-flex gap-2">
                            <p class="hit_title">조회수</p>
                            <p class="hit_number"><?php echo $r->qna_hit;?></p>
                        </div>
                        <div class="recommend d-flex gap-2">
                            <p class="hit_title">추천</p>
                            <p class="hit_number"><?php echo $r->qna_recom;?></p>
                        </div>
                    </div>
                  </div>
                    <p class="username"><?php echo $r->userid;?></p>
                </div>
            </div>
        </li>

        <?php } } ?>
    </ul>
  </div>



<!-- pagination -->
  <div class="pagination qna_container justify-content-center">
    <ul class="class_pg d-flex justify-content-center align-items-center gap-5">
        <?php
            if($page>1){
                if($block_num > 1){
                    $prev = ($block_num-2)*$list + 1;
                    echo "<li>
                    <a class='suit_bold_m' href='?page=$prev'
                      ><i class='fa-solid fa-angles-left'></i
                    ></a>
                  </li>";
                }
            }
            for($i=$block_start;$i<=$block_end;$i++){
                if($page == $i){
                    echo "<li><a href='?page=$i' class='suit_bold_m PG_num click'>$i</a></li>";
                }else{
                    echo "<li><a href='?page=$i' class='suit_bold_m PG_num'>$i</a></li>";
                }
            }
            if($page<$total_page){
                if($total_block > $block_num){
                    $next = $block_num*$list + 1;
                    echo "<li>
                    <a class='suit_bold_m' href='?page=$next'
                      ><i class='fa-solid fa-angles-right'></i
                    ></a>
                  </li>";
                }
            }
        ?>
    </ul>
  </div>

<!-- search_bar -->
  <div class="search qna_container d-flex justify-content-center">
        <form action="qna_search.php" method="GET">
          <select name="search_type" id="search_type" class="category">
            <option value="title">제목</option>
            <option value="content">내용</option>
            <option value="author">글쓴이</option>
          </select>
          <input
            type="search"
            name="search_term"
            id="search_term"
            class="search_bar"
            placeholder="검색어를 입력해주세요."
            required
          />
          <button class="btn_s_b suit_rg_s" type="submit">검색</button>
        </form>
      </div>
</main>


<?php 
  include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_footer.php";
?>
<script src="../js/qna.js"></script>
<?php 
  include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_footer_tail.php";
 ?>
  </body>
</html>