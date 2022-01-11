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
// var playBtn = document.getElementById("play_btn");
// playBtn.addEventListener("click", function() {
// $("#play_btn").click(function(){
//     // $(document).on('play', '#play_btn', function(){
//         $(".main_btns").hide();

roomsWrap = document.querySelector(".main_btns");

function clickFunct(num){
  

  $.ajax({
    method: "POST",
    url: "/aa/adise2021/routre.php/join",
    dataType: "json",
    contentType: 'application/json',
    data: JSON.stringify({id : num}),
    success: function(){
      
      window.location = `/aa/adise2021/front/page/game/game.html?lobbyId=${num}`;
    },
    error: function(){
      alert("Something went wrong :(");
    }
  })
}

$(document).on("click", "#play_btn", function () {
  $(".btnH").hide();

  var jwt = getCookie('jwt'); 
  $.ajax({
    method: "POST",
    url: "/aa/adise2021/routre.php/getrooms",
    dataType: "json",
    data: JSON.stringify({jwt:jwt}),
    contentType: "application/json",
    success: function (result) {
      console.log(result);
      results = result.rooms;

      var temp = -1;

      for (roomsKey in results) {
        console.log(results[roomsKey].id);

        if (temp != results[roomsKey].id) {
          var htmlToAdd = `<div onclick="clickFunct(${results[roomsKey].id})" class="roomContainer">
              <div class = "roomId">Room Id:  ${results[roomsKey].id} <br> </div>
              <div class = "participants">Participant 1: ${results[roomsKey].username || ""}`;

          htmlToAdd += `<br></div> <div class = "btnConnect">`;
          
          htmlToAdd += `Active<a href="" class="aBtnA aBtn"></a></div>
          </div>`;
          
          temp = results[roomsKey].id

          roomsWrap.innerHTML += htmlToAdd;
        }else{

          var num = [...document.querySelectorAll('.participants')];
          var last = num[num.length-1];

          last.innerHTML += `Participant 2: ${results[roomsKey].username}`

          document.querySelectorAll('.roomContainer')[num.length-1].classList.add('unclick');

          document.querySelectorAll('.btnConnect')[num.length-1].innerHTML = `Full<a href="" class="aBtnF aBtn"></a></div> </div>`;

        }
      }
    }
  });
  
});

function getCookie(cname){
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
     var c = ca[i];
     while (c.charAt(0) == ' '){
       c = c.substring(1);
     }
  
     if (c.indexOf(name) == 0) {
       return c.substring(name.length, c.length);
     }
  }
  return "";
  }