<?php
    // session_start();
    // if(!$_SESSION['AUID']){
    //     echo "<script>
    //         alert('접근 권한이 없습니다.');
    //         location.href='./login.php'" 
    //     </script>";
    // };
   
  include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_header_head.php";
  include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_header.php";
  include $_SERVER["DOCUMENT_ROOT"]."/teapot/admin/inc/db.php";
?>
    <link rel="stylesheet" href="../css/my_class.css" />
<?php
  //현재 로그인한 유저의 정보 가져오기
  session_start();
  $username = $_SESSION['UNAME'];
  $userid = $_SESSION['UID'];
  $sql = "SELECT * FROM lms_user where userid = '$userid'" ;
  $result = $mysqli -> query($sql) or die("query error =>".$mysqli->error);
  $rs = $result -> fetch_object();

  //나의 클래스
  $sqlcut = "SELECT count(*) as ct FROM lms_sold where sold_uidx = '$userid'";
  $countresult = $mysqli -> query($sqlcut) or die("query error => ".$mysqli->error);
  $cls = $countresult ->fetch_object();

  //유저 좋아요 정보 + 클래스 정보 가져오기
    session_start();
    $userid = $_SESSION['UID'];
    // $sql = "SELECT lc.* from lms_lec lc join lms_favorite lf where lf.fv_uid='$userid'";
    $sql = "SELECT lc.* from lms_class lc join lms_favorite lf on lf.fv_clsnum=lc.clidx where lf.fv_uid='$userid'";
    $result = $mysqli -> query($sql) or die("query error =>".$mysqli->error);
    // $ls = $result -> fetch_object();
    while($ls = $result->fetch_object()){
      $rsc[]=$ls;
    }
  //유저 좋아요 정보 4개만 보여주기
  $userid = $_SESSION['UID'];
  $sql = "SELECT lc.* from lms_class lc join lms_favorite lf on lf.fv_clsnum=lc.clidx where lf.fv_uid='$userid'";
  $result = $mysqli->query($sql);
  $row = $result -> fetch_assoc();
  if(isset($_GET['page'])){
   $page = $_GET['page'];
 } else {
   $page = 1;
 }
 $pagesql = "SELECT count(*) as cnt FROM lms_favorite where fv_uid = '$userid'";
 $page_result = $mysqli->query($pagesql);
 $page_row = $page_result->fetch_assoc();
 $row_num = $page_row['cnt']; //전체 게시물 수
 
 $list = 4; //페이지당 출력할 게시물 수
 $block_ct = 3;
 $block_num = ceil($page/$block_ct);//page9,  9/5 1.2 2
 $block_start = (($block_num -1)*$block_ct) + 1;//page6 start 6
 $block_end = $block_start + $block_ct -1; //start 1, end 5
 
 $total_page = ceil($row_num/$list); //총42, 42/5
 if($block_end > $total_page) $block_end = $total_page;
 $total_block = ceil($total_page/$block_ct);//총32, 2
 
 $start_num = ($page -1) * $list;
    

  //유저 좋아요 갯수
  $sqlcut = "SELECT count(*) as cnt FROM lms_favorite where fv_uid = '$userid'";
  $countresult = $mysqli -> query($sqlcut) or die("query error => ".$mysqli->error);
  $like = $countresult ->fetch_object();

    //Q&A


?>
    <div id="user_profile">
      <div class="bg">
        <div class="mypage d-flex align-items-center justify-content-between">
          <div class="profile d-flex">
            <div class="profile_werp">
            <?php
                  if($rs->user_file == ''){
                ?>
                <div class="profileimg">
                  <img id="profile" src="../img/pabcon.png" style="width:95px; hight:95px;"/>
                </div>
                <?php
                }else{
                ?>
                <div class="profileimg">
                  <img src="<?php echo $rs->user_file?>" />
                </div>
                  <?php
                  }
                  ?>
            </div>
            <div class="profile_title">
              <h2><span class="suit_bold_l"><?php echo $rs->username?></span> 님</h2>
              <p>오늘도 티팟과 함께 화이팅!!</p>
            </div>
          </div>
          <div class="d-flex class_setting">
            <div class="cl_st">
              <div class="icon_text">
                <div class="icon"><i class="fa-solid fa-book-open"></i></div>
                <p>클래스 수강</p>
                <p><?php echo $cls->ct?></p>
              </div>
            </div>
            <div class="cl_st">
              <div class="icon_text">
                <div class="icon"><i class="fa-solid fa-q"></i></div>
                <p>질문</p>
                <p>1</p>
              </div>
            </div>
            <div class="cl_st">
              <div class="icon_text">
                <div class="icon"><i class="fa-solid fa-heart"></i></div>
                <p>좋아요</p>
                <p><?php echo $like->cnt?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <main class="d-flex align-items-start justify-content-center">
      <aside style="padding-top:200px;">
        <ul class="side_menu font_m">
          <li class="page"><a href="./user_my_page.php">My Page</a></li>
          <li>
            <a href="./my_class.php"
              ><i class="fa-solid fa-book-open-reader"></i>나의 클래스</a
            >
          </li>
          <li>
            <a href="./user_like.php"
              ><i class="fa-solid fa-heart"></i>좋아요</a
            >
          </li>
          <li>
            <a href="./user_ answer.php"
              ><i class="fa-regular fa-circle-question"></i>Q&A</a
            >
          </li>
          <li>
            <a href="./user_setting.php"
              ><i class="fa-solid fa-gear"></i>설정</a
            >
          </li>
        </ul>
      </aside>
      <!-- 나의 클래스 -->
      <div class="grid">
        <section id="user_cls">
          <div>
            <h3 class="font_ml">나의 클래스</h3>
            <a href="./my_class.php" class="btn">+ 더보기</a>
          </div>
          <div>
            <div class="card">
              <div class="img_wrap">
                <img src="./img/class1.jpg" class="card-img-top" alt="..." />
              </div>
              <div
                class="card-body d-flex justify-content-between align-items-center"
              >
                <p class="card-texts suit_rg_xs p-0">
                  [고급] 비즈니스 회화 - 일잘러들의 비밀무기
                </p>
                <div class="cls_bt"><span>학습중</span></div>
              </div>
            </div>
            <div class="card">
              <div class="img_wrap">
                <img src="./img/class2.jpg" class="card-img-top" alt="..." />
              </div>
              <div
                class="card-body d-flex justify-content-between align-items-center"
              >
                <p class="card-texts suit_rg_xs">
                  [초급]일상회화 짧은 문장으로 통하는 회화
                </p>
                <div class="cls_bt"><span>학습중</span></div>
              </div>
            </div>
            <div class="card">
              <div class="img_wrap">
                <img src="./img/class2.jpg" class="card-img-top" alt="..." />
              </div>
              <div
                class="card-body d-flex justify-content-between align-items-center"
              >
                <p class="card-texts suit_rg_xs">
                  [초급]일상회화 짧은 문장으로 통하는 회화
                </p>
                <div class="cls_bt"><span>학습중</span></div>
              </div>
            </div>
          </div>
        </section>
        <!-- //나의 클래스 -->
        <!-- 좋아요 -->
        <section id="user_like" class="content_my p_200">
          <div class="d-flex justify-content-between">
            <h3 class="font_ml">좋아요</h3>
            <?php if($rsc == ''){?>
              <a href="./lec/classroom.php" class="btn">클래스 가기</a>
              <?php }else{?>
                <a href="./user_like.php" class="btn">+ 더보기</a>
              <?php }?>
          </div>
          <?php if($rsc == ''){?>
            <div class="d-flex justify-content-center">
            <p>좋아요 목록이 없습니다.</p>
            </div>
            <?php }else{?>
          <div class="d-flex justify-content-between">
          <?php
              foreach($rsc as $r){
                $sqlc = "SELECT * from lms_class where cls_title='{$r->cls_title}'";
                $resultc = $mysqli->query($sqlc) or die("query error => ".$mysqli->error);
                while($rsc = $resultc->fetch_object()){
                  $rsca[]=$rsc;
                }
                // print_r($rsca);
                // foreach($rsca as $c){

            ?>
            <div class="card">
              <span> <i class="fa-solid fa-heart"></i></span>
              <img src="<?php echo $r-> thumb_url?>" class="card-img-top" alt="..." />
              <div class="card-body">
                <?php if($r->cls_price == 0){?>
                <div class="free">
                  <p class="card-text ">무료</p>
                </div>
                <?php }else{?>
                  <div class="d-flex justify-content-between">
                    <div class="sent">
                      <p class="card-text">유료</p>
                    </div>
                    <p class="card-texts num"><?php echo $r->cls_price?> 원</p>
                  </div>
                  <?php }?>
                <h5 class="card-title suit_rg_xs">
                  <?php echo $r-> cls_title?>
                </h5>
                <div class="btns">
                  <button class="btn-primary" onclick="window.open('/teapot/user/lec/classroom.php?idx=<?php echo $r->clidx?>')">바로가기</button>
                </div>
                <!-- <a href="#" class="btn-primary"></a> -->
              </div>
            </div>
            <?php }?>
          </div>
          <?php }?>
        </section>
        <!-- //좋아요 -->
        <!-- Q&A -->
        <section id="user_anwser" class="content_my">
        <div class="d-flex justify-content-between">
            <h3 class="font_ml">Q&A</h3>
            <a href="./user_answer.php" class="btn">+ 더보기</a>
          </div>
          <table class="table table-sm">
            <thead>
              <tr>
                <th scope="col">Q&A 내용</th>
                <th scope="col">클래스 제목</th>
                <th scope="col">날짜</th>
                <th scope="col">상태</th>
                <th scope="col">바로가기</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              
              <tr>
                <th>전치사 관련 질문입니다.</th>
                <td>클래스 제목</td>
                <td>2023.02.16</td>
                <td><span class="anwser">답변대기</span></td>
                <td><button class="anwser_btn">바로가기</button></td>
              </tr>
              <tr>
                <th>전치사 관련 질문입니다.</th>
                <td>클래스 제목</td>
                <td>2023.02.16</td>
                <td><span class="anwser">답변대기</span></td>
                <td><button class="anwser_btn">바로가기</button></td>
              </tr>
              <tr>
                <th>전치사 관련 질문입니다.</th>
                <td>클래스 제목</td>
                <td>2023.02.16</td>
                <td><span class="anwser">답변대기</span></td>
                <td><button class="anwser_btn">바로가기</button></td>
              </tr>
            </tbody>
          </table>
          
        </section>
      </div>
      <!-- //Q&A -->
    </main>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
      crossorigin="anonymous"
    ></script>
    <script>
      $('aside li').click(function(e){
        $(this).find('i').addClass('active');
        $('aside li').find('i').removeClass('active');
      });
      let num = $('.num');
      console.log(num);
      function addCommas(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      };
    </script>
  <?php 
include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_footer.php";
?>
<script></script>
<?php 
include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_footer_tail.php";
?>
