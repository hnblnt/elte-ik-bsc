document.body.addEventListener("click", onClick)

function onClick(e) {
    //alert(e.target);
    if (e.target.matches("a")) {

        if (!e.target.href.includes("elte.hu")) {
            e.preventDefault()
        }
    }
}