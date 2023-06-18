<?php
  session_start();
  include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_header_head.php";
  include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_header.php";
  include $_SERVER["DOCUMENT_ROOT"]."/teapot/admin/inc/db.php";

   //현재 로그인한 유저의 정보 가져오기
   session_start();
   $username = $_SESSION['UNAME'];
   $userid = $_SESSION['UID'];
   $sql = "SELECT * FROM lms_user where userid = '$userid'" ;
   $result = $mysqli -> query($sql) or die("query error =>".$mysqli->error);
   $rs = $result -> fetch_object();
 
   //유저 좋아요 갯수
   $sqlcut = "SELECT count(*) as cnt FROM lms_favorite where fv_uid = '$userid'";
   $countresult = $mysqli -> query($sqlcut) or die("query error => ".$mysqli->error);
   $like = $countresult ->fetch_object();

   //유저 클래스 결제 갯수
   $sqlcut = "SELECT count(*) as ct FROM lms_sold where sold_uidx = '$userid'";
   $countresult = $mysqli -> query($sqlcut) or die("query error => ".$mysqli->error);
   $cls = $countresult ->fetch_object();


  //유저 장바구니 정보 + 클래스 정보 가져오기
  session_start();
  $userid = $_SESSION['UID'];
  // $sql = "SELECT lc.* from lms_lec lc join lms_favorite lf where lf.fv_uid='$userid'";
  $sql = "SELECT lc.* from lms_class lc join lms_sold ls on ls.sold_clidx=lc.clidx where ls.sold_uidx='$userid'";
  $result = $mysqli -> query($sql) or die("query error =>".$mysqli->error);
  // $ls = $result -> fetch_object();
  while($ls = $result->fetch_object()){
    $rsc[]=$ls;
  };

?>
    <link rel="stylesheet" href="../css/my_class.css" />
    <!-- 마이페이지 환영 문구 -->
    <div id="user_profile">
      <div class="bg">
        <div class="mypage d-flex align-items-center justify-content-between">
          <div class="profile d-flex">
            <div class="profile_werp">
            <?php
                  if($rs->user_file == ''){
                ?>
                <div class="profileimg">
                  <img src="../img/pabcon.png" style="width:95px; hight:95px;"/>
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
      <div>
        <section id="user_anwser" class="content_my p_200">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">클래스 제목</th>
                <th scope="col">클래스 내용</th>
                <th scope="col">상태</th>
              </tr>
            </thead>
            <tbody class="table-group-divider">
              <tr>
                <th>클래스 제목</th>
                <td>클래스 내용</td>
                <td>
                  <div><span class="class">대기중</span></div>
                </td>
                <td><button class="anwser_btn">바로가기</button></td>
              </tr>
              <tr>
                <td>클래스 제목</td>
                <td>클래스 내용</td>
                <td>
                  <div><span class="class">대기중</span></div>
                </td>
                <td><button class="anwser_btn">바로가기</button></td>
              </tr>
              <tr>
                <td>클래스 제목</td>
                <td>클래스 내용</td>
                <td>
                  <div><span class="class">대기중</span></div>
                </td>
                <td><button class="anwser_btn">바로가기</button></td>
              </tr>
              <tr>
                <td>클래스 제목</td>
                <td>클래스 내용</td>
                <td>
                  <div><span class="class">대기중</span></div>
                </td>
                <td><button class="anwser_btn">바로가기</button></td>
              </tr>
              <tr>
                <td>클래스 제목</td>
                <td>클래스 내용</td>
                <td>
                  <div><span class="class">대기중</span></div>
                </td>
                <td><button class="anwser_btn">바로가기</button></td>
              </tr>
              <tr>
                <td>클래스 제목</td>
                <td>클래스 내용</td>
                <td>
                  <div><span class="class">대기중</span></div>
                </td>
                <td><button class="anwser_btn">바로가기</button></td>
              </tr>
              <tr>
                <td>클래스 제목</td>
                <td>클래스 내용</td>
                <td>
                  <div><span class="class">대기중</span></div>
                </td>

                <td><button class="anwser_btn">바로가기</button></td>
              </tr>
            </tbody>
          </table>
        </section>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
      crossorigin="anonymous"
    ></script>
    <script>
      // $('aside li').click(function(e){
      //   e.preventDefault();
      //   $('aside li').find('i').removeClass('active');
      //   $(this).find('i').addClass('active');
      // })
    </script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
      crossorigin="anonymous"
    ></script>
    <?php 
include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_footer.php";
?>
<script></script>
<?php 
include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_footer_tail.php";
?>
