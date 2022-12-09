/********************** Preloader ***********************/

const loading_val = 1 ;
function loader(){
    document.querySelector('.preloader')?.classList.add('enter-out');
}

function fadeOut(){
  setInterval(loader,loading_val);
}

window.onload = fadeOut();

/******************************************************/

/******************** Cursor  ******************/

/*var timer;
const cursor =document.querySelector('.cursor');
if(cursor){
document.addEventListener("mousemove",(e)=>{
  let x=e.pageX;
  let y=e.pageY;
  cursor.style.top=y+'px';
  cursor.style.left=x+'px';
  cursor.style.display="block";

  function mouseStopped(){
    cursor.style.display="none";
  }

  clearTimeout(timer);
  timer=setTimeout(mouseStopped,3000);
})

document.addEventListener("mouseout",()=>{
  cursor.style.display="none";
})
}*/

/***************************************/

/*********** Link choise **********/

   let links=document.querySelectorAll('.link_navbar');
    links.forEach(link=>{
        link.addEventListener('click',function(){
            links.forEach(link_choice=>{
                link_choice?.classList.remove('choise_link');
                this.classList.add('choise_link');
            })
        })
    })
  
/**********************************/


/********** back header ***************/

window.addEventListener('scroll',function(){
    const header=this.document.querySelector('.navbar');
    header?.classList.toggle('sticky',window.scrollY>20);
})

/*************back to top ***************/

let logo_bizo=document.querySelector('.navbar-brand');
if(logo_bizo){
logo_bizo.addEventListener("click",()=>{
        window.scrollTo({
        top:"0",
        behavior:"smooth",  
    });
});
}
/****************************************/



/** profil user */

/*var option=
   {
    animation:true,
    delay:2000
   };
   function toasty(){
    var toastelement=document.querySelector('.toast');
    var toastcreate=new bootstrap.Toast(toastelement,option);
    toastcreate.show();
   }*/

 
/** user theme */
/*
let text=document.querySelector(".textarea");
let color_changer=document.querySelector("#color");
let color_circle=document.querySelectorAll('.color-circle');

color_circle.forEach(color_current=>{
 color_current.addEventListener('click',function(){
    color_circle.forEach(color_choice=>{
       color_choice.classList.remove('active');
       this.classList.add('active');
       color=this.innerHTML;
       color_changer.value=color;
       text.style.backgroundColor=color;
       if(color=='red' || color=="blue"){
        text.style.color='white';
      }else if(color=="white"){
        text.style.color='#000';
      }
  })
})
})*/

/******************************* */

/** side bar user */

/******************************* */



var option=
   {
    animation:true,
    delay:5000000000000
   };
   
function toasty(param){
  if(param=='notif'){
  var toastelement=document.querySelector('#liveToast');
  var toastcreate=new bootstrap.Toast(toastelement,option);
  toastcreate.show();
  } else{
   var toastelement=document.querySelector('#profil');
   var toastcreate=new bootstrap.Toast(toastelement,option);
   toastcreate.show();
  }
}

/*new Swiper('.testimonials-slider', {
    speed: 600,
    loop: true,
    autoplay: {
      delay: 5000,
      disableOnInteraction: false
    },
    slidesPerView: 'auto',
    pagination: {
      el: '.swiper-pagination',
      type: 'bullets',
      clickable: true
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
        spaceBetween: 40
      },
      1200: {
        slidesPerView: 3,
      }
    }
});
*/
/*
function aos_init() {
    AOS.init({
      duration: 1000,
      easing: "ease-in-out",
      once: true,
      mirror: false
    });
}

function let_it_animated(){
  setInterval(aos_init,loading_val);
}

let_it_animated();

new PureCounter();*/

/******************* */


