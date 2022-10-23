/********************** Preloader ***********************/

function loader(){
    document.querySelector('.preloader').classList.add('enter-out');
}

function fadeOut(){
  setInterval(loader,5000);
}

window.onload = fadeOut();

/******************************************************/

/*********** Link choise **********/

   let links=document.querySelectorAll('a');
    links.forEach(link=>{
        link.addEventListener('click',function(){
            links.forEach(link_choice=>{
                link_choice.classList.remove('choise_link');
                this.classList.add('choise_link');
            })
        })
    })


/**********************************/


/********** back header ***************/

window.addEventListener('scroll',function(){
    const header=this.document.querySelector('.navbar');
    header.classList.toggle('sticky',window.scrollY>20);
})

/*************back to top ***************/

let logo_bizo=document.querySelector('.navbar-brand');
logo_bizo.addEventListener("click",()=>{
        window.scrollTo({
        top:"0",
        behavior:"smooth",  
    });
});

/****************** */


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

function aos_init() {
    AOS.init({
      duration: 1000,
      easing: "ease-in-out",
      once: true,
      mirror: false
    });
}

function let_it_animated(){
  setInterval(aos_init,5000);
}

let_it_animated();

new PureCounter();

/******************* */


