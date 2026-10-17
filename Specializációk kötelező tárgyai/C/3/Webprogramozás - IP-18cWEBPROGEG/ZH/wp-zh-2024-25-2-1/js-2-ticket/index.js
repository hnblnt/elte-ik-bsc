// --- 1. ALAPBEÁLLÍTÁSOK ÉS VÁLTOZÓK ---

// Kiválasztjuk a HTML-ből a #seating azonosítójú elemet (ez lesz a székek táblázata)
const seatingTable = document.querySelector('#seating')

// Beállítjuk a sorok és oszlopok számát a generáláshoz
const rowNum = 10
const colNum = 14

// Árak definiálása tömbben.
// Indexek jelentése: 0. index = állóhely, 1-3. index = ülőhely kategóriák
//                    0.   1.   2.   3.
const sectorCosts = [250, 350, 200, 100]

// Foglalt helyek számlálója (jelenleg a kódban nincs aktívan használva a logikában, csak inicializálva van)
let seatsTaken = [0, 0, 0, 0]


// --- 2. ÁRAK KIÍRÁSA A HTML-BE ---

// Kiválasztjuk a HTML elemeket, ahová az árakat ki akarjuk írni
const sec0 = document.querySelector("#sector-0-cost");
const sec1 = document.querySelector("#sector-1-cost");
const sec2 = document.querySelector("#sector-2-cost");
const sec3 = document.querySelector("#sector-3-cost");

// Beírjuk a sectorCosts tömbből az értékeket a HTML elemekbe
sec0.innerHTML = sectorCosts[0]
sec1.innerHTML = sectorCosts[1]
sec2.innerHTML = sectorCosts[2]
sec3.innerHTML = sectorCosts[3]


// --- 3. ÁLLÓHELYEK KEZELÉSE (SECTOR 0) ---

// Kiválasztjuk a "hozzáadás" gombot
const incstand = document.querySelector("#add-standing")
// Eseményfigyelőt adunk rá: kattintáskor fusson le a 'standinc' függvény
incstand.addEventListener("click",standinc)

function standinc() {
    // Kiválasztjuk az aktuális darabszámot és az összegző mezőt
    let sector = document.querySelector("#sector-0-amount");
    let total = document.querySelector("#sector-0-total");
    let current = 0;

    // Ellenőrizzük, hogy a jelenlegi tartalom szám-e. Ha igen, átalakítjuk számmá (parseInt).
    if(!isNaN(sector.textContent)){
        current = parseInt(sector.textContent);
    }

    // Növeljük a darabszámot 1-gyel és visszaírjuk
    sector.textContent = parseInt(current+1);
    
    // Kiszámoljuk az új végösszeget: (jelenlegi + 1) * állóhely ára
    total.textContent = parseInt(sectorCosts[0]) * parseInt(current + 1)
}

// Kiválasztjuk a "kivonás" gombot
const decstand = document.querySelector("#sub-standing")
decstand.addEventListener("click",standdec)

function standdec() {
    let sector = document.querySelector("#sector-0-amount");
    let total = document.querySelector("#sector-0-total");
    let current = 0;
    if(!isNaN(sector.textContent)){
        current = parseInt(sector.textContent);
    }

    // VÉDELEM: Ha 0 a darabszám, nem engedjük tovább csökkenteni (ne legyen negatív).
    if(current == 0){
        sector.textContent = 0
        total.textContent = 0
        return; // Kilépünk a függvényből
    }

    // Ha nem volt 0, csökkentjük 1-gyel és frissítjük az árat
    sector.textContent = parseInt(current-1);
    total.textContent = parseInt(sectorCosts[0]) * parseInt(current - 1)
}


// --- 4. ÜLŐHELYEK GENERÁLÁSA (TÁBLÁZAT) ---

// Külső ciklus: Sorok generálása (0-tól rowNum-ig)
for (let i = 0; i < rowNum; i++) {
    // Létrehozunk egy táblázat sort (tr)
    let tr = document.createElement("tr");

    // Belső ciklus: Oszlopok (cellák) generálása soron belül (0-tól colNum-ig)
    for (let j = 0; j < colNum; j++) {
        // Létrehozunk egy cellát (td)
        let td = document.createElement("td");
        // Hozzáadjuk a "seat" osztályt formázáshoz
        td.classList.add("seat");

        // --- SZEKTOROK KIOSZTÁSA ---
        // Az 'i' (sor index) alapján döntjük el, melyik szektorba tartozik a szék
        if(i == 0 || i == 1 || i == 2){
            // 0., 1., 2. sor -> 1-es szektor
            td.classList.add("sector-1")
        }
        else if(i == 3 || i == 4 || i == 5){
            // 3., 4., 5. sor -> 2-es szektor
            td.classList.add("sector-2");
        }
        else{
            // Minden további sor (6-tól felfelé) -> 3-as szektor
            td.classList.add("sector-3");
        }
        
        // Hozzáfűzzük a cellát a sorhoz
        tr.appendChild(td);
    }
    // A kész sort hozzáfűzzük a fő táblázathoz
    seatingTable.appendChild(tr);
}


// --- 5. INTERAKCIÓ ---

// Eseményfigyelő a teljes táblázatra. Ha bárhova kattintunk benne, lefut a 'selected'
seatingTable.addEventListener("click", selected);

// Ez a függvény felelne a székek kiválasztásáért, de jelenleg ÜRES
function selected() {
    // Ide kellene megírni a logikát:
    // 1. Megnézni, hogy a kattintott elem (event.target) valóban szék-e.
    // 2. Ha szék, akkor változtatni a színét/osztályát (pl. "selected").
    // 3. Frissíteni a végösszeget az adott szektor árával.
}