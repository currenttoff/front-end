'use strict';

//Selecting Elements

const player0El = document.querySelector('.player--0');
const player1El = document.querySelector('.player--1');
const score0El = document.querySelector('#score--0');
const score1El = document.getElementById('score--1');
const current0El = document.getElementById('current--0');
const current1El = document.getElementById('current--1');

const diceEl = document.querySelector('.dice');
const btnNew = document.querySelector('.btn--new');
const btnRoll = document.querySelector('.btn--roll');
const btnHold = document.querySelector('.btn--hold');

let scores, currentScore, activePlayer, playing;

const init = function () {
  scores = [0, 0];
  currentScore = 0;
  activePlayer = 0;
  playing = true;
  score0El.textContent = 0;
  score1El.textContent = 0;
  current0El.textContent = 0;
  current1El.textContent = 0;
  player0El.classList.remove('player--winner');
  player1El.classList.remove('player--winner');
  //player0El.classList.remove('player--active');
  player1El.classList.remove('player--active');

  diceEl.classList.add('hidden');
};

init();

/*
//start condition
score0El.textContent = 0;
score1El.textContent = 0;
diceEl.classList.add('hidden');

const scores = [0, 0];
let currentScore = 0;
let activePlayer = 0;
let playing = true;

*/

//switch player function
const switchPlayer = function () {
  document.getElementById('current--' + activePlayer).textContent = 0;
  currentScore = 0;
  activePlayer = activePlayer == 0 ? 1 : 0;
  player0El.classList.toggle('player--active');
  player1El.classList.toggle('player--active');
};

//rolling dice functionality
btnRoll.addEventListener('click', function () {
  if (playing) {
    //1. Generating a random dice roll
    let dicer = Math.trunc(Math.random() * 6) + 1;
    console.log(dicer);

    //2. Display dice
    diceEl.classList.remove('hidden');
    diceEl.src = 'dice-' + dicer + '.png';

    //3.Check for rolled 1: if true , switch to next player
    if (dicer !== 1) {
      //add dice to current score
      currentScore += dicer;
      //current0El.textContent = currentScore dynamic allocation of id;
      document.getElementById('current--' + activePlayer).textContent =
        currentScore;
    } else {
      //switch to next player
      switchPlayer();
    }
  }
});

btnHold.addEventListener('click', function () {
  if (playing) {
    //add current score to active player's score
    scores[activePlayer] += currentScore;

    document.getElementById('score--' + activePlayer).textContent =
      scores[activePlayer];

    //ccheck if players score is >=100
    if (scores[activePlayer] >= 100) {
      //win and end
      playing = false;
      diceEl.classList.add('hidden');

      document
        .querySelector('.player--' + activePlayer)
        .classList.add('player--winner');

      document
        .querySelector('.player--' + activePlayer)
        .classList.remove('player--active');
    } else {
      //switch to next player
      switchPlayer();
    }
  }
});

btnNew.addEventListener('click', init);
