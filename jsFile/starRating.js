

// =============star rating logic==============
let star = document.getElementsByClassName("star");

let hid = document.getElementById("hid");
let increse = 0;

let inc = 0;
let validate_index = [];
validate_index[0] = -1;
let last = 0;
function colorChange(val) {
  if (validate_index.includes(val) == true) {
    if (increse == 1) val = -1;

    for (let end = 4; end > val; end--) {
      star[end].style = "color:rgb(194, 191, 191);";

      if (validate_index.includes(end) == true) {
        increse--;
        inc--;
        if (increse < 0) {
          increse = 0;
          inc = 0;
        }
        
        let search_val = validate_index.indexOf(end);
        validate_index.splice(search_val, 1);
      }
    } //end loop
  } else {
    increse = 0;
    inc = 0;
    for (let st = 0; st <= val; st++) {
      star[st].style = "color:orange;";
      increse++;
      if (validate_index.length < 5) {
        validate_index[inc] = st;
        inc++;
      }
    }
    
  }
  hid.value = increse;
  
}
