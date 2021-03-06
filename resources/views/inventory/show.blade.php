@extends ('layouts.app', ['title' => "#{$item->item_code} {$item->name}"])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <div class="page-title">Inventaris</div>
            <div class="page-subtitle">
                <span class="font-weight-bold">#{{ $item->item_code }} {{ ucfirst($item->name) }}:</span> Algemene informatie
            </div>

            <div class="page-options d-flex">
                <a href="{{ route('inventory.admin.index') }}" class="btn btn-orange shadow-sm">
                    <i class="fe fe-list mr-2"></i> Overzicht
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="row">
            <div class="col-3"> {{-- Sodebar --}}
                @include ('inventory._partials.sidebar', ['item' => $item])
            </div> {{-- /// END sidebar --}}

            <div class="col-9"> {{-- Content --}}
                <form action="{{ route('inventory.item.update', $item) }}" method="POST" class="card card-body shadow-sm border-0">
                    <h6 class="border-bottom border-gray pb-1 mb-3">
                        <i class="fe fe-plus mr-1 text-secondary"></i> Item toevoegen in de inventaris
                    </h6>

                    @csrf                           {{-- Form field protection --}}
                    @method('PATCH')                {{-- HTTP method spoofing --}}
                    @include ('flash::message')     {{-- Flash session view partial --}}
                    @form($item)                    {{-- Bind data to the form --}}

                    <div class="row mt-1">
                        <div class="col-4">
                            <h5>Algemene informatie</h5>
                        </div>

                        <div class="offset-1 col-7">
                            <div class="form-row">
                                <div class="form-group col-8">
                                    <label for="name" class="name">Item naam <span class="text-danger">*</span></label>
                                    <input type="text" id="name" class="form-control @error('name', 'is-invalid')" placeholder="Item naam" @input('name')>
                                    @error('name')
                                </div>

                                <div class="form-group col-4">
                                    <label for="amount">Aantal <span class="text-danger">*</span></label>
                                    <input type="text" disabled id="quantity" class="form-control @error('quantity', 'is-invalid')" placeholder="Aantal" @input('quantity')>
                                    @error('quantity')
                                </div>

                                <div class="form-group col-12">
                                    <label for="location">Inzamelpunt <span class="text-danger">*</span></label>
                                    <input type="text" disabled class="form-control" value="{{ $item->location->name }}">
                                </div>

                                <div class="form-group col-12">
                                    <label for="category">Categorie <span class="text-danger">*</span></label>

                                    <select id="category" class="custom-select @error('category', 'is-invalid')" @input('category')>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @if (old('location_id') || $category->id === $item->category->id) selected @endif>
                                                {{ ucfirst($category->name) }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('category') {{-- Validation error view partial --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="row">
                        <div class="col-4">
                            <h5>Extra informatie</h5>
                            <p class="card-title text-mutes small">
                                <i class="fe fe-info mr-1"></i> Zoals bv. de kledings maat, schoenmaat, enz.
                            </p>
                        </div>

                        <div class="offset-1 col-7">
                            <div class="form-row">
                                <div class="form-group col-12">
                                    <label class="sr-only" for="info">Extra informatie</label>
                                    <textarea id="info" rows="3" class="form-control" placeholder="Extra informatie" @input('extra_information')>{{ old('extra_information') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-0">

                    <div class="form-row">
                        <div class="form-group col-12 mb-0">
                    <span class="float-right">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fe fe-plus mr-1"></i> Toevoegen
                        </button>

                        <a href="{{ url()->previous() }}" role="button" class="btn btn-light">
                            <i class="fe fe-rotate-ccw text-danger mr-1"></i> annuleren
                        </a>
                    </span>
                        </div>
                    </div>
                </form>
            </div> {{-- /// END content --}}
        </div>
    </div>
@endsection
