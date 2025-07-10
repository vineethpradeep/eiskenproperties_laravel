$(document).ready(function () {
    // SELECTORS
    const $mainThmbCheck = $("#mainThmbCheck").prop("checked", false);
    const $multiImageInput = $("#multiImageInput");
    const $previewContainer = $("#previewContainer");
    const $multiImagedeleteBtn = $("#multiImagedeleteBtn");
    const $deletedField = $("#deleted_existing_images");
    const $deleteBtn = $("#deleteBtn").hide();
    const $mainImgCol = $("#mainImgCol").hide();
    const $multiImgCol = $(".multiImgCol").hide();
    const $searchBtn = $("#searchButton");
    const $postcodeInput = $("#postcodeInput");
    const $thumbInput = $("#property_thumbnail");
    const $existingImage = $("#existing_image");

    function updateMainImageUI(src) {
        $("#mainThmbImg").attr("src", src);
        const hasRealImage = src !== "https://placehold.co/600x400";
        $mainImgCol.toggle(hasRealImage);
        $mainThmbCheck.prop("checked", hasRealImage);
        $deleteBtn.prop("disabled", !hasRealImage).toggle(hasRealImage);
        if (!hasRealImage) {
            $existingImage.val("");
        }
    }

    window.mainThamUrl = function (input) {
        if (!input.files?.[0]) return;
        const reader = new FileReader();
        reader.onload = (e) => {
            // update UI and inject the new src into the hidden too
            updateMainImageUI(e.target.result);
            $existingImage.val(""); // new upload overrides existing
        };
        reader.readAsDataURL(input.files[0]);
    };

    $("#property_thumbnail").on("change", function () {
        if (this.files.length > 0) {
            $(this)
                .removeClass("is-invalid")
                .closest(".form-group")
                .find("span.invalid-feedback")
                .remove();
            $(this).valid();
        }
    });

    $(".validate-on-change").on("change input", function () {
        $(this).valid();
    });

    $deleteBtn.on("click", function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "This main image will be removed.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        }).then((result) => {
            if (result.isConfirmed) {
                updateMainImageUI("https://placehold.co/600x400");
                $thumbInput.val("");
                $mainThmbCheck.prop("checked", false);
                $deleteBtn.prop("disabled", true).hide();

                Swal.fire(
                    "Deleted!",
                    "Your main image has been removed.",
                    "success"
                );
            }
        });
    });

    $mainThmbCheck.on("change", function () {
        const isChecked = $(this).is(":checked");
        $deleteBtn.prop("disabled", !isChecked).toggle(isChecked);
    });

    $multiImageInput.on("change", function () {
        const files = Array.from(this.files);
        $previewContainer.empty();

        if (files.length > 0) {
            $multiImgCol.show();
            files.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $previewContainer.append(`
                        <div class="col-6 col-sm-4 mb-3 new-image">
                            <label class="imagecheck w-100">
                                <input type="checkbox" class="imagecheck-input" data-index="${index}">
                                <figure class="imagecheck-figure">
                                    <img src="${e.target.result}" alt="Thumbnail" class="imagecheck-image" width="100%">
                                </figure>
                            </label>
                        </div>`);
                };
                reader.readAsDataURL(file);
            });
        }
        $multiImagedeleteBtn.prop("disabled", true);
    });

    // Whenever a checkbox is (un)checked…
    $previewContainer.on("change", ".imagecheck-input", function () {
        const checkedCount = $previewContainer.find(
            ".imagecheck-input:checked"
        ).length;

        // Enable/disable button
        $multiImagedeleteBtn.prop("disabled", !checkedCount);

        // Update button text to show count
        if (checkedCount) {
            $multiImagedeleteBtn.text(`Delete (${checkedCount})`);
        } else {
            $multiImagedeleteBtn.text("Delete");
        }
    });

    $multiImagedeleteBtn.on("click", function (e) {
        e.preventDefault();
        const checkedInputs = $previewContainer.find(
            ".imagecheck-input:checked"
        );
        const count = checkedInputs.length;
        if (!count) return;
        const deletedExisting = [];

        Swal.fire({
            title: "Are you sure?",
            text: `You are about to remove ${count} image${
                count > 1 ? "s" : ""
            }.`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete!",
            cancelButtonText: "Cancel",
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger",
            },
            buttonsStyling: false,
        }).then((result) => {
            if (!result.isConfirmed) return;

            checkedInputs.each(function () {
                const $input = $(this);
                const $parent = $input.closest(".col-6");
                if ($input.data("existing")) {
                    deletedExisting.push($input.data("filename"));
                }
                $parent.remove();
            });

            let currentDeleted = JSON.parse($deletedField.val() || "[]");
            currentDeleted = currentDeleted.concat(deletedExisting);
            $deletedField.val(JSON.stringify(currentDeleted));

            const remainingFiles = Array.from($multiImageInput[0].files).filter(
                (_, index) => {
                    return !checkedInputs
                        .toArray()
                        .some(
                            (input) =>
                                $(input).data("index") == index &&
                                !$(input).data("existing")
                        );
                }
            );

            const dataTransfer = new DataTransfer();
            remainingFiles.forEach((file) => dataTransfer.items.add(file));
            $multiImageInput[0].files = dataTransfer.files;

            Swal.fire("Deleted!", "Selected images were removed.", "success");

            $multiImagedeleteBtn.prop("disabled", true);
            if (!$previewContainer.find(".imagecheck-input").length)
                $multiImgCol.hide();
        });
    });

    ["#lineChart", "#lineChart2", "#lineChart3"].forEach((id, i) => {
        const colors = ["#177dff", "#f3545d", "#ffa534"];
        const data = [
            [102, 109, 120, 99, 110, 105, 115],
            [99, 125, 122, 105, 110, 124, 115],
            [105, 103, 123, 100, 95, 105, 115],
        ];
        $(id).sparkline(data[i], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: colors[i],
            fillColor: `${colors[i].replace("#", "rgba(")}14)`,
        });
    });

    $("#basic-datatables").DataTable();

    $(document).on("click", "#delete", function (e) {
        e.preventDefault();
        const link = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire("Deleted!", "Your file has been deleted.", "success");
            }
        });
    });

    $("#editor").summernote({
        height: 200,
        toolbar: [
            ["style", ["bold", "italic", "underline", "clear"]],
            ["font", ["fontsize"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["insert", ["link", "picture"]],
            ["view", ["codeview"]],
        ],
    });

    function toggleSearchButton() {
        const rawVal = $postcodeInput.val().toUpperCase().replace(/\s+/g, "");
        $postcodeInput.val(rawVal);
        const hasValue = rawVal.length >= 3;
        $searchBtn
            .toggleClass("disabled", !hasValue)
            .prop("disabled", !hasValue);
    }
    toggleSearchButton();
    $postcodeInput.on("input", toggleSearchButton);

    $searchBtn.on("click", function (e) {
        e.preventDefault();
        const query = $postcodeInput.val().trim();
        if (!query) return alert("Please enter a street or location name.");

        $.ajax({
            url: `https://api.tomtom.com/search/2/search/${encodeURIComponent(
                query
            )}.json`,
            method: "GET",
            data: {
                key: "lQ8eD8VMXZ8y7MTMJzSiTDyOXYlMBpEx",
                limit: 5,
                countrySet: "GB",
            },
            success: function (response) {
                if (!response.results?.length)
                    return alert("No results found for the location.");

                let match =
                    response.results.find((item) =>
                        item.address.street
                            ?.toLowerCase()
                            .includes("king edwards road")
                    ) || response.results[0];

                const address = match.address;
                const position = match.position;
                const locationAddress = address.freeformAddress || "";
                let street =
                    address.street || locationAddress.split(",")[0]?.trim();

                const fullAddress = [
                    street,
                    address.suburb,
                    address.municipality,
                    address.postalCode,
                    address.country,
                ]
                    .filter(Boolean)
                    .join(", ");

                [
                    ["#address", fullAddress],
                    ["#street", street],
                    ["#city", address.municipality],
                    ["#latitude", position.lat],
                    ["#longitude", position.lon],
                    ["#country", address.country],
                    ["#state", address.countrySubdivision],
                ].forEach(([id, val]) => $(id).val(val));

                const poiQuery = `[out:json];(
                    node["amenity"="school"](around:3219,${position.lat},${position.lon});
                    node["highway"="bus_stop"](around:3219,${position.lat},${position.lon});
                    node["railway"="station"](around:3219,${position.lat},${position.lon});
                );out body;`;

                $.post(
                    "https://overpass-api.de/api/interpreter",
                    { data: poiQuery },
                    function (data) {
                        const types = { school: [], bus_stop: [], station: [] };

                        data.elements.forEach((el) => {
                            const type =
                                el.tags.amenity ||
                                el.tags.highway ||
                                el.tags.railway;
                            const distance = turf.distance(
                                turf.point([position.lon, position.lat]),
                                turf.point([el.lon, el.lat]),
                                { units: "miles" }
                            );
                            const info = {
                                name: el.tags.name || "Unnamed",
                                distance,
                            };
                            if (types[type]) types[type].push(info);
                        });

                        Object.entries(types).forEach(([key, val]) => {
                            val.sort((a, b) => a.distance - b.distance);
                            if (val[0]) {
                                $(`#${key}_name`).val(val[0].name);
                                $(`#${key}_distance`).val(
                                    val[0].distance.toFixed(2)
                                );
                            }
                        });
                    }
                ).fail(() => alert("Error loading POIs from Overpass API."));
            },
            error: () => alert("Failed to fetch address data from TomTom API."),
        });
    });

    (function initMainImageState() {
        const currentSrc = $("#mainThmbImg").attr("src");
        updateMainImageUI(currentSrc);
    })();

    (function initExistingMultiImages() {
        if ($previewContainer.children().length > 0) $multiImgCol.show();
    })();
});
