//다크모드
var body = document.body;
var paths = document.querySelectorAll(".logo_img path");

function Dmode() {
  body.classList.toggle("dark");

  if (body.classList.contains("dark")) {
    paths.forEach(function (path) {
      path.setAttribute("fill", "#ffffff");
    });
  } else {
    paths.forEach(function (path) {
      path.setAttribute("fill", "#000b18");
    });
  }
}

// 마우스 이벤트 리스너 등록
document.addEventListener("mousemove", handleMouseMove);

var customCursor = document.getElementById("mouseCursor");

// 마우스 이동 이벤트 핸들러
function handleMouseMove(event) {
  var mouseX = event.clientX;
  var mouseY = event.clientY;

  var viewportWidth = window.innerWidth;
  var viewportHeight = window.innerHeight;

  // 마우스 위치가 뷰포트 영역을 벗어났을 때
  if (
    mouseX < 0 ||
    mouseX > viewportWidth ||
    mouseY < 0 ||
    mouseY > viewportHeight
  ) {
    customCursor.style.visibility = "hidden"; // 마우스 포인터 숨김
  } else {
    customCursor.style.visibility = "visible"; // 마우스 포인터 보임
    customCursor.style.top = mouseY + "px"; // 마우스 포인터 위치 업데이트
    customCursor.style.left = mouseX + "px";
  }
}

/* 링크 태그 hover시 마우스 스타일 변경 */
var linkTag = document.getElementsByClassName("link");
var lang = document.getElementsByClassName("lang")[0];
console.log(lang);
var langnav = document.getElementsByClassName("lang_nav")[0];

for (var i = 0; i < linkTag.length; i++) {
  linkTag[i].addEventListener("mouseenter", function () {
    customCursor.classList.add("mHover"); // 호버시 스타일을 담고 있는 클래스 추가
  });

  linkTag[i].addEventListener("mouseleave", function () {
    customCursor.classList.remove("mHover"); // 호버가 끝났을 때 클래스 제거
  });
}

lang.addEventListener("click", function () {
  langnav.classList.add("tog_open");

  langnav.addEventListener("mouseleave", function () {
    this.classList.remove("tog_open");
  });
});

/* sec02 */

var swiper = new Swiper(".mySwiper", {
  cssMode: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  // autoplay: {
  //   delay: 000,
  // },
  mousewheel: true,
  keyboard: true,
  rewind: true,
});
