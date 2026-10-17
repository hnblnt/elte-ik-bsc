// Állapottér
let pixels = []
let color = "#ff0000"

function initPixels(w, h) {
    pixels = []

    for (let i = 0; i < h; i++) {
        const row = []
        for (let j = 0; j < w; j++) {
            row.push("")
        }
        pixels.push(row)
    }
}

function select(x, y, color) {
    pixels[x][y] = color
}

function xyCoord(td) {
    const x = td.cellIndex
    const tr = td.parentNode
    const y = tr.sectionRowIndex
    return { x, y }
}

//Elements
const editor = document.querySelector("#editor")
const gomb = document.querySelector("#btnGenerate")
const inputWidth = document.querySelector("#width")
const inputHeight = document.querySelector("#height")

//HTML generálók
function genTable(pixels) {
    return `
    <table class="edit">
    ${pixels.map((row) =>
        `<tr>
        ${row.map(() => `<td></td>`).join("")}
        <tr/>`
    ).join("")}
    </table>
    `
}


//Event Handler

gomb.addEventListener("click", generate)

function generate(e) {
    const w = inputWidth.valueAsNumber
    const h = inputHeight.valueAsNumber

    initPixels(w, h)

    editor.innerHTML = genTable(pixels)
}

editor.addEventListener("click", onCellClick)

function onCellClick(e) {
    if (e.target.matches("td")) {
        console.log(e.target)
    }
    const {x,y} = xyCoord(e.target)
    select(x,y,color)
    e.target.style.backgroundColor = color
}

let colorShower = document.querySelector("#color-shower")

function drawColorShower(color) {
    colorShower.style.backgroundColor = color
}