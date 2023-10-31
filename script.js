let ul=document.querySelector(".menu-2")
let menuOpenColse=true
function openMenu(){
    if(menuOpenColse==true){
        ul.style="display:block;"
    menuOpenColse=false
}
else
{
ul.style="display:none;"
menuOpenColse=true
}
    
}