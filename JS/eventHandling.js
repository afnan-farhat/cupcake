

 // ----task1----     
function myFocus(x) {
 document.getElementById(x).style.background = "lightgrey";
 const hint = document.getElementById(x + "Hint");
 if (hint) {
      hint.style.display = "block";
    }
}

function myBlu(y) {
 document.getElementById(y).style.background = "white";
 const hint = document.getElementById(y + "Hint");
    if (hint) {
      hint.style.display = "none";
    }
}

function dClickFunction() {
  document.getElementById("hiddenPar").style.display = "block";
}

function init(){

var contactform = document.getElementById("cform");

contactform.addEventListener("submit", function(event) {
  const confirmSend = confirm("Are you sure you want to send the Message?");
    if (!confirmSend) {
      event.preventDefault();
    }
},false);

contactform.addEventListener("reset", function(event) {
  const confirmCancel = confirm("Are you sure you want to cancel?");
  if (!confirmCancel) {
    event.preventDefault();
  }
},false);



}

window.addEventListener("load", init, false);
