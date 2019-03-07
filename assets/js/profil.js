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