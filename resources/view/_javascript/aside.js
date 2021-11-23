function openNav(){
  document.getElementById("aside").style.width = "100%";
  document.getElementById("aside").style.transition = "0.4s";
}
function closeNav(){
  document.getElementById("aside").style.width = "0px";
  document.getElementById("aside").style.transition = "0.4s";
}
function goBack() {
  window.history.back();
}