function openNav() {
  document.getElementById("mySidenav").style.width = "260px";
  document.getElementById("body").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("body").style.marginLeft = "0";
  document.body.style.backgroundColor = rgb(239, 239, 239);
}