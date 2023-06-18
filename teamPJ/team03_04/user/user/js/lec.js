// ===================================
// 강의 목록 로딩
// ===================================
const curr = document.querySelector("#curriculum ul");
const more = document.querySelector(".more");

let j = 5;
lecIns(j);
more.addEventListener("click", () => {
  j += 5;
  lecIns(j);
});

function lecIns(j) {
  fetch("classroom_more_select.php", {
    method: "post",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "j=" + j + "&clidx=" + clidx,
  })
    .then((resp) => resp.json())
    .then((resp) => {
      curr.innerHTML = "";
      for (r of resp) {
        let li = document.createElement("li");
        curr.append(li);
        let liHead = document.createElement("div");
        liHead.classList.add("li-head", "d-flex", "justify-content-between");
        if (more.dataset.id === "auth" || r.status == 0) {
          let span = document.createElement("span");
          let aa = document.createElement("a");
          let div = document.createElement("div");
          let i = document.createElement("i");
          li.setAttribute("data-idx", `${r.lidx}`);
          li.append(liHead);
          liHead.prepend(span);
          liHead.appendChild(div);
          div.prepend(aa);
          div.appendChild(i);

          span.textContent = r.title;
          aa.textContent = "바로가기";
          aa.style.color = "#303740";
          aa.setAttribute(
            "href",
            `../class/lec_main.php?clidx=${clidx}&lidx=${r.lidx}`
          );
          i.classList.add("fa-solid", "fa-angle-down");
          // aa.event.stopPropagation();
          tsinsert(r.lidx);
        } else {
          let span = document.createElement("span");
          li.appendChild(liHead);
          liHead.appendChild(span);
          span.textContent = r.title;
        }
      }
    });
}
// ===================================
// 타임스탬프 삽입
// ===================================
function tsinsert(idx) {
  fetch("classroom_timestamp.php", {
    method: "post",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `lidx=${idx}`,
  })
    .then((resp) => resp.json())
    .then((resp) => {
      for (rs of resp) {
        if (rs.lidx) {
          let currli = curr.querySelectorAll("li");
          for (cl of currli) {
            if (rs.lidx == cl.dataset.idx) {
              let mn = `${rs.mn}`.padStart(2, "0");
              let sc = `${rs.sc}`.padStart(2, "0");
              let YTStamp = parseInt(mn) * 60 + parseInt(sc);
              cl.innerHTML += `<a href="../class/lec_main.php?clidx=${clidx}&lidx=${rs.lidx}&t=${YTStamp}" class="timestamp justify-content-between">
                            <span class="suit_rg_xs">
                            <span class="digit">${mn}</span> : <span class="digit">${sc}</span>
                            <b>${rs.ds}</b></span>
                            <span><i class="fa-solid fa-play"></i></span></a>`;
            }
          }
        }
      }
    });
}
// ===================================
// 타임스탬프 아코디언
// ===================================
setTimeout(() => {
  let currlio = curr.querySelectorAll("li");
  for (c of currlio) {
    c.addEventListener("click", (e) => {
      let timeStamp = e.currentTarget.querySelectorAll(".timestamp");
      for (ti of timeStamp) {
        ti.classList.toggle("d-flex");
      }
    });
  }
}, 500);
// ===================================
// 컨텐츠 탭 구문
// ===================================
if (more.dataset.id !== "auth") {
  let tabMenu = document.querySelectorAll(".tabs a");
  let tabContents = document.querySelectorAll(".lf_wrapper > section");
  tabContents[1].style.display = "none";
  for (tab of tabMenu) {
    tab.addEventListener("click", (e) => {
      e.preventDefault();
      let targetId = e.target.getAttribute("href");
      for (tm of tabMenu) {
        tm.classList.remove("active");
      }
      e.target.classList.add("active");

      for (tc of tabContents) {
        tc.style.display = "none";
      }
      document.querySelector(targetId).style.display = "block";
    });
  }
}
// ===================================
// 좋아요, 공유, 카트담기, 카트이동
// ===================================
let favIns = document.querySelector("#fav-ins");
let share = document.querySelector("#share");
let cartIns = document.querySelector("#cart-ins");
let cartA = document.querySelector("#cart-a");

cartA.addEventListener("click", () => {
  if (cartIns.classList.contains("inserted")) {
    alert("이미 장바구니에 담겨있습니다.");
  } else {
    let submitText = "결제화면으로 이동합니다.";
    cartInsert(submitText);
    location.href = "../cart/cart.php";
  }
});

cartIns.addEventListener("click", () => {
  if (cartIns.classList.contains("inserted")) {
    fetch("cart_del.php", {
      method: "post",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "clidx=" + clidx,
    })
      .then((resp) => resp.json())
      .then((resp) => {
        if (resp.result == "success") {
          alert("장바구니에서 제거하였습니다.");
          cartIns.classList.toggle("inserted");
        }
      });
  } else {
    let cartText = "강좌를 장바구니에 등록하였습니다.";
    cartInsert(cartText);
  }
});

function cartInsert(n) {
  fetch("cart_insert.php", {
    method: "post",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "clidx=" + clidx,
  })
    .then((resp) => resp.json())
    .then((resp) => {
      if (resp.result == "success") {
        alert(`${n}`);
        cartIns.classList.toggle("inserted");
      } else if (resp.result == "alert") {
        alert("먼저 로그인해주세요.");
      }
    });
}
share.addEventListener("click", () => {
  // navigator.clipboard.writeText(window.location.href);
  alert("클래스 주소를 복사하였습니다.(준비중)");
});

favIns.addEventListener("click", () => {
  if (favIns.classList.contains("inserted")) {
    fetch("fav_del.php", {
      method: "post",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "clidx=" + clidx,
    })
      .then((resp) => resp.json())
      .then((resp) => {
        if (resp.result == "success") {
          alert("좋아요를 취소하였습니다.");
          favIns.classList.toggle("inserted");
        }
      });
  } else {
    fetch("fav_insert.php", {
      method: "post",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "clidx=" + clidx,
    })
      .then((resp) => resp.json())
      .then((resp) => {
        if (resp.result == "success") {
          alert("좋아요 입력하였습니다.");
          favIns.classList.toggle("inserted");
        } else if (resp.result == "alert") {
          alert("먼저 로그인해주세요.");
        }
      });
  }
});
