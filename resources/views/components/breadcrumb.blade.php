<div class="card bg-light-info position-relative shadow-none">
    <div class="card-body px-4 py-3">
        <div class="row align-items-center">
            <div class="col-4">
                <h4 class="fw-semibold mb-8">{{ $title }}</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">{{ $subtitle }}</li>
                    </ol>
                </nav>
            </div>
            @if ($right == null)
                <div class="col-8">
                    <div class="mb-n5 text-end">
                        <img src="{{ asset('templates/images/ChatBc.png') }}" alt="" class="img-fluid mb-n4">
                    </div>
                </div>
            @else
                {{ $right }}
            @endif
        </div>
    </div>
</div>
