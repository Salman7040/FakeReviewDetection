let phoneCon = document.getElementsByClassName("phone");
let searchBar = document.getElementById("search-bar");
let h1 = document.querySelectorAll(".phone h1");


function searchNow() {
  let inc = 0;
  for (let txtValues of h1) {
    if (
      txtValues.innerHTML
        .toLocaleLowerCase()
        .search(searchBar.value.toLowerCase()) != -1
    ) {
      phoneCon[inc].style.display = "block";
    } else {
      phoneCon[inc].style.display = "none";
    }
    inc++;
  }
}
