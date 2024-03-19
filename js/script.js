const menuBtn = document.getElementById("menuBtn");
const menuBtnCross = document.getElementById("menuBtnCross");
const mobile_nav_menu = document.querySelector(".nav_list_mobile");

menuBtn.addEventListener("click", () => {
  mobile_nav_menu.classList.add("active_mobile_menu");
});
menuBtnCross.addEventListener("click", () => {
  mobile_nav_menu.classList.remove("active_mobile_menu");
});
