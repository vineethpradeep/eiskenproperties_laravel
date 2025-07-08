$(document).ready(function () {
    // ELEMENT SELECTORS & INITIAL STATE
    const $mainThmbCheck = $("#mainThmbCheck").prop("checked", false);
    const $multiImageInput = $("#multiImageInput");
    const $previewContainer = $("#previewContainer");
    const $multiImagedeleteBtn = $(".multiImagedeleteBtn");
    const $mainImgCol = $("#mainImgCol").hide();
    const $deleteBtn = $("#deleteBtn").hide();
    const $multiImgCol = $(".multiImgCol").hide();
    const $searchBtn = $("#searchButton");
    const $postcodeInput = $("#postcodeInput");
    const $deletedField = $("#deleted_existing_images");

    window.mainThamUrl = function (input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                $("#mainThmbImg").attr("src", e.target.result);
                $mainImgCol.show();
                $mainThmbCheck.prop("checked", true);
                $deleteBtn.prop("disabled", false).show();
            };
            reader.readAsDataURL(input.files[0]);
        }
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

    // MAIN IMAGE DELETE
    $deleteBtn.on("click", function (e) {
        e.preventDefault();
        $("#mainThmbImg").attr("src", "https://placehold.co/600x400");
        $("#property_thumbnail").val("");
        $mainThmbCheck.prop("checked", false);
        $deleteBtn.prop("disabled", true).hide();
        $mainImgCol.hide();
    });

    // MAIN IMAGE CHECKBOX TOGGLE
    $mainThmbCheck.on("change", function () {
        const isChecked = $(this).is(":checked");
        $deleteBtn.prop("disabled", !isChecked).toggle(isChecked);
    });

    // MULTIPLE IMAGE PREVIEW
    $multiImageInput.on("change", function () {
        const files = Array.from(this.files);
        const input = this;
        if (files.length > 0) {
            $multiImgCol.show();
            $multiImagedeleteBtn.prop("disabled", false);
        } else {
            $multiImagedeleteBtn.prop("disabled", true);
        }

        // Show new uploaded image previews
        files.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const previewItem = `
                    <div class="col-6 col-sm-4 mb-3 new-image">
                        <label class="imagecheck w-100">
                            <input type="checkbox" class="imagecheck-input" data-index="${index}">
                            <figure class="imagecheck-figure">
                                <img src="${e.target.result}" alt="Thumbnail" class="imagecheck-image" width="100%">
                            </figure>
                        </label>
                    </div>`;
                $previewContainer.append(previewItem);
            };
            reader.readAsDataURL(file);
        });

        $multiImagedeleteBtn.prop("disabled", true);
    });

    // Enable delete button if any image is checked
    $previewContainer.on("change", ".imagecheck-input", function () {
        const anyChecked =
            $previewContainer.find(".imagecheck-input:checked").length > 0;
        $multiImagedeleteBtn.prop("disabled", !anyChecked);
    });

    // DELETE SELECTED IMAGES (SweetAlert confirm)
    $multiImagedeleteBtn.on("click", function (e) {
        e.preventDefault();
        const deleteUrl = $(this).attr("href");
        const checkedInputs = $previewContainer.find(
            ".imagecheck-input:checked"
        );
        const deletedExisting = [];

        Swal.fire({
            title: "Are you sure?",
            text: "Selected image(s) will be removed.",
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
            if (result.isConfirmed) {
                // Remove DOM elements
                checkedInputs.each(function () {
                    const $input = $(this);
                    const $parent = $input.closest(".col-6");
                    if ($input.data("existing")) {
                        deletedExisting.push($input.data("filename"));
                    }
                    $parent.remove();
                });

                // Update hidden input for deleted files
                let currentDeleted = JSON.parse($deletedField.val() || "[]");
                currentDeleted = currentDeleted.concat(deletedExisting);
                $deletedField.val(JSON.stringify(currentDeleted));

                // Remove files from input (for new ones)
                const remainingFiles = Array.from(
                    $multiImageInput[0].files
                ).filter((_, index) => {
                    return !checkedInputs.toArray().some((input) => {
                        return (
                            $(input).data("index") == index &&
                            !$(input).data("existing")
                        );
                    });
                });

                const dataTransfer = new DataTransfer();
                remainingFiles.forEach((file) => dataTransfer.items.add(file));
                $multiImageInput[0].files = dataTransfer.files;
                window.location.href = deleteUrl;

                Swal.fire(
                    "Deleted!",
                    "Selected images were removed.",
                    "success"
                );
            }
        });

        // Toggle button
        $multiImagedeleteBtn.prop("disabled", true);
        if ($previewContainer.children().length === 0) $multiImgCol.hide();
    });

    // SPARKLINE INITIALIZATION
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
    });
    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
    });
    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
    });

    // DATATABLE INIT
    $("#basic-datatables").DataTable();

    // SWEETALERT DELETE CONFIRM
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

    // SUMMERNOTE INIT
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
        let rawVal = $postcodeInput.val().toUpperCase().replace(/\s+/g, "");

        // if (rawVal.length > 3) {
        //     rawVal = rawVal.slice(0, 3) + " " + rawVal.slice(3);
        // }

        $postcodeInput.val(rawVal);

        const hasValue = rawVal.length >= 3;
        console.log("Postcode value:", rawVal, "Has value:", hasValue);

        $searchBtn
            .toggleClass("disabled", !hasValue)
            .prop("disabled", !hasValue);
    }
    toggleSearchButton();

    // POSTCODE SEARCH ENABLE/DISABLE BUTTON
    $postcodeInput.on("input", toggleSearchButton);

    // POSTCODE LOOKUP (Postcodes.io + Overpass API)

    // $searchBtn.click(function (e) {
    //     e.preventDefault();
    //     const query = $postcodeInput.val().trim();

    //     if (!query) {
    //         alert("Please enter a location or postcode.");
    //         return;
    //     }

    //     $.ajax({
    //         url: "https://nominatim.openstreetmap.org/search",
    //         method: "GET",
    //         data: {
    //             q: query,
    //             format: "json",
    //             addressdetails: 1,
    //             limit: 5,
    //         },
    //         headers: {
    //             "Accept-Language": "en-US",
    //             "User-Agent": "EiskenProperties/1.0",
    //         },
    //         success: function (response) {
    //             if (response.length === 0) {
    //                 alert("No results found for the provided location.");
    //                 return;
    //             }

    //             let bestMatch = response.find(
    //                 (r) =>
    //                     r.address &&
    //                     r.address.road &&
    //                     r.address.road
    //                         .toLowerCase()
    //                         .includes("king edwards road")
    //             );

    //             if (!bestMatch) {
    //                 bestMatch = response[0];
    //             }

    //             // const data = response[0];
    //             const lat = parseFloat(bestMatch.lat);
    //             const lon = parseFloat(bestMatch.lon);

    //             // 🔁 REVERSE LOOKUP to get full address with street name
    //             $.ajax({
    //                 url: "https://nominatim.openstreetmap.org/reverse",
    //                 method: "GET",
    //                 data: {
    //                     lat: lat,
    //                     lon: lon,
    //                     format: "json",
    //                     addressdetails: 1,
    //                 },
    //                 headers: {
    //                     "Accept-Language": "en-US",
    //                     "User-Agent": "EiskenProperties/1.0",
    //                 },
    //                 success: function (reverseData) {
    //                     const address = reverseData.address || {};

    //                     $("#address").val(reverseData.display_name || "");
    //                     $("#street").val(address.road || "");
    //                     $("#city").val(
    //                         address.city ||
    //                             address.town ||
    //                             address.village ||
    //                             ""
    //                     );
    //                     $("#latitude").val(lat);
    //                     $("#longitude").val(lon);
    //                     $("#country").val(address.country || "");
    //                     $("#state").val(address.state || "");

    //                     // 🔍 Nearby POIs using Overpass
    //                     const query = `[out:json];(
    //                         node["amenity"="school"](around:3219,${lat},${lon});
    //                         node["highway"="bus_stop"](around:3219,${lat},${lon});
    //                         node["railway"="station"](around:3219,${lat},${lon});
    //                     );out body;`;

    //                     $.post(
    //                         "https://overpass-api.de/api/interpreter",
    //                         { data: query },
    //                         function (data) {
    //                             const types = {
    //                                 school: [],
    //                                 bus_stop: [],
    //                                 station: [],
    //                             };

    //                             data.elements.forEach((el) => {
    //                                 const type =
    //                                     el.tags.amenity ||
    //                                     el.tags.highway ||
    //                                     el.tags.railway;
    //                                 const distance = turf.distance(
    //                                     turf.point([lon, lat]),
    //                                     turf.point([el.lon, el.lat]),
    //                                     { units: "miles" }
    //                                 );
    //                                 const info = {
    //                                     name: el.tags.name || "Unnamed",
    //                                     distance,
    //                                 };

    //                                 if (types[type]) types[type].push(info);
    //                             });

    //                             Object.keys(types).forEach((key) =>
    //                                 types[key].sort(
    //                                     (a, b) => a.distance - b.distance
    //                                 )
    //                             );

    //                             if (types.school[0]) {
    //                                 $("#school_name").val(types.school[0].name);
    //                                 $("#school_distance").val(
    //                                     types.school[0].distance.toFixed(2)
    //                                 );
    //                             }
    //                             if (types.bus_stop[0]) {
    //                                 $("#bus_name").val(types.bus_stop[0].name);
    //                                 $("#bus_distance").val(
    //                                     types.bus_stop[0].distance.toFixed(2)
    //                                 );
    //                             }
    //                             if (types.station[0]) {
    //                                 $("#station_name").val(
    //                                     types.station[0].name
    //                                 );
    //                                 $("#station_distance").val(
    //                                     types.station[0].distance.toFixed(2)
    //                                 );
    //                             }
    //                         }
    //                     ).fail(() =>
    //                         alert("Error loading data from Overpass API.")
    //                     );
    //                 },
    //                 error: function () {
    //                     alert("Failed to reverse geocode the location.");
    //                 },
    //             });
    //         },
    //         error: function () {
    //             alert("Failed to fetch location data from OpenStreetMap.");
    //         },
    //     });
    // });

    $searchBtn.click(function (e) {
        e.preventDefault();
        const query = $postcodeInput.val().trim();

        if (!query) {
            alert("Please enter a street or location name.");
            return;
        }

        $.ajax({
            url:
                "https://api.tomtom.com/search/2/search/" +
                encodeURIComponent(query) +
                ".json",
            method: "GET",
            data: {
                key: "lQ8eD8VMXZ8y7MTMJzSiTDyOXYlMBpEx",
                limit: 5,
                countrySet: "GB",
            },
            success: function (response) {
                if (!response.results || response.results.length === 0) {
                    alert("No results found for the location.");
                    return;
                }

                // Prefer match with King Edwards Road
                let match =
                    response.results.find(
                        (item) =>
                            item.address.street &&
                            item.address.street
                                .toLowerCase()
                                .includes("king edwards road")
                    ) || response.results[0];

                const address = match.address;
                const position = match.position;
                const locationAddress = match.address.freeformAddress || "";

                let street = address.street;
                const city = address.municipality || "";
                const state = address.countrySubdivision || "";
                const country = address.country || "";
                const postcode = address.postalCode || "";

                if (!street && locationAddress.includes(",")) {
                    street = locationAddress.split(",")[0].trim();
                }

                const fullAddress = [
                    street,
                    address.suburb,
                    city,
                    postcode,
                    country,
                ]
                    .filter(Boolean)
                    .join(", ");

                $("#address").val(fullAddress);
                $("#street").val(street);
                $("#city").val(city);
                $("#latitude").val(position.lat);
                $("#longitude").val(position.lon);
                $("#country").val(country);
                $("#state").val(state);

                // Nearby POIs using Overpass API (optional)
                const query = `[out:json];(
                    node["amenity"="school"](around:3219,${position.lat},${position.lon});
                    node["highway"="bus_stop"](around:3219,${position.lat},${position.lon});
                    node["railway"="station"](around:3219,${position.lat},${position.lon});
                );out body;`;

                $.post(
                    "https://overpass-api.de/api/interpreter",
                    { data: query },
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

                        Object.keys(types).forEach((key) =>
                            types[key].sort((a, b) => a.distance - b.distance)
                        );

                        if (types.school[0]) {
                            $("#school_name").val(types.school[0].name);
                            $("#school_distance").val(
                                types.school[0].distance.toFixed(2)
                            );
                        }
                        if (types.bus_stop[0]) {
                            $("#bus_name").val(types.bus_stop[0].name);
                            $("#bus_distance").val(
                                types.bus_stop[0].distance.toFixed(2)
                            );
                        }
                        if (types.station[0]) {
                            $("#station_name").val(types.station[0].name);
                            $("#station_distance").val(
                                types.station[0].distance.toFixed(2)
                            );
                        }
                    }
                ).fail(() => alert("Error loading POIs from Overpass API."));
            },
            error: function () {
                alert("Failed to fetch address data from TomTom API.");
            },
        });
    });

    (function initMainImageState() {
        const currentSrc = $("#mainThmbImg").attr("src");
        const placeholder = "https://placehold.co/600x400";
        const hasImage = currentSrc && currentSrc !== placeholder;

        if (hasImage) {
            $mainImgCol.show();
            $mainThmbCheck.prop("checked", true);
            $deleteBtn.prop("disabled", false).show();
        } else {
            $mainImgCol.hide();
            $mainThmbCheck.prop("checked", false);
            $deleteBtn.prop("disabled", true).hide();
        }
    })();

    (function initExistingMultiImages() {
        if ($previewContainer.children().length > 0) {
            $multiImgCol.show();
        }
    })();
});
