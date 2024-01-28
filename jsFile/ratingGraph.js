//============ graph bar logic==========
//============ 'strRating' this variable  have all the  rating values===========

let con = document.getElementsByClassName("con-graph");
let per = document.getElementsByClassName("percent");

let rem;
var mytotalRating = [];

function graphColor(ratingLength) {

  document.getElementById("totalUser").innerText=ratingLength
  for (let i = 0; i < 5; i++) {
    let percentValue = (mytotalRating[i] / ratingLength) * 100;
    if(isNaN(percentValue)){
      percentValue=0
    }
    rem = percentValue - 100;
    per[i].innerHTML = percentValue.toFixed(2) + "%";
    con[i].style ="background: linear-gradient(to right ,yellow " +percentValue + "%,white " +rem +"%);";
  }
}

graphPerCalculate();
function graphPerCalculate() {
let ratingValues= strRating.toString().split(",");
  let inc = 0;
  
  if (ratingValues != "") {
    for (let x = 1; x <= 5; x++) {
      for (let i = 0; i < ratingValues.length; i++) {
        if (x == ratingValues[i]) {
          inc++;
          mytotalRating[x - 1] = inc;
        }
      }
      inc = 0;
    }
  }
  if(ratingValues=="")
  graphColor(0);
  else
  graphColor(ratingValues.length);
}
