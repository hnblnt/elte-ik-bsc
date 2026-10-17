//console.log(movies)

const filter = document.querySelector("#filter")
const list = document.querySelector("#list")
const details = document.querySelector("#details")

filter.addEventListener("input", onFilter)

function onFilter(e) {
    const filterText = filter.value.trim()

    const filteredMovies = filterText === ""
    ? [] 
    : movies.filter(m => m.title.toLowerCase().includes(filterText.toLowerCase())).slice(0,10)

    /*list.innerHTML = filteredMovies.map(m => `<li>${m.title}</li>`).join("")*/

    list.innerHTML = filteredMovies.map(m => `<li data-id="${m.id}">${m.title}</li>`).join("")
}

list.addEventListener("click", onHover)

function onHover(e) {

    details.innerHTML = 
}