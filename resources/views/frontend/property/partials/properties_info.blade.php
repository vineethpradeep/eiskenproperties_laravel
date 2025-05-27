<div class="row mb-5">
    <div
        class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
        <span class="d-inline-block text-black mb-0 caption-text">Approved Property</span>
        <strong class="d-block">0</strong>
    </div>
    <div
        class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
        <span class="d-inline-block text-black mb-0 caption-text">Wishlisted Property</span>
        <strong class="d-block">{{ count($userWishlist ?? []) }}</strong>
    </div>
    <div
        class="col-md-6 col-lg-4 text-center border-bottom border-top py-3">
        <span class="d-inline-block text-black mb-0 caption-text">Requested Viewing</span>
        <strong class="d-block">{{ count($userViewings ?? []) }}</strong>
    </div>
</div>