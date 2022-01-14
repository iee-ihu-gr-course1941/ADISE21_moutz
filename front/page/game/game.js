//                -- Variables --
var deck = new Array(); //Metablhth pou 8a xrhsimopoih8ei mesa sta function
var player1Array = new Array(); //To array me tis kartes pou exw sto xeri mou
// var player2Array = new Array();
var jwt = getCookie("jwt"); //To cookie tou user
var myCount = 0;
var getBtn = document.querySelector(".getDiv");
var enemCount = 0; //To plh8os twn kartwn pou exei o antipalos sto xeri tou
let myURL = new URLSearchParams(window.location.search); //To URL pou eimai
var roomId = myURL.get("lobbyId"); //To id tou room pou vriskomai
var enemy = new Array(); //Array of enemy cards(divs) on deck
var selected = -1; //Arxikopihsh tou selected pou mas leei pia karta path8hke
var isClicked = false; //Boolean metablhth gia na elen3oume an exei path8ei mia karta
var consoleT = document.querySelector("#consoleText"); //To console
var endT = document.querySelector("#submitPick"); //To button 'End Turn'
var previousEnemCount = -1;
var isClickedAndPlayed = false;
var runAtLeastOnce = false;
var isWinner = false;
var gotCard = false;
var runFirstTime = true;
var dropped = false;
var myNameContainer = document.querySelector("#pname2");
var turnName = document.querySelector("#turnText");
$("#turnText").hide();

//
//
//
//
//              -- jQuery && AJAX --
//
//
//
//    -- DROP CARDS REQUEST --
//Request sthn bash na ri3ei tis diples kartes

$.ajax({
  method: "POST",
  url: "/ADISE21_moutz/routre.php/getusername",
  dataType: "json",
  contentType: "application/json",
  data: JSON.stringify({ jwt: jwt }),
  success: function (success) {
    console.log("yee");
    console.log(success.data)
    myNameContainer.innerHTML = success.data;
  },
  error: function(){
    console.log("error on getting username")
  }
});

function dropCard() {
  $.ajax({
    method: "POST",
    url: "/ADISE21_moutz/routre.php/dropcards",
    dataType: "json",
    data: JSON.stringify({ jwt: jwt, room: roomId }),
    contentType: "application/json",
    success: function () {
      // dropped = true;
      resetConsole("Doubles dropped");
      renderCards(); //Ksana kane render tis kartes
    },
    error: function (resp, text) {
      // dropped = false;
      console.log(resp, text);
      resetConsole("Its not your turn");
      if(selected<-1){
      enemy[selected].classList.toggle("stayHov");
      selected = -1;
      }
    },
  });
}

//      -- Return the name of the person that plays in this turn --
function getTurn() {
  $.ajax({
    method: "POST",
    url: "/ADISE21_moutz/routre.php/playerturn",
    dataType: "json",
    data: JSON.stringify({ jwt: jwt, room: roomId }),
    contentType: "application/json",
    success: function (result) {
      if (enemCount > 0) {
        if (!isWinner) {
          $("#turnText").show();
        }
        turnName.innerText = `${result.userturn.username}'s turn`;
      }
    },
  });
}

//      -- Change The Turn Request --
function changeTurn() {
  $.ajax({
    method: "POST",
    url: "/ADISE21_moutz/routre.php/changeturn",
    dataType: "json",
    data: JSON.stringify({ jwt: jwt, room: roomId }),
    contentType: "application/json",
    success: function () {
      resetConsole("Changed Turn");
      gotCard = false;
    },
    error: function () {
      resetConsole("Its not your turn");
    },
  });
}

//        -- RENDER CARDS REQUEST --
//Request ston server na parei tis kartes apo thn bash kai na tis emfanisei
function renderCards() {
  $.ajax({
    method: "POST",
    url: "/ADISE21_moutz/routre.php/showdeck",
    dataType: "json",
    data: JSON.stringify({ jwt: jwt }),
    contentType: "application/json",
    success: function (result) {
      //8a kaleitai sunexeia
      results = result.cards; //Periexei se ena array tis kartes
      enemCount = 0;
      player1Array = [];

      for (all in results) {
        if (result.id == results[all].user_id) {
          player1Array.push({ v: `${results[all].v}`, c: `${results[all].c}` }); //Add card to my hand(array)
          myCount = player1Array.length;
        } else {
          enemCount++; //Pros8ese sto plh8os twn kartwn tou antipalou akoma mia
        }
      }
      renderMyDeck(player1Array);

      //Check enemys deck should be rendered
      if (enemCount != previousEnemCount) {
        renderOthersDeck(enemCount);
      }
      previousEnemCount = enemCount;

      if (runFirstTime) {
        if (enemCount != 0 || myCount != 0) {
          resetConsole("Game started!");
        }
      }
      runFirstTime = false;
    },
    error: function (xhr, resp, text) {
      console.log(xhr, resp, text);
    },
  });
}

//        -- SELECT CARD REQUEST --
//Request gia na parw card
function selectCard() {
  $.ajax({
    method: "POST",
    url: "/ADISE21_moutz/routre.php/selectrandom",
    dataType: "json",
    data: JSON.stringify({ jwt: jwt, room: roomId }),
    contentType: "application/json",
    success: function () {
      gotCard = true;
      resetConsole("Got card"); //
      selected = -1;
    },
    error: function () {
      resetConsole("Can't select card on others turn"); //It's the others turn
      enemy[selected].classList.toggle("stayHov");
      selected = -1;
    },
  });
}

//        -- Leave Room --
function leaveGame() {
  $.ajax({
    method: "POST",
    url: "/ADISE21_moutz/routre.php/leavegame",
    dataType: "json",
    data: JSON.stringify({ jwt: jwt, room: roomId }),
    contentType: "application/json",
    success: function () {
      console.log("Left the room");
    },
  });
}

function getWinner() {
  $.ajax({
    method: "POST",
    url: "/ADISE21_moutz/routre.php/getwinner",
    dataType: "json",
    data: JSON.stringify({ jwt: jwt, room: roomId }),
    contentType: "application/json",
    success: function (result) {
      resetConsole(`${result.winner} won!!!`);
      $(".gameButtons").hide();
      $("#turnText").hide();
      isWinner = true;
    },
    error: function (resp, text) {
      console.log(resp, text);
    },
  });
}

//
//      -- Render Engine --
//
if (!isWinner) {
  renderCards();
  getTurn();
  var timer = setInterval(() => {
    getTurn();
    renderCards();
    getWinner();
  }, 1000);
} else {
  clearInterval(timer);
}

//
//                  -- Functions --
//

//Emfanise sto page tis kartes mou
function renderMyDeck(deck) {
  document.querySelector("#myDeck").innerHTML = ""; //To wrapper myDeck 8a exei innerHTML to keno
  for (card of deck) {
    var cardln = document.createElement("div"); //Thetoume oti h karta 8a einai typou div
    var icon = ""; //Arixkopoihsh tou icon
    if (card.c == "H") {
      //Elenxos gaia to ti eidous xroma exei h karta wste na balei ta swsta css
      icon = "&hearts;";
    } else if (card.c == "S") {
      icon = "&spades;";
    } else if (card.c == "D") {
      icon = "&diams;";
    } else {
      icon = "&clubs;";
    }
    cardln.innerHTML = card.v + "" + icon; //Pros8ese to swsto xroma
    cardln.classList.add("card"); //Bale thn klash card sto div(karta)
    cardln.classList.add(card.c); //Bale thn klash swstou xrwmatos sto div(karta)
    document.getElementById("myDeck").appendChild(cardln); //Bale ton html kwdika pou periexei to cardln sto Wrapper(myDeck)
  }
}

//Drop doubles button clicked
$(document).on("click", "#dropDoubles", function () {
  try {
    dropCard();
  } catch {
    consoleT.innerText = "OTHERS TURN";
  }
});

//Emfanise sto page tis kartes tou antipalou
function renderOthersDeck(cardCount) {
  document.querySelector("#othersDeck").innerHTML = "";
  for (var i = 0; i < cardCount; i++) {
    var icon = `<div class="card enemyCard" style="background-image:url('backcard.jpg');background-size:contain;"></div>`;
    document.getElementById("othersDeck").innerHTML += icon;
  }
  enemy = [...document.querySelectorAll(".enemyCard")];

  //Click se card tou antipalou
  for (let i = 0; i < enemy.length; i++) {
    console.log("please");
    enemy[i].addEventListener("click", function () {
      if (isClicked) {
        //An exei hdh path8ei mia karta
        enemy[i].classList.toggle("stayHov"); //Kane toggle sthn karta pou path8hke twra
        enemy[selected].classList.toggle("stayHov"); //Kane toggle sthn karta pou path8hke prin
        selected = i; //To index ths torinhs kartas
        console.log("clicked");
      } else {
        //An den exei path8ei kamia karta akoma
        enemy[i].classList.toggle("stayHov");
        consoleT.innerText = "CARD SELECTED!";
        isClicked = true; //Path8hke karta
        selected = i; //To index ths torinhs kartas
      }
    });
  }
}

getBtn.addEventListener("click", function () {
  if (isClicked == true) {
    isClicked = false;
    consoleT.innerHTML = "CONSOLE";
    if (!gotCard) {
      selectCard();
    } else {
      resetConsole("Already got a card");
      enemy[selected].classList.toggle("stayHov");
      selected = -1;
    }
  } else {
    resetConsole("You must select a card first");
  }
});

//                    --END TURN--
//Elenxos an exei path8ei mia karta wste na mporoume na kanoume End Turn
endT.addEventListener("click", function () {
  changeTurn();
  enemy[selected].classList.toggle("stayHov");
  selected = -1;
});

function resetConsole(string) {
  console.log(string);
  consoleT.innerText = string.toUpperCase();
}

document.querySelector("#leaveGameBtn").addEventListener("click", function () {
  leaveGame();
});

//
//
//
//--  Get JWT cookie  --
//
//
//
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
