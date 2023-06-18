//SH menu slide
let menus = document.querySelector('.menu')
let mainMenu = document.querySelectorAll('nav > div .menu > li');
let header = document.querySelector('header');
let headerHeight = header.offsetHeight;
let subMenu = document.querySelectorAll('nav > div .menu ul');
let subMenuHeight = 0;

//menu-small
let logo = document.querySelector('#logo');
//banner slide
let slideWrapper = document.querySelector('.slide_wrapper');
let slideContainer = slideWrapper.querySelector('.slide-container');
let slide = slideContainer.querySelectorAll('li');
let slideBtn = slideWrapper.querySelector('.slide_btn');
let slideBtned = slideWrapper.querySelector('.slideBtn');
let prevBtn = slideWrapper.querySelector('#prev');
let nextBtn = slideWrapper.querySelector('#next');

let slideCount = slide.length;
let currentIdx = 0;
let timer;
let pagerHTML = '';


//pop-up topBtn
let btt = document.querySelector('aside');
let scrollAEL;

//section1
let bestMenuWrapper = document.querySelector('#best .container .best_menu_list'),
    menuList = bestMenuWrapper.querySelector('.menu_list'),
    menu = menuList.querySelectorAll('li');

    for(let mn of menu){
        mn.addEventListener('click',(e)=>{
            e.preventDefault();
            for(let mn2 of menu){
                mn2.classList.remove('active');
            };
            e.currentTarget.classList.add('active');
        });
    }

window.addEventListener('scroll', ()=>{
    scrollAEL = window.pageYOffset;
    // console.log(scrollAEL);
    //1650

    scrollAEL > 1650 ? btt.classList.add('active'):btt.classList.remove('active');
});


//menu slide
for(sm of subMenu){
    if(subMenuHeight < sm.offsetHeight){
        subMenuHeight = sm.offsetHeight;
    };
};

for(m of mainMenu){
    m.addEventListener('mouseenter',()=>{
        if(window.pageYOffset < 1902){
            header.style.height =`${headerHeight + subMenuHeight}px`;
        }
    });
    m.addEventListener('mouseleave',()=>{
        header.style.height =`${headerHeight}px`;
    })
}

//menu-small
let excuted = false;

window.addEventListener('scroll',()=>{
    if(window.pageYOffset > 1902){
        if(excuted == false){
            header.classList.add('fixed');
            excuted = true;
        }
    }else{
        header.classList.remove('fixed');
        excuted = false;
    }
});

function changeLogo(newLogo){
    logo.classList.add('hide');

    setTimeout(()=>{
        logo.setAttribute('src', newLogo);
        logo.classList.remove('hide');
    }, 400);
}


//slide a 버튼
slide.forEach((item,idx)=>{
    item.style.left = `${idx*100}%`

    pagerHTML += `<a href="">${idx}</a>`
});

slideBtn.innerHTML = pagerHTML;
let slideBtns = slideBtn.querySelectorAll('a');

//슬라이드 옆으로 이동
function goToslide(idx){
    slideContainer.style.left = `${-100*idx}%`
    currentIdx = idx;
    update()

    
}


//slideBtn and slide
function update(){
    slideBtns[currentIdx].classList.add('active');
    for(let i of slideBtns){
        if(i != slideBtns[currentIdx]){
            i.classList.remove('active');
        }else{
            i.classList.add('active');
        }
    }
    //슬라이드가 끝나거나 시작할 때 버튼이 없어짐
    if(currentIdx == 0){
        prevBtn.classList.add('disabled');
    }else{
        prevBtn.classList.remove('disabled');
    }
    if(currentIdx == slideCount -1){
        nextBtn.classList.add('disabled');
    }else{
        nextBtn.classList.remove('disabled');
    }
}
update();

// slideBtn a
slideBtns.forEach((item,idx)=>{
    item.addEventListener('click',(e)=>{
        e.preventDefault();
        goToslide(idx);
    })
})



//slide prev,next
prevBtn.addEventListener('click',(e)=>{
    e.preventDefault();
    goToslide(currentIdx - 1)
})
nextBtn.addEventListener('click',(e)=>{
    e.preventDefault();
    goToslide(currentIdx + 1)
})




//timer
function autoSlide(){
    timer = setInterval(()=>{
        let nextIdx = (currentIdx + 1)%slideCount;
        goToslide(nextIdx);
    },4000)
} 
autoSlide()


slideWrapper.addEventListener('mouseenter',()=>{
    clearInterval(timer)
})

slideWrapper.addEventListener('mouseleave',()=>{
    autoSlide();
})


//modal popup
/*let dialog = document.querySelector('.popup-box');
let closeModaBtn = dialog.querySelector('.box_close');

closeModaBtn.addEventListener('click',()=>{
    dialog.classList.add('dn');
});*/

/* -- portfolio popup --- */

let modal = $(".popup-box"),
  modalBtnClose = modal.find("button"),
  modalInput = modal.find("input");

function setCookie(name, value, day) {
  let date = new Date();
  date.setDate(date.getDate() + day);
  document.cookie = `${name}=${value};expires=${date.toUTCString()}`;
}
function checkCookie(name) {
  let cookieArr = document.cookie.split(";");
  let reject = false;

  for (let cookie of cookieArr) {
    if (cookie.search(name) > -1) {
      reject = true;
      break;
    }
  }
  if (!reject) {
    modal.removeClass("__hidden");
  }
}
checkCookie("Pportfolio_starbucks");

modalBtnClose.click(function () {
  console.log("modal clik");
  modal.addClass("__hidden");
  if (modalInput.is(":checked")) {
    console.log("button click");
    setCookie(
      "portfolio_starbucks",
      "본 사이트는 구직용 포트폴리오 사이트입니다.",
      1
    );
  } else {
    setCookie(
      "portfolio_starbucks",
      "본 사이트는 구직용 포트폴리오 사이트입니다.",
      -1
    );
  }
});
