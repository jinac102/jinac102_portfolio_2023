<?php
  session_start();
  $_SESSION['TITLE'] = "class list";
  include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_header_head.php";
  $uid =$_SESSION['UID'];
   error_reporting( E_ALL );
?>
    <link rel="stylesheet" href="../css/class.css" />
    <?php
  include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_header.php";
?>

<?php


        // Pagenation
        if(isset($_GET['page'])){
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $pagesql = "SELECT COUNT(*) as clidx from lms_class";
        $page_result = $mysqli->query($pagesql);
        $page_row = $page_result->fetch_assoc();
        //print_r($page_row['qidx']);
        $row_num = $page_row['clidx']; //전체 게시물 수

        $list = 5; //페이지당 출력할 게시물 수
        $block_ct = 5;
        $block_num = ceil($page/$block_ct);//page9,  10/5 2
        $block_start = (($block_num -1)*$block_ct) + 1;//page6 start 6
        $block_end = $block_start + $block_ct -1; //start 1, end 5
        $total_page = ceil($row_num/$list); //총42, 42/5
        if($block_end > $total_page) $block_end = $total_page;
        $total_block = ceil($total_page/$block_ct);//총32, 2
        $start_num = ($page -1) * $list;
        // echo ($start_num);

        $cls1 = "SELECT * FROM lms_class";
        $result = $mysqli->query($cls1);
        while($rs=$result->fetch_object()) {
            $rsc[]=$rs;
        }
    ?>
<main>
    <div class="banner">
        <div class="title content_container d-flex justify-content-between align-items-center">
            <div class="desc">
              <h2 class="suit_bold_xl">클래스</h2>
              <p class="suit_rg_m">Teapot에서만 들을 수 있는 수업! 지금 신청해보세요.</p>
            </div>
            <div class="img">
              <img src="../img/cls/class_banner.png" alt="클래스 배너 아이콘 이미지">
            </div>
        </div>
      </div>
            <section class="tb150">
                <h2 class="hidden">class</h2>
                <div class="cls_wrap">
                    <div id="filters" class="button-group d-flex justify-content-end">
                        <button class="button is-checked" data-filter=".free">무료</button>
                        <button class="button" data-filter=".pay">유료</button>
                    </div>
                    <div id="sorts" class="cls_ch_btn d-flex justify-content-end button-group">
                          <button class="button is-checked" data-sort-by="*">전체</button>
                          <button class="button" data-sort-by="ch_jr">초급</button>
                          <button class="button" data-sort-by="ch_mid">중급</button>
                          <button class="button" data-sort-by="ch_high">고급</button>
                    </div>
                    <?php foreach($rsc as $rs){ 
                        $clidx = $rs->clidx;
                      ?>    
                        <div class="cls_list" data-category="<?php 
                        if($rs->cls_st == 0){
                            echo 'free';
                        }else if($rs->cls_st == 1){
                            echo 'pay';
                        }
                        ?>">
                            <div class="DP_shadow row">
                                <div class="col-6 cls_tit_content">
                                    <div class="suit_rg_s d-flex catenlike">
                                        <p class="cls_cate suit_rg_s"><?php echo $rs->cls_cat; ?></p>
                                        <?php 
                                        $fque = "SELECT count(*) AS cnt FROM lms_favorite WHERE fv_clsnum = '$clidx' and fv_uid = '$uid'"; 
                                        $fres = $mysqli->query($fque) or die("query_error" . $mysqli->error);
                                        $fraw =  $fres->fetch_object();
                                        $cnt = $fraw->cnt;
                                        if($cnt == 0){
                                        ?>
                                          <div class="sprite like fav" data-id="<?= $clidx; ?>">
                                              <span class="hidden">like</span>
                                          </div>
                                        <?php } else {?>
                                          <div class="sprite like check fav" data-id="<?= $clidx; ?>">
                                            <span class="hidden">like</span>
                                        </div>
                                      <?php }?>  
                                    </div>
                                    <p class="suit_rg_m"><?php echo $rs->cls_title;?></p>
                                    <p class="suit_rg_s"><?php                               
                                            $cls_text = strip_tags( $rs->cls_text );
                                            if (strlen($cls_text) > 26) {
                                                $cls_txt = iconv_substr($cls_text, 0, 26) . "...";
                                            }
                                            echo $cls_txt;
                                    ?></p>
                                    <div class="suit_rg_s btn_s_p more_btn"><a href="../lec/classroom.php?clidx=<?php echo $rs->clidx; ?>"> 더보기 &#62; </a></div>
                                </div>
                                <div class="col-6 cls_thumb">
                                    <img
                                        src="<?php echo $rs->thumb_url;?>"
                                        alt="클래스 썸네일"
                                    />
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </section>
        </main>

<?php 
  include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_footer.php";
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>

<script>
    let favIns=document.querySelectorAll('.fav');

  for(fav of favIns){

    fav.addEventListener("click", (e) => {
      let clidx = e.target.getAttribute('data-id');
          console.log(clidx);
        if (e.target.classList.contains("check")) {
          
            fetch("like_del.php", {
                method: "post",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "clidx=" + clidx,
            })
                .then((resp) => resp.json())
                .then((resp) => {
                    if (resp.result == "success") {
                        alert("좋아요를 취소하였습니다.");
                        e.target.classList.toggle("check");
                    }
                });
        } else {
            fetch("like_up.php", {
                method: "post",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "clidx=" + clidx,
            })
                .then((resp) => resp.json())
                .then((resp) => {
                    if (resp.result == "success") {
                        alert("좋아요 입력하였습니다.");
                        e.target.classList.toggle("check");
                    } else if (resp.result == "alert") {
                        alert("먼저 로그인해주세요.");
                        location.href="../../login.php";
                    }
                });
        }
    });
  }

    //filter 
    $('.cls_cate').each(function(){
      const catText = $(this).text().trim();

      if(catText.includes('초급')){
        $(this).closest('.cls_list').addClass('ch_jr');
      }else if(catText.includes('중급')){
        $(this).closest('.cls_list').addClass('ch_mid');
      }else if(catText.includes('고급')){
        $(this).closest('.cls_list').addClass('ch_high');
      }
  });

        // isotope 라이브러리
        var $grid = $('.cls_wrap').isotope({
      itemSelector: '.cls_list',
      layoutMode: 'fitRows',
      getSortData: {
        ch_jr: '.ch_jr',
        ch_mid: '.ch_mid',
        ch_high: '.ch_high',
      category: '[data-category]',
  }
});

        // 필터
        var filterFns = {
          // show if number is greater than 50
          numberGreaterThan50: function () {
            var number = $(this).find(".number").text();
            return parseInt(number, 10) > 50;
          }
        };

  // bind filter button click
  $('#filters').on( 'click', 'button', function() {
  var filterValue = $( this ).attr('data-filter');
  // use filter value directly
  $grid.isotope({ filter: filterValue });
});

  // bind sort button click
  $('#sorts').on( 'click', 'button', function() {
    var sortByValue = $(this).attr('data-sort-by');
    $grid.isotope({ sortBy: sortByValue });
  });

</script>
<?php 
  include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_footer_tail.php";
?>