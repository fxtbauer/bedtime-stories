const formEl = document.querySelector("#form-api")
formEl.addEventListener('submit', event => {
    event.preventDefault();
})

function login() {
    window.location.href="home.html"
}