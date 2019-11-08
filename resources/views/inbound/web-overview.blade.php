@extends ('layouts.guest', ['title' => 'Spullen doneren'])

@section('content')
    <div class="container py-5">
        <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm mb-3">
                        <img src="https://via.placeholder.com/900x200" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-danger">Spullen donatie aan {{ config('app.name') }}</h5>

                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                        <div class="card-footer border-top-0 bg-form-options">
                            <button type="submit" class="btn btn-success">
                                <i class="fe fe-heart mr-1"></i> Insturen
                            </button>
                            <button type="reset" class="btn btn-secondary">
                                <i class="fe fe-rotate-ccw mr-1"></i> Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
