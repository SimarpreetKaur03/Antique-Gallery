let navvv = document.getElementById("navbar");
let searchBtn = document.querySelector('#search-btn');
let searchBar = document.querySelector('.search-bar-container');
let formBtn = document.querySelector('#login-btn');
let loginForm = document.querySelector('.login-form-container');
let signupForm = document.querySelector('.signup-form-container');
let forgetPassword = document.querySelector('.forget-password-container');
let formClose = document.querySelector('#form-close');
let signupClose = document.querySelector('#signup-close');
let forgetClose = document.querySelector('#forget-close');

window.onscroll = () => {
    if (window.pageYOffset > 200) {

        navvv.style.background = "#000000";
        navvv.style.boxShadow = "0px 4px 8px rgba(0,0,0,.5)";
    }
    else {
        navvv.style.background = "transparent";
        navvv.style.boxShadow = "none";
    }

    searchBtn.classList.remove('fa-times');
    searchBar.classList.remove('active');
}

searchBtn.addEventListener('click', () => {
    searchBtn.classList.toggle('fa-times');
    searchBar.classList.toggle('active');
});

formBtn.addEventListener('click', () => {
    loginForm.classList.add('active');
});

formClose.addEventListener('click', () => {
    loginForm.classList.remove('active');
});

signupClose.addEventListener('click', () => {
    signupForm.classList.remove('active');
});

forgetClose.addEventListener('click', () => {
    forgetPassword.classList.remove('active');
});

loginBtn.addEventListener('click', () => {
    signupForm.classList.remove('active');
    loginForm.classList.add('active');
});

function signup() {
    loginForm.classList.remove('active');
    signupForm.classList.add('active');
}
function login() {
    signupForm.classList.remove('active');
    loginForm.classList.add('active');
}
function forget() {
    loginForm.classList.remove('active');
    forgetPassword.classList.add('active');
}