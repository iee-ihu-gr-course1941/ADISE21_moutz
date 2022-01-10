//Stop strings from OverFlowing
function OverflowString() {
  var strings = document.getElementsByTagName("span");
  var dots = "...";

  for (i = 0; i < strings.length; i++) {
    if (strings[i].innerHTML.length > 15) {
      strings[i].innerHTML = strings[i].innerHTML.substring(0, 12) + dots;
    }
  }
}

var btn_state = 1;

//Show and hide FriendList
$(document).ready(function () {
  $(".sidebar-right-btn").click(function () {
    $(".container-friends").toggleClass("active");
    $(".user").toggleClass("user-sidebar");
    $(".username-main-span").toggleClass("username-main-active");
    $(".sidebar-right-btn").toggleClass("sidebar-right-btn-active");

    $(".main_menu").toggleClass("mm_active");

    if (btn_state == 1) {
      $("#sidebar-left-btn").removeClass("fa-chevron-right");
      $("#sidebar-left-btn").addClass("fa-chevron-left");

      btn_state = 0;
    } else {
      $("#sidebar-left-btn").removeClass("fa-chevron-left");
      $("#sidebar-left-btn").addClass("fa-chevron-right");

      btn_state = 1;
    }
  });

  //Add friend search bar and button
  $(".add-friend").click(function () {
    if (document.getElementById("searchuser").style.display != "none") {
      $("#searchuser").hide();
      $("#request").hide();
    } else {
      $("#searchuser").show();
      $("#request").show();
    }
  });
});

const form = document.querySelector("form");
$("#request").click(function () {
  if (document.getElementById("searchuser").innerHTML !== null) {
    var list = document.querySelector("#friend-list");
  } else {
    console.log("You have not typed anything.");
  }
});

//Click on join lobby
var playBtn = document.getElementById("play_btn");
playBtn.addEventListener("click", function() {
    $(".main_btns").hide();

    // $.ajax({
    //     URL: "aa/adise2021/api/objects/game",
    //     type: "GET",
    //     dataType: 'json',
    //     success: 
    // })
});
