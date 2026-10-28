

function mobileScript() {
    if (window.innerWidth <= 990) {
        const phonenavbutton = document.getElementById('phonenavbutton');
        const openMainMenu = document.querySelectorAll('.openMainMenu');
        const dropdownWrapper = document.querySelectorAll('.dropdown-wrapper');
        const closeNavigationMenu = document.querySelectorAll('.closeNavigationMenu');
        const navClose = document.getElementById('navClose');





        phonenavbutton.addEventListener('click', () => {
            document.body.classList.add('overlay');
            document.body.classList.add('navOpen');
        })
        navClose.addEventListener('click', () => {
            document.body.classList.remove('overlay');
            document.body.classList.remove('navOpen');
        })
        openMainMenu.forEach((openmenu) => {
            openmenu.addEventListener('click', () => {
                dropdownWrapper.forEach((dropdownWrappersingle) => {
                    dropdownWrappersingle.classList.remove('show');
                })
            })
        })
        closeNavigationMenu.forEach((closenavigationsingle) => {
            closenavigationsingle.addEventListener('click', () => {
                dropdownWrapper.forEach((dropdownWrappersingle) => {
                    dropdownWrappersingle.classList.remove('show');
                })
                document.body.classList.remove('overlay');
                document.body.classList.remove('navOpen');
            })
        })

        document.querySelectorAll(".dropdowntrigger > a").forEach((item) => {
            item.addEventListener("click", function (e) {
                e.preventDefault();

                const dropdown = this.closest(".dropdowntrigger").querySelector(".dropdown-wrapper");

                // Sirf ek open rakhna ho to
                document.querySelectorAll(".dropdown-wrapper").forEach((el) => {
                    if (el !== dropdown) {
                        el.classList.remove("show");
                    }
                });

                dropdown.classList.toggle("show");
            });
        });
        const navLinks = document.querySelector('.links'); // navigation wrapper

        document.addEventListener('click', function (e) {

            // Agar nav open hi nahi hai to kuch mat karo
            if (!document.body.classList.contains('navOpen')) return;

            // Nav ke andar click hua to kuch mat karo
            if (navLinks.contains(e.target) || phonenavbutton.contains(e.target)) return;

            // Koi dropdown open hai?
            const openedDropdown = document.querySelector('.dropdown-wrapper.show');

            if (openedDropdown) {
                // Pehle dropdown close karo
                openedDropdown.classList.remove('show');
            } else {
                // Fir nav close karo
                document.body.classList.remove('navOpen');
                document.body.classList.remove('overlay');
            }
        });

        // Media Query
    }
}

mobileScript(); // Page load par
window.addEventListener("resize", mobileScript); // Resize par bhi



const rects = gsap.utils.toArray('#globalLoader .wrapper svg rect');

// Initial state
gsap.set(rects, {
  opacity: 0,
});

const tl = gsap.timeline({
  repeat: -1,
  repeatDelay: 0.2
});

rects.forEach((rect, index) => {
  tl.to(rect, {
    opacity: 1,
    duration: 0.2
  });

  // Previous rect ko wapas dim kar do
  if (index > 0) {
    tl.to(rects[index - 1], {
      opacity: 0.5,
      duration: 0.2
    }, "<");
  }
});

// Last rect ke baad sab ko full opacity
tl.to(rects, {
  opacity: 1,
  duration: 1,
//   stagger: 0.05
});

// Thodi der dikhao
tl.to({}, { duration: 0.3 });

// Fir sab dim karke repeat
tl.set(rects, {
  opacity: 0.5
});

const showLoder = ()=>{
    const globalLoader = document.getElementById('globalLoader');
    globalLoader.classList.add('show');
    document.body.style.height = '100vh';
    document.body.style.overflow = 'hidden';
};
const hideLoder = ()=>{
    const globalLoader = document.getElementById('globalLoader');
    globalLoader.classList.remove('show');
    document.body.removeAttribute('style');
};
// showLoder();

