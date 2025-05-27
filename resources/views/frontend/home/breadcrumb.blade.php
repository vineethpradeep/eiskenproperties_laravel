<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav id="breadcrumbs">
                    <h2>{{ $pageTitle }}</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <i class="fa-solid fa-house me-2"></i>
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        @foreach($breadcrumbs as $key => $crumb)
                        @if($key === array_key_last($breadcrumbs))
                        <li class="breadcrumb-item active" aria-current="page">{{ $crumb }}</li>
                        @else
                        <li class="breadcrumb-item">{{ $crumb }}</li>
                        @endif
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>