var cards = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10"];
var suits = ["diamonds", "hearts", "spades", "clubs"];
var deck = new Array();
 

function getDeck() {
  var deck = new Array();

  for (var i = 0; i < suits.length; i++) {
    for (var x = 0; x < cards.length; x++) {
      var card = { Value: cards[x], Suit: suits[i] };
      deck.push(card);
    }
  }

  return deck;
}

function shuffle(deck) {
  // for 1000 turns
  // switch the values of two random cards
  for (var i = 0; i < 1000; i++) {
    var location1 = Math.floor(Math.random() * deck.length);
    var location2 = Math.floor(Math.random() * deck.length);
    var tmp = deck[location1];

    deck[location1] = deck[location2];
    deck[location2] = tmp;
  }
}

function renderMyDeck(deck) {
  document.querySelector("#myDeck").innerHTML = "";
  for (var i = 0; i < 21; i++) {
    var card = document.createElement("div");
    var icon = "";
    if (deck[i].Suit == "hearts") {
      icon = "&hearts;";
    } else if (deck[i].Suit == "spades") {
      icon = "&spades;";
    } else if (deck[i].Suit == "diamonds") {
      icon = "&diams;";
    } else {
      icon = "&clubs;";
    }
    card.innerHTML = deck[i].Value + "" + icon;
    card.classList.add("card");
    card.classList.add(deck[i].Suit);
    document.getElementById("myDeck").appendChild(card);
  }
}

function renderOthersDeck(cardCount) {
  document.querySelector("#othersDeck").innerHTML = "";
  for (var i = 0; i < cardCount; i++) {
    var icon = `<div class="card enemyCard" style="background-image:url('backcard.jpg');background-size:contain;"></div>`;
    document.getElementById("othersDeck").innerHTML += icon;
  }
}

let enemy = "";

function load() {
  deck = getDeck();
  shuffle(deck);
  renderMyDeck(deck);
  renderOthersDeck(20);

  var cText = document.querySelector("#concoleText")
  enemy = [...document.querySelectorAll(".enemyCard")];
  var isClicked = false;

  //Click enemies card
  for (let i=0; i<enemy.length; i++){
    enemy[i].addEventListener("click", function () {

      if(isClicked){
        enemy[i].classList.toggle("stayHov");
        enemy[selected].classList.toggle("stayHov");
        selected = i;
      }else{
        enemy[i].classList.toggle("stayHov");
        consoleText.innerText = ("Card selected!");
        isClicked = true;
        selected = i;
      }
    });
  }


  //ADD CLASS THAT COUNTS HOW LONG HAS YOUR TURN STARTED SO THAT
  //IT CHANGES TURNS IF 25s PASSED

  var endT = document.querySelector("#submitPick");
  endT.addEventListener("click", function(){
    if(isClicked == true){
      //send request to server to add a card to your hand and remove from other
    }else{
      consoleText.innerText = ("YOU MUST SELECT A CARD FIRST.");
    }
  })
}

window.addEventListener("load", load);
