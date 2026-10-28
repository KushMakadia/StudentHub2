/* ==========================================
   STUDENTHUB JAVASCRIPT
   ========================================== */

document.addEventListener("DOMContentLoaded", function () {

    /* ==========================================
       1. HAMBURGER MENU
       ========================================== */

    const menuBtn = document.querySelector(".menu-toggle");
    const navbar = document.querySelector(".navbar");

    if (menuBtn && navbar) {
        menuBtn.addEventListener("click", function () {
            navbar.classList.toggle("show-menu");

            const expanded =
                menuBtn.getAttribute("aria-expanded") === "true";

            menuBtn.setAttribute("aria-expanded", !expanded);
        });
    }


    /* ==========================================
       2. LIGHT / DARK THEME SWITCHER
       ========================================== */

    const themeBtn = document.querySelector("#theme-toggle");

    if (themeBtn) {

        // Load saved theme
        const savedTheme = localStorage.getItem("studenthub-theme");

        if (savedTheme === "dark") {
            document.body.classList.add("dark-mode");
            themeBtn.textContent = "☀️";
        }

        themeBtn.addEventListener("click", function () {

            document.body.classList.toggle("dark-mode");

            if (document.body.classList.contains("dark-mode")) {
                localStorage.setItem("studenthub-theme", "dark");
                themeBtn.textContent = "☀️";
            } else {
                localStorage.setItem("studenthub-theme", "light");
                themeBtn.textContent = "🌙";
            }

        });
    }


    /* ==========================================
       3. COLLAPSIBLE FAQ
       ========================================== */

    const faqQuestions = document.querySelectorAll(".faq-question");

    faqQuestions.forEach(function (question) {

        question.addEventListener("click", function () {

            const answer = this.nextElementSibling;

            // Close other FAQ answers
            faqQuestions.forEach(function (otherQuestion) {

                if (otherQuestion !== question) {

                    otherQuestion.classList.remove("active");

                    const otherAnswer =
                        otherQuestion.nextElementSibling;

                    if (otherAnswer) {
                        otherAnswer.style.maxHeight = null;
                    }
                }
            });

            // Open / close selected answer
            this.classList.toggle("active");

            if (answer.style.maxHeight) {
                answer.style.maxHeight = null;
            } else {
                answer.style.maxHeight = answer.scrollHeight + "px";
            }

        });

    });


    /* ==========================================
       4. MODAL POPUP
       ========================================== */

    const modal = document.querySelector("#event-modal");
    const modalClose = document.querySelector(".modal-close");
    const modalButtons = document.querySelectorAll(".modal-open");

    if (modal) {

        modalButtons.forEach(function (button) {

            button.addEventListener("click", function () {

                const title =
                    this.getAttribute("data-title");

                const description =
                    this.getAttribute("data-description");

                const modalTitle =
                    document.querySelector("#modal-title");

                const modalDescription =
                    document.querySelector("#modal-description");

                if (modalTitle) {
                    modalTitle.textContent = title;
                }

                if (modalDescription) {
                    modalDescription.textContent = description;
                }

                modal.classList.add("show");

            });

        });

        if (modalClose) {
            modalClose.addEventListener("click", function () {
                modal.classList.remove("show");
            });
        }

        // Close modal by clicking outside
        modal.addEventListener("click", function (event) {

            if (event.target === modal) {
                modal.classList.remove("show");
            }

        });

    }


    /* ==========================================
       5. IMAGE / CONTENT SLIDER
       ========================================== */

    const slides =
        document.querySelectorAll(".slide");

    const nextBtn =
        document.querySelector(".slider-next");

    const prevBtn =
        document.querySelector(".slider-prev");

    let currentSlide = 0;

    function showSlide(index) {

        if (slides.length === 0) {
            return;
        }

        slides.forEach(function (slide) {
            slide.classList.remove("active-slide");
        });

        if (index >= slides.length) {
            currentSlide = 0;
        }

        if (index < 0) {
            currentSlide = slides.length - 1;
        }

        slides[currentSlide].classList.add("active-slide");
    }


    if (nextBtn) {

        nextBtn.addEventListener("click", function () {

            currentSlide++;
            showSlide(currentSlide);

        });

    }


    if (prevBtn) {

        prevBtn.addEventListener("click", function () {

            currentSlide--;
            showSlide(currentSlide);

        });

    }


    // Automatic slider
    if (slides.length > 0) {

        showSlide(currentSlide);

        setInterval(function () {

            currentSlide++;
            showSlide(currentSlide);

        }, 4000);

    }


    /* ==========================================
       6. NOTIFICATION BANNER
       ========================================== */

    const notification =
        document.querySelector("#notification-banner");

    const notificationClose =
        document.querySelector(".notification-close");

    if (notification) {

        // Show notification
        setTimeout(function () {
            notification.classList.add("show-notification");
        }, 500);

    }

    if (notificationClose) {

        notificationClose.addEventListener("click", function () {
            notification.classList.remove("show-notification");
        });

    }

});

/* ==========================================
   7. ACTIVE NAVIGATION LINK
   ========================================== */

const currentPage = window.location.pathname.split("/").pop().toLowerCase();

const navLinks = document.querySelectorAll(".navbar a");

navLinks.forEach(function (link) {

    const linkPage = link.getAttribute("href").split("/").pop().toLowerCase();

    if (linkPage === currentPage) {
        link.classList.add("active");
    } else {
        link.classList.remove("active");
    }

});