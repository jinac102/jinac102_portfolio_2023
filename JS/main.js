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
var subnav = document.getElementsByClassName("sub_nav")[0];

for (var i = 0; i < linkTag.length; i++) {
  linkTag[i].addEventListener("mouseenter", function () {
    customCursor.classList.add("mHover"); // 호버시 스타일을 담고 있는 클래스 추가
  });

  linkTag[i].addEventListener("mouseleave", function () {
    customCursor.classList.remove("mHover"); // 호버가 끝났을 때 클래스 제거
  });
}

lang.addEventListener("click", function () {
  subnav.classList.add("tog_open");

  subnav.addEventListener("mouseleave", function () {
    this.classList.remove("tog_open");
  });
});

/* section 2 
const sec2 = document.querySelector(".content");
const content = gsap.utils.toArray(".content ul > li");
// const texts = gsap.utils.toArray(".anim");
const mask = document.querySelector(".mask");

let scrollTween = gsap.to(content, {
  xPercent: -100 * (content.length - 1),
  ease: "none",
  scrollTrigger: {
    trigger: ".content",
    pin: true,
    scrub: 1,
    end: "+=3000",
    //snap: 1 / (sections.length - 1),
    markers: true,
  },
});

gsap.to(mask, {
  width: "105%",
  scrollTrigger: {
    trigger: ".content",
    start: "top left",
    scrub: 1,
  },
});

/*
// whizz around the sections
sections.forEach((section) => {
  // grab the scoped text
  let text = section.querySelectorAll(".anim");

  // bump out if there's no items to animate
  if (text.length === 0) return;

  // do a little stagger
  gsap.from(text, {
    y: -130,
    opacity: 0,
    duration: 2,
    ease: "elastic",
    stagger: 0.1,
    scrollTrigger: {
      trigger: section,
      containerAnimation: scrollTween,
      start: "left center",
      markers: true,
    },
  });
});*/

/* section 3 */
const prof = document.querySelector("#prof");
const profr = document.querySelector(".prof_R");
var profH = prof.offsetHeight;
const wy = window.pageYOffset;

window.addEventListener("scroll", function () {
  if (profH || wy) {
    profr.css({
      display: "fixed",
    });
  }
  console.log(profH);
  console.log(ws);
});
