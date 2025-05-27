(function ($) {
    "use strict";

    // Spinner
    setTimeout(() => {
        $("#spinner").removeClass("show");
    }, 1);

    // WOW Animation
    new WOW().init();

    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 45) {
            $(".nav-bar").addClass("sticky-top");
        } else {
            $(".nav-bar").removeClass("sticky-top");
        }

        if ($(this).scrollTop() > 100) {
            $(".back-to-top").fadeIn();
        } else {
            $(".back-to-top").fadeOut();
        }
    });

    // Preloader
    $(window).on("load", () => {
        $("#preloader").delay(500).fadeOut("slow");
        $(".preloader").delay(600).fadeOut("slow");
    });

    // Back to Top Button
    $(".back-to-top").click(function () {
        $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
        return false;
    });

    // Header Carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        items: 1,
        dots: true,
        loop: true,
        nav: true,
        navText: [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>',
        ],
    });

    // Testimonials Carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 24,
        dots: false,
        loop: true,
        nav: true,
        navText: [
            '<i class="fa-solid fa-chevron-left"></i>',
            '<i class="fa-solid fa-chevron-right"></i>',
        ],
        responsive: {
            0: { items: 1 },
            992: { items: 2 },
        },
    });

    // Property Slider Logic
    const $track = $(".property-slider-track");
    const $item = $(".property-slider-track > .col-lg-4");
    let itemWidth = $item.outerWidth(true);
    let position = 0;

    const updateSlider = () => {
        itemWidth = $item.outerWidth(true);
        const visibleItems = Math.floor(
            $(".property-slider").width() / itemWidth
        );
        const totalItems = $item.length;
        return (totalItems - visibleItems) * itemWidth;
    };

    let maxPosition = updateSlider();

    $(".slider-arrow.right").click(() => {
        if (Math.abs(position) < maxPosition) {
            position -= itemWidth;
            $track.css("transform", `translateX(${position}px)`);
        }
    });

    $(".slider-arrow.left").click(() => {
        if (position < 0) {
            position += itemWidth;
            $track.css("transform", `translateX(${position}px)`);
        }
    });

    $(window).resize(() => {
        position = 0;
        maxPosition = updateSlider();
        $track.css("transform", `translateX(${position}px)`);
    });

    // Shared slider interval (respects dropdown state)
    let sliderInterval;
    function startSliderAuto() {
        clearInterval(sliderInterval);
        sliderInterval = setInterval(() => {
            if (!$(".custom-dropdown").hasClass("active")) {
                $(".slider-arrow.right").click();
            }
        }, 4000);
    }
    startSliderAuto();

    $(".property-slider-container").hover(
        () => clearInterval(sliderInterval),
        () => startSliderAuto()
    );

    $(document).ready(function () {
        const $track = $(".slider-track");
        const $thumbnails = $(".smallImages img");
        let currentIndex = 0;
        let slideInterval;
        const itemsPerPage = 4;
        const $items = $("#property-container .property-item-wrap");
        const totalItems = $items.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);

        $thumbnails.each(function () {
            const src = $(this).attr("src");
            $track.append(
                `<div class="slide" style="background-image: url('${src}')"></div>`
            );
        });

        function updateSlider(index) {
            const translateX = -index * 100;
            $track.css("transform", `translateX(${translateX}%)`);
            currentIndex = index;
        }

        function nextSlide() {
            currentIndex = (currentIndex + 1) % $thumbnails.length;
            updateSlider(currentIndex);
        }

        function prevSlide() {
            currentIndex =
                (currentIndex - 1 + $thumbnails.length) % $thumbnails.length;
            updateSlider(currentIndex);
        }

        function startAutoSlide() {
            slideInterval = setInterval(nextSlide, 3000);
        }

        function resetAutoSlide() {
            clearInterval(slideInterval);
            startAutoSlide();
        }

        $(".arrow-right").click(function () {
            nextSlide();
            resetAutoSlide();
        });

        $(".arrow-left").click(function () {
            prevSlide();
            resetAutoSlide();
        });

        $thumbnails.click(function () {
            const index = $thumbnails.index(this);
            updateSlider(index);
            resetAutoSlide();
        });

        updateSlider(currentIndex);
        startAutoSlide();

        function showPage(page) {
            $items.hide();
            const start = (page - 1) * itemsPerPage;
            const end = start + itemsPerPage;
            $items.slice(start, end).show();
        }

        function createPagination() {
            let html = "";
            for (let i = 1; i <= totalPages; i++) {
                html += `<a href="#" class="pagination-link ${
                    i === 1 ? "active" : ""
                }" data-page="${i}">${i}</a>`;
            }
            $("#pagination-container").html(html);
        }

        showPage(1);
        createPagination();

        $("#pagination-container").on(
            "click",
            ".pagination-link",
            function (e) {
                e.preventDefault();
                $(".pagination-link").removeClass("active");
                $(this).addClass("active");
                const page = parseInt($(this).data("page"));
                showPage(page);
            }
        );
    });

    // Custom Dropdown
    function initRangeSliders() {
        document.querySelectorAll(".range-slider").forEach((slider) => {
            const minInput = slider.querySelector(".rangeMin");
            const maxInput = slider.querySelector(".rangeMax");
            const minValue = slider.querySelector(".rangeMinValue");
            const maxValue = slider.querySelector(".rangeMaxValue");
            const track = slider.querySelector(".range-slider-track");
            const prefix = slider.dataset.prefix || "";

            function updateTrack() {
                const min = parseInt(minInput.value);
                const max = parseInt(maxInput.value);
                const rangeMin = parseInt(minInput.min);
                const rangeMax = parseInt(maxInput.max);
                const total = rangeMax - rangeMin;

                // Calculate percent positions for gradient
                const minPercent = ((min - rangeMin) / total) * 100;
                const maxPercent = ((max - rangeMin) / total) * 100;

                // Update the track gradient between min and max slider positions
                track.style.background = `linear-gradient(to right,
                    #ccc 0%,
                    #ccc ${minPercent}%,
                    #8B6E52 ${minPercent}%,
                    #8B6E52 ${maxPercent}%,
                    #ccc ${maxPercent}%,
                    #ccc 100%)`;

                // Update displayed min and max values with prefix (e.g., £)
                minValue.textContent = `${prefix}${min}`;
                maxValue.textContent = `${prefix}${max}`;
            }

            minInput.addEventListener("input", () => {
                const minVal = parseInt(minInput.value);
                const maxVal = parseInt(maxInput.value);
                // Prevent min slider from exceeding max slider value
                if (minVal > maxVal) {
                    minInput.value = maxVal;
                }
                updateTrack();
            });

            maxInput.addEventListener("input", () => {
                const minVal = parseInt(minInput.value);
                const maxVal = parseInt(maxInput.value);
                // Prevent max slider from being lower than min slider value
                if (maxVal < minVal) {
                    maxInput.value = minVal;
                }
                updateTrack();
            });

            // Initialize track and values on page load
            updateTrack();
        });
    }

    (function () {
        function closeAllDropdowns(except = null) {
            document
                .querySelectorAll(".custom-dropdown.active")
                .forEach((dropdown) => {
                    if (dropdown !== except) {
                        dropdown.classList.remove("active");
                    }
                });
        }

        document.querySelectorAll(".custom-dropdown").forEach((dropdown) => {
            const input = dropdown.querySelector(".dropdown-input");
            const clearIcon = dropdown.querySelector(".clear-icon");
            const dropdownIcon = dropdown.querySelector(".dropdown-icon");
            const optionsList = dropdown.querySelector(".options");
            const options = JSON.parse(dropdown.dataset.options);

            function openDropdown() {
                closeAllDropdowns(dropdown);
                dropdown.classList.add("active");
                filterOptions(input.value);
            }

            function closeDropdown() {
                dropdown.classList.remove("active");
            }

            function updateIcons() {
                if (input.value.trim()) {
                    clearIcon.style.display = "block";
                    dropdownIcon.style.display = "none";
                } else {
                    clearIcon.style.display = "none";
                    dropdownIcon.style.display = "block";
                }
            }

            function filterOptions(search) {
                optionsList.innerHTML = "";
                const filtered = options.filter((opt) =>
                    opt.toLowerCase().includes(search.toLowerCase())
                );

                filtered.forEach((opt) => {
                    const li = document.createElement("li");
                    li.textContent = opt;
                    li.addEventListener("click", () => {
                        input.value = opt;
                        updateIcons();
                        closeDropdown();
                    });
                    optionsList.appendChild(li);
                });
            }

            input.addEventListener("focus", () => openDropdown());
            input.addEventListener("click", (e) => {
                e.stopPropagation();
                openDropdown();
            });
            input.addEventListener("input", () => {
                filterOptions(input.value);
                updateIcons();
            });

            dropdownIcon.addEventListener("click", (e) => {
                e.stopPropagation();
                openDropdown();
            });

            clearIcon.addEventListener("click", (e) => {
                e.stopPropagation();
                input.value = "";
                updateIcons();
                closeDropdown();
            });

            dropdown.addEventListener("click", (e) => e.stopPropagation());

            document.addEventListener("click", () => closeAllDropdowns());

            updateIcons();
        });
    })();
    initRangeSliders();

    // Advanced Search
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll(".more-filter a").forEach((toggle) => {
            const form = toggle.closest("form");
            const wrapper = form.querySelector(".more-filters-wrapper");
            if (!wrapper) return;

            toggle.addEventListener("click", (e) => {
                e.preventDefault();

                const isExpanded = wrapper.classList.contains("expanded");

                if (isExpanded) {
                    wrapper.style.height = wrapper.scrollHeight + "px";
                    requestAnimationFrame(() => {
                        wrapper.style.height = "0px";
                        wrapper.classList.remove("expanded");
                    });
                } else {
                    wrapper.style.height = wrapper.scrollHeight + "px";
                    wrapper.classList.add("expanded");

                    wrapper.addEventListener(
                        "transitionend",
                        () => {
                            if (wrapper.classList.contains("expanded")) {
                                wrapper.style.height = "auto";
                            }
                        },
                        { once: true }
                    );
                }
            });
        });
    });
})(jQuery);
