//Variables
var jwt = getCookie("jwt");
var isSecond = false;
var roomsWrap = document.querySelector(".main_btns");
var btn_state = 1;
var userName = document.querySelector(".username-main");

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

//Search User
const form = document.querySelector("form");
$("#request").click(function () {
  if (document.getElementById("searchuser").innerHTML !== null) {
    var list = document.querySelector("#friend-list");
  } else {
    console.log("You have not typed anything.");
  }
});

//Button 'Join Lobby' shows all lobbies
$(document).on("click", "#play_btn", function () {
  $(".btnH").hide(); //Hide buttons on Menu
  $(".main_menu").addClass("menuTrans");

  //AJAX request that shows all rooms
  $.ajax({
    method: "POST",
    url: "/~it185222/ADISE21_moutz/routre.php/getrooms",
    dataType: "json",
    data: JSON.stringify({ jwt: jwt }),
    contentType: "application/json",
    success: function (result) {
      console.log(result);
      results = result.rooms;

      var temp = -1; //Arxikopoihsh tou temp

      for (roomsKey in results) {
        // console.log(results[roomsKey].id);

        //Elegxos an uparxei hdh enas user mesa se auto to lobby
        if (temp != results[roomsKey].id) {
          var htmlToAdd = `<div onclick="clickFunct(${
            results[roomsKey].id
          },${isSecond})" class="roomContainer">
              <div class = "roomId">Room Id:  ${
                results[roomsKey].id
              } <br> </div>
              <div class = "participants">Participant 1: ${
                results[roomsKey].username || ""
              }`;

          htmlToAdd += `<br></div> <div class = "btnConnect">`;

          htmlToAdd += `Active<a href="" class="aBtnA aBtn"></a></div>
          </div>`;

          temp = results[roomsKey].id; //Apo8ikeush tou room(roomContainer) poy dhmiourgh8ke

          roomsWrap.innerHTML += htmlToAdd; //Pros8iki tou room(roomContainer) mesa sto container(roomsWrap) twn lobbies

          //An uparxei hdh enas user sto room pros8ese kai ton allon pou pathse to room
        } else {
          isSecond = true; //Metabliti pou deixnei oti einai o deuteros poy mphke sto game

          var num = [...document.querySelectorAll(".participants")]; //Ola ta .participants se array morfh
          var last = num[num.length - 1]; //Pare to teleutaio .participants pou dhmiourgh8hke

          last.innerHTML += `Participant 2: ${results[roomsKey].username}`; //Pros8ese ton kwdika gia to teleutaio user pou mphke
          document
            .querySelectorAll(".roomContainer")
            [num.length - 1].classList.add("unclick"); //bale to class "unclick" sto room(roomContainer), opou to kanei unclickable

          document.querySelectorAll(".btnConnect")[
            num.length - 1
          ].innerHTML = `Full<a href="" class="aBtnF aBtn"></a></div> </div>`;
        }
      }
    },
  });
});

//Redirect from lobby to game
function clickFunct(num, isSecond) {
  $.ajax({
    method: "POST",
    url: "/~it185222/ADISE21_moutz/routre.php/joinroom",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({ room: num, jwt: jwt }),
    success: function () {
      //Request to start game and render my cards for the first time
      $.ajax({
        method: "POST",
        url: "/~it185222/ADISE21_moutz/routre.php/startgame",
        dataType: "json",
        contentType: "application/json",
        data: JSON.stringify({ jwt: jwt, room: num }),
        success: function () {
          console.log("Both users joined");
        },
      });

      window.location = `/~it185222/ADISE21_moutz/front/page/game/game.html?lobbyId=${num}`;
    },
    error: function () {
      alert("Something went wrong :(");
    },
  });
}

getUsername();

function getUsername() {
  $.ajax({
    method: "POST",
    url: "/~it185222/ADISE21_moutz/routre.php/getusername",
    dataType: "json",
    contentType: "application/json",
    data: JSON.stringify({ jwt: jwt }),
    success: function (success) {
      console.log("yee");
      console.log(success.data)
      userName.innerHTML = success.data;
    },
    error: function(xhr, resp, text){
      console.log("error on getting username");
      console.log(xhr, resp, text);
    }
  });
}

//Get JWT cookie
function getCookie(cname) {
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(";");
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }

    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
