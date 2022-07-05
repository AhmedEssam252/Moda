// toggle on mobile view (navbar)
function myFunction(x) {
    x.classList.toggle("active");
    let navbar = document.querySelector('#AdminNavbar');
    navbar.classList.toggle("active");
}
function myFunction2(trash) {
    let popup = trash.querySelector('.warning');
    popup.classList.add("popup");

}

function appearReset(){
    let reset = document.querySelector('.searchBar .reset')
    let searchValue = search.value
    if(searchValue !== null){
        reset.style = "display:grid;"
    }else{
        reset.style = "display:none;"
    }
}



