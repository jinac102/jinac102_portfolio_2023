<?php
  session_start();
  $_SESSION['TITLE'] = "lec_view";
  include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_header_head.php";
  
//   error_reporting( E_ALL );
?>
        <link rel="stylesheet" href="../css/lec_view.css" />
    </head>
    <body>
<?php

    $clidx = $_GET['clidx'];
    $lecidx = $_GET['lidx'];
   
    $sql= "SELECT ll.*, lc.* from lms_lec ll join lms_class lc on lc.clidx=ll.lec_clsnum where lc.clidx='$clidx'";
    $result = $mysqli -> query($sql) or die("query_error".$mysqli->error);
    $rs= $result->fetch_object();
?>

<header
        class="lec_view d-flex justify-content-between align-items-center"
    >
        <h2>
            <?php echo $rs -> cls_title; ?>
            <span>&#62;</span>
            <span class="sub_list"> <?php echo $rs -> lec_title; ?> </span>
        </h2>
        <div>
            <a
                href="../lec/classroom.php?clidx=<?php echo $rs -> clidx;?>"
                class="B_class d-flex justify-content-center align-items-center"
            >
                <p class="suit_rg_xs">클래스로 돌아가기</p>
                <div class="sprite back">
                    <span class="hidden">back class</span>
                </div>
            </a>
        </div>
</header>
<main class="d-flex">
    <div class="view_bg col-11">
        <iframe
            class="position-absolute top-0 left-0 youtube"
            width="100%"
            height="100%"
            src="https://www.youtube.com/embed/<?php echo $rs-> lec_href; ?>?mute=1"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen
        >
        </iframe>
    </div>
    <aside class="side_bar col-1">
        <ul class="asidebar_bg">
            <li class="aside_list">
                <div class="sprite list" type="button">
                    <span class="hidden">list</span>
                </div>
                <div id="lec_list" class="aside_con_bg">
                    <h3>
                        <?php echo $rs -> cls_title; ?>
                    </h3>
                    <div class="lec_p">
                        <?php 
                        
                        ?>
                        <p>
                            <span class="font_g">수강회차 :</span>
                            <?php echo $rs -> lidx;?>회차
                        </p>
                        <p class="mb20">
                            <span class="font_g">강의종류 :</span>
                            <?php 
                            if($rs->cls_st == 0){
                                echo '무료';
                            }else if($rs->cls_st == 1){
                                echo '유료';
                            }
                            ?>강의
                        </p>
                        <?php ?>
                    </div>
                    <div>
                        <h4 class="aside_subtit mtb20">
                            <?php echo $rs -> lec_title; ?>
                        </h4>
                        <ul class="d-flex list_lec pl0 flex-wrap">
                            <?php
                            
                                $stql="SELECT * from lms_timestamp where ts_lecnum='$lecidx'";
                                $stresul =  $mysqli -> query($stql) or die("query_error".$mysqli->error);
                                while($strs=$stresul->fetch_object()){
                                    $str[] = $strs;
                                }  
                                foreach($str as $sr){
                                    $mn = str_pad($sr->stp_minute, 2, "0", STR_PAD_LEFT);
                                    $sc = str_pad($sr->stp_second, 2, "0", STR_PAD_LEFT);
                                    $YTStamp = $sr->stp_minute * 60 + $sr->stp_second;
                            ?>
                                <li class="lec_list_bg col-1">
                                    <ul class="row pl0" onclick="location.href='lec_main.php?clidx=<?= $clidx; ?>&lidx=<?= $lecidx; ?>&t=<?= $YTStamp;?>';">
                                         <?php
                                        ?>
                                        <li class="col-3"><span class="digit"><?php echo $mn; ?></span>
                                        :
                                        <span class="digit"><?php echo $sc; ?></span></li>
                                        <li class="col-8"><?php echo $sr->stp_desc;?></li>
                                        <li class="col-1">
                                            <i class="fa-solid fa-caret-right"></i>
                                        </li>
                                    </ul>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="aside_qna">
                <div class="sprite qna" type="button">
                    <span class="hidden">qna</span>
                </div>
                <div id="qna_submit" class="aside_con_bg">

                        <h3 class="mb20">
                            <?php echo $rs -> cls_title; ?>
                        </h3>
                        <div class="lec_p">
                            <p>
                                <span class="font_g">수강회차 :</span>
                                <?php echo  $rs -> lidx;?>회차
                            </p>
                            <p class="mb20">
                                <span class="font_g">강의종류 :</span>
                                <?php 
                                if($rs->cls_st == 0){
                                    echo '무료';
                                }else if($rs->cls_st == 1){
                                    echo '유료';
                                }
                                ?>강의
                            </p>
                        </div>
                        <div>
                        <form action="../qna/qna_write_ok.php" method="POST">
                            <h4 class="aside_subtit mtb20">
                                빠른 질문하기
                            </h4>
                            <input type="hidden" name="cls_tit" value="<?php echo $rs -> cls_title; ?>"> 
                                <div class="submit_form">
                                    <input
                                        type="text"
                                        class="submit_style"
                                        placeholder="제목을 입력해주세요"
                                        name="title"
                                    />
                                    <textarea
                                        name="content"
                                        id="qna_text"
                                        cols="30"
                                        rows="10"
                                        class="submit_style"
                                        placeholder="내용을 입력해주세요"
                                        value=""
                                    ></textarea>
                                    <p class="qna_info">
                                        질문에 대한 답변이 달린 후에는 수정
                                        및 삭제가 어렵습니다. 또한 부적절한
                                        질문 및 내용은 동의 없이 삭제될 수
                                        있습니다.
                                    </p>
                                </div>
                                <div
                                    class="form_btn d-flex justify-content-end"
                                >
                                    <button class="btn_s_b suit_rg_s" type="submit">
                                        등록
                                    </button>
                                    <button class="btn_s_b suit_rg_s" id="lecview_qna_del" type="button">
                                        삭제
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </aside>
</main>
<footer class="lec_view lec_v_F d-flex justify-content-center align-items-center">

    <!-- 맨처음 | 마지막 강의면 버튼을 누를 수 없게 바꾸기  -->

    <div class="prev_lec d-flex align-items-center">
        <?php 
            //이전 강의 링크
            $prev_idx = $lecidx - 1;
            $prev_link = "../lec_main.php?clidx=$clidx&lidx=$prev_idx";
            
            //첫번째 강의일 경우 링크 비활성화
            if($lecidx == 1){
                echo `<i class="fa-solid fa-angles-left"></i>
                <a href="#" class="">이전강의</a>`;
            }else{
                echo `<i class="fa-solid fa-angles-left"></i>
                <a href=$prev_link>이전강의</a>`;
            }
        ?>
    </div>
    <div class="next_lec d-flex align-items-center">
        <?php
            //다음 강의 링크
            $next_idx = $lecidx + 1;
            $next_link = "../lec_main.php?clidx=$clidx&lidx=$next_idx";

            //마지막 강의일 경우 링크 비활성화

            if($lecidx == $last_idx){
                echo `<a href="#">다음강의</a>
                <i class="fa-solid fa-angles-right"></i>`;
            }else{
                echo `<a href=$next_link>다음강의</a>;
                <i class="fa-solid fa-angles-right"></i>`;
            }
        ?>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
    crossorigin="anonymous"
></script>
<script>
    $(".list").click(function () {
        $('#lec_list').fadeToggle();
        $('#qna_submit').fadeOut()
    });
    $(".qna").click(function () {
        $('#qna_submit').fadeToggle();
        $('#lec_list').fadeOut()
    });

    const getp = new URLSearchParams(window.location.search);
    const timeIns = getp.get("t");
    let ytf = document.querySelector('.youtube');
    if(timeIns){
        ytf.setAttribute('src',`https://www.youtube.com/embed/<?php echo $rs-> lec_href; ?>?autoplay=1&start=${timeIns}`);
    }
</script>
<?php 
  include $_SERVER['DOCUMENT_ROOT']."/teapot/user/inc/user_footer_tail.php";
?>