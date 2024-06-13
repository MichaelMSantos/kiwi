function flipCard(button) {
    const card = button.closest('.card');
    card.classList.toggle('is-flipped');
}
window.onload = function () {

var swiper = new Swiper('.swiper-container', {
slidesPerView: 4,
spaceBetween: 10,
loop: true,
navigation: {
nextEl: '.swiper-button-next',
prevEl: '.swiper-button-prev',
},
breakpoints: {
640: {
    slidesPerView: 1,
    spaceBetween: 10,
},
768: {
    slidesPerView: 2,
    spaceBetween: 10,
},
1024: {
    slidesPerView: 3,
    spaceBetween: 10,
},
1200: {
    slidesPerView: 4,
    spaceBetween: 10,
}
}
});

function slider() {
swiper.slideNext(); 
}

setInterval(slider, 5000);

}