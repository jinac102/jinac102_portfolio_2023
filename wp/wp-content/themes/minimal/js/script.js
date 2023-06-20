let currentURL = location.href;
let portfolioCate = document.querySelector(".portfolio_category");
let active = currentURL.indexOf("/category/archives/"); //없으면 -1이 나옴

if (active > -1) {
    portfolioCate.style.display = "block";
} else {
    portfolioCate.style.display = "none";
}
