// give active to navbar if scroll 20px to but background-color to nav
window.addEventListener('scroll', function(){
    if(this.scrollY > 20){
        var navbar = document.querySelector(".firstNav");
        navbar.classList.add("active");
    }else{
        var navbar = document.querySelector(".firstNav");
        navbar.classList.remove("active");
    }
});

// toggle on mobile view (navbar)
function myFunction(x) {
    x.classList.toggle("change");
    let navbar = document.querySelector('.firstNav');
    navbar.classList.toggle("change");
}
function myFunction2(x) {
    x.classList.toggle("active");
    let search = document.querySelector('#search');
    let body = document.querySelector('body');
    search.classList.add("active");
    body.classList.add("active");
    let back = document.querySelector('.back');
    back.onclick = function(){
        search.classList.remove("active");
        body.classList.remove("active");
    }
}
function myFunction3() {
    let selectLang = document.querySelector('.selectLang');
    selectLang.classList.toggle("active");
}
// select list in search
function variables(we){
    let wrapper = we;
    return wrapper
}
