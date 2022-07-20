

// navbar
const navToggle = document.querySelector(".nav-toggle");
const links = document.querySelector(".links");

navToggle.addEventListener("click", function () {
  links.classList.toggle("show-links");
});

// slider

        var sliding = 0;
Slidesi();

function Slidesi() {
  var i;
  var slides = document.getElementsByClassName("slide");
  
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  sliding++;
  if (sliding > slides.length) {sliding = 1}    
  
  slides[sliding-1].style.display = "block";  

  setTimeout(Slidesi, 3000);
}
//prof display
function triggerClick(){
document.querySelector('#file').click();
}

function displayimage(e){
  if(e.files[0]){
    var reader=new FileReader();

    reader.onload=function(e){
      document.querySelector('#photo').setAttribute('src',e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}
//form display img
function triggerClickz(){
  document.querySelector('#prod_file').click();
  }
  
  function displayimagez(e){
    if(e.files[0]){
      var reader=new FileReader();
  
      reader.onload=function(e){
        document.querySelector('#photoz').setAttribute('src',e.target.result);
      }
      reader.readAsDataURL(e.files[0]);
    }
  }
  //submit product
 
//blur
// function toggle(){
//   var blur=document.getElementById('cont');
//   blur.classList.toogle('active')
  
// }


