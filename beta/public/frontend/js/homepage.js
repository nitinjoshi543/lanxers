
const swiper = new Swiper(".homebannerSwiper", {
  slidesPerView: 3,
  centeredSlides: true,
  loop: true,
  spaceBetween: -40,
  grabCursor: true,
  watchSlidesProgress: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    0: { slidesPerView: 1.5, spaceBetween: -20 },
    576: { slidesPerView: 3, spaceBetween: -30 },
    992: { slidesPerView: 3, spaceBetween: -40 },
  },
  on: {
    progress(swiper) {
      swiper.slides.forEach((slide) => {
        const p = slide.progress; // -2 .. 0 .. 2
        const abs = Math.abs(p);
        // Fan: left = clockwise (+), right = counter-clockwise (-)
        const rotate = p * -12; // ±12°, ±24°
        const scale = 1 - abs * 0.12; // center 1 → outer ~0.76
        const opacity = abs > 2.2 ? 0.35 : 1 - abs * 0.12;

        slide.style.transform = `translateX(0) scale(${scale}) rotate(${rotate}deg)`;
        slide.style.opacity = opacity;
        slide.style.zIndex = `${Math.round(10 - abs * 2)}`;
      });
    },
    setTransition(swiper, duration) {
      swiper.slides.forEach((slide) => {
        slide.style.transitionDuration = `${duration}ms`;
      });
    },
  },
});

// Search Script
const hiddenInput = document.getElementById('jobType');
const selectedText = document.getElementById('selectedJobText');
const items = document.querySelectorAll('#jobDropdown .dropdown-item');

items.forEach(item => {
    item.addEventListener('click', function (e) {
        e.preventDefault();

        items.forEach(i => i.classList.remove('active'));
        this.classList.add('active');

        selectedText.textContent = this.dataset.label;
        hiddenInput.value = this.dataset.value;
    });
});
// Search Script


const howitworksSwiper = new Swiper('.howitworksSwiper', {
  slidesPerView: 'auto',
  spaceBetween: 0,
  pagination: {
    el: '.swiper-pagination2',
    clickable: true,
  },
  breakpoints: {
    0: { slidesPerView: 'auto', spaceBetween: 20, },
    992: { slidesPerView: 'auto', spaceBetween: 0, },
  },
});

var testimonialSwiper = new Swiper('.testimonialSwiper', {
  slidesPerView: 'auto',
  loop: true,
  speed: 5000,
  allowTouchMove: false,
  autoplay: {
    delay: 0,
    disableOnInteraction: false,
  },
});

var testimonialSwiper2 = new Swiper('.testimonialSwiper2', {
  slidesPerView: 'auto',
  loop: true,
  speed: 10000,
  allowTouchMove: false,
  autoplay: {
    delay: 0,
    disableOnInteraction: false,
    reverseDirection: true,
  },
});

var testimonialSwiper3 = new Swiper('.testimonialSwiper3', {
  slidesPerView: 'auto',
  loop: true,
  speed: 5000,
  allowTouchMove: false,
  autoplay: {
    delay: 0,
    disableOnInteraction: false,
  },
});

var testimonialSwiper4 = new Swiper('.testimonialSwiper4', {
  slidesPerView: 'auto',
  loop: true,
  speed: 10000,
  allowTouchMove: false,
  autoplay: {
    delay: 0,
    disableOnInteraction: false,
    reverseDirection: true,
  },
});

var testimonialSwiper5 = new Swiper('.testimonialSwiper5', {
  slidesPerView: 'auto',
  loop: true,
  speed: 5000,
  allowTouchMove: false,
  autoplay: {
    delay: 0,
    disableOnInteraction: false,
  },
});

var testimonialSwiper6 = new Swiper('.testimonialSwiper6', {
  slidesPerView: 'auto',
  loop: true,
  speed: 10000,
  allowTouchMove: false,
  autoplay: {
    delay: 0,
    disableOnInteraction: false,
    reverseDirection: true,
  },
});


const trustedcompiniesSwiper = new Swiper(".trustedcompiniesSwiper", {
    slidesPerView: "auto",
    spaceBetween: 40,
    loop: true,
    speed: 5000, 
    allowTouchMove: false,
    freeMode: true,
    freeModeMomentum: false,

    autoplay: {
        delay: 0,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
    },

    breakpoints: {
        320: {
            spaceBetween: 20,
        },
        768: {
            spaceBetween: 30,
        },
        1200: {
            spaceBetween: 40,
        },
    },
});

