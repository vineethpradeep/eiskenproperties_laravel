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
        const itemsPerPage = 4;
        const $items = $("#property-container .property-item-wrap");
        const totalItems = $items.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        const $bigImage = $(".bigImage img");
        const $thumbnails = $(".smallImages img");
        const defaultBigImage =
            "https://bbxtbqstyfhfjybywyya.supabase.co/storage/v1/object/public/uploads/default-image/default_image.jpg";
        const defaultSmallImage =
            "https://bbxtbqstyfhfjybywyya.supabase.co/storage/v1/object/public/uploads/default-image/default_multi_image.jpg";
        let currentIndex = 0;
        let slideInterval;

        function updateSlider(index) {
            if (index < 0) index = $thumbnails.length - 1;
            if (index >= $thumbnails.length) index = 0;

            // Get new image source or default
            const newSrc = $thumbnails.eq(index).attr("src") || defaultBigImage;
            $bigImage.attr("src", newSrc);

            currentIndex = index;
        }

        function nextSlide() {
            updateSlider(currentIndex + 1);
        }

        function prevSlide() {
            updateSlider(currentIndex - 1);
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

        // Initialize first image and start auto-slide
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

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    // Custom Dropdown
    function initRangeSliders() {
        document.querySelectorAll(".range-slider").forEach((slider) => {
            const minInput = slider.querySelector(".rangeMin");
            const maxInput = slider.querySelector(".rangeMax");
            const minValue = slider.querySelector(".rangeMinValue");
            const maxValue = slider.querySelector(".rangeMaxValue");
            const track = slider.querySelector(".range-slider-track");
            const prefix = slider.dataset.prefix || "";

            // Add references to hidden inputs
            const hiddenMinInput = slider.querySelector(
                "input[type='hidden'].hiddenMinPrice, input[type='hidden'].hiddenMinSquareFeet"
            );
            const hiddenMaxInput = slider.querySelector(
                "input[type='hidden'].hiddenMaxPrice, input[type='hidden'].hiddenMaxSquareFeet"
            );

            function updateTrack() {
                let min = parseInt(minInput.value);
                let max = parseInt(maxInput.value);
                const rangeMin = parseInt(minInput.min);
                const rangeMax = parseInt(maxInput.max);

                if (min > max) {
                    [min, max] = [max, min];
                }

                const total = rangeMax - rangeMin;
                const minPercent = ((min - rangeMin) / total) * 100;
                const maxPercent = ((max - rangeMin) / total) * 100;

                track.style.background = `linear-gradient(to right,
                    #ccc 0%,
                    #ccc ${minPercent}%,
                    #8B6E52 ${minPercent}%,
                    #8B6E52 ${maxPercent}%,
                    #ccc ${maxPercent}%,
                    #ccc 100%)`;

                minValue.textContent = prefix + numberWithCommas(min);
                maxValue.textContent = prefix + numberWithCommas(max);

                // Update hidden inputs to submit the correct values
                if (hiddenMinInput) hiddenMinInput.value = min;
                if (hiddenMaxInput) hiddenMaxInput.value = max;

                // Also sync visible slider inputs so they stay consistent
                minInput.value = min;
                maxInput.value = max;
            }

            // Initialize min, max, step based on data attributes (sale/rent)
            function configureRange(formType) {
                const min = slider.dataset[`${formType}Min`];
                const max = slider.dataset[`${formType}Max`];
                const step = slider.dataset[`${formType}Step`];

                minInput.min = maxInput.min = min;
                minInput.max = maxInput.max = max;
                minInput.step = maxInput.step = step;

                if (
                    !minInput.value ||
                    isNaN(parseInt(minInput.value)) ||
                    parseInt(minInput.value) === parseInt(maxInput.value)
                ) {
                    minInput.value = min;
                    if (hiddenMinInput) hiddenMinInput.value = min;
                }

                if (
                    !maxInput.value ||
                    isNaN(parseInt(maxInput.value)) ||
                    parseInt(minInput.value) === parseInt(maxInput.value)
                ) {
                    maxInput.value = max;
                    if (hiddenMaxInput) hiddenMaxInput.value = max;
                }

                updateTrack();
            }

            const form = slider.closest("form");
            const formType = form?.dataset.searchType;

            if (formType === "sale" || formType === "rent") {
                configureRange(formType);
            }

            minInput.addEventListener("input", updateTrack);
            maxInput.addEventListener("input", updateTrack);

            updateTrack();
            // console.log("Detected searchType:", form?.dataset.searchType);
        });
    }

    document.addEventListener("DOMContentLoaded", initRangeSliders);

    // If you use dynamic tab loading (like Bootstrap tabs), re-init on tab shown:
    document.querySelectorAll('button[data-bs-toggle="tab"]').forEach((tab) => {
        tab.addEventListener("shown.bs.tab", () => {
            initRangeSliders();
        });
    });

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
