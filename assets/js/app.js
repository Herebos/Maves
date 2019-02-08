/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');

$(function () {
    $('[data-toggle="popover"]').popover()
})

$('.popover-dismiss').popover({
    trigger: 'focus'
})

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

///////////////////////////////////////////////////////
//Profil
//document.getElementsByClassName("edit");
//document.getElementById("edit");
var editPr = document.getElementById("editPr");

editPr.addEventListener("mouseover", mouseOver);
editPr.addEventListener("mouseleave", mouseOut);

function mouseOver() {
    console.log("1");
    editPr.className = 'fas fa-edit';
}


function mouseOut() {
    console.log("2");
    editPr.className = 'far fa-edit';
}