//Appl state

const MAX_WRONG_GUESSES = 9;
const guesses = []
const buttons = "aábcdeéfghiíjklmnoóöőpqrstuúüűvwxyz"
const theWord = wordList[random(0, wordList.length - 1)]

function random(a, b) {
    return Math.floor(Math.random() * (b - a + 1)) + a
}

function getWrongGuesses() {
    return guesses.filter(c => !theWord.includes(c))
}

function isLost() {
    return MAX_WRONG_GUESSES === getWrongGuesses().length
}

function isWon() {
    return theWord.split("").every(c => guesses.includes(c))
}

//Elements

const divEnd = document.querySelector("#vege")
const divWord = document.querySelector("#szo")
const divButtons = document.querySelector("#betuk")
const divScore = document.querySelector("#eredmeny")

function renderEnd() {
    divEnd.innerHTML = isWon() ? "Nyertél" : isLost() ? "Vesztettél" : ""
}

function renderScore() {
    divScore.innerHTML = `${getWrongGuesses().length}/${MAX_WRONG_GUESSES}`
}

function renderButtons() {
    divButtons.innerHTML =
        buttons.split("").map(c => `<button ${guesses.includes(c)} ? "disabled" : "">
        ${c}
        </button>`).join("")
}

function renderWord() {
    divWord.innerHTML =
        theWord.split("").map(c => `<span class="${isLost() && !guesses.includes(c) ? "hianyzo" : ""}">
        ${isLost() || guesses.includes(c) ? c : ""}
        </span>`).join("")
}

function updateSVG() {
    for (let index = 1; index < getWrongGuesses.length; index++) {
        document.querySelector(`svg *:nth-child(${index})`).classList.add("rajzol")
    }
}

divButtons.addEventListener("click", function (e))
{
    if (!isLost() && !isWon() && e.target.matches("button")) {
        const c = e.target.innerHTML
        guesses.push(c)
        renderWord()
        renderButtons()
        renderEnd()
        renderScore()
        updateSVG()

        if (isWon()) {
            divWord.classList.add("nyer")
        }
    }
}

//Start