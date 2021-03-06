@extends ('layouts.app', ['title' => 'Inventaris'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Inventaris</h1>
            <div class="page-subtitle">Overzicht van alle hulpgoederen</div>

            <div class="page-options d-flex">
                <a href="{{ route('coordinator.inventory.create') }}" class="btn btn-orange shadow-sm">
                    <i class="fe fe-plus"></i>
                </a>

                <form method="POST" action="{{ route('coordinator.inventory.search') }}" class="border-0 shadow-sm form-search form-inline ml-2">
                    @csrf {{-- Form field protection --}}

                    <div class="form-group has-search">
                        <label for="search" class="sr-only">Zoek goederen</label>
                        <span class="fe fe-search form-control-feedback"></span>
                        <input id="search" type="text" name="term" value="{{ request()->get('term') }}" placeholder="Zoeken" class="form-search border-0 form-control">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="card card-body shadow-sm border-0">
            <h6 class="border-bottom border-gray pb-1 mb-3">
                <i class="fe fe-list mr-1 text-secondary"></i> Overzicht van hulpgoederen
            </h6>

            @include ('flash::message') {{-- Flash session view partial --}}

            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="border-top-0" scope="col">Item code</th>
                            <th class="border-top-0" scope="col">Categorie</th>
                            <th class="border-top-0" scope="col">Naam</th>
                            <th class="border-top-0" scope="col">Aantal</th>
                            <th class="border-top-0" colspan="2" scope="col">Extra informatie</th>  {{-- Colspan="Z" is needed for the functions --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item) {{-- Loop trough the items --}}
                            <tr>
                                <td class="font-weight-bold text-muted">#{{ $item->item_code }}</td>
                                <td>
                                    <a href="" class="badge badge-info text-white">{{ $item->category->name }}</a>
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity }} stuks</td>
                                <td>{{ ucfirst($item->extra_information) }}</td>


                                <td> {{-- Options --}}
                                    <span class="float-right">
                                                @can ('checkout', $item) {{-- User is permitted to checkout items --}}
                                        <a href="{{ route('inventory.checkout', $item) }}" class="text-danger text-decoration-none">
                                                        <i class="fe fe-minus-square"></i>
                                                    </a>
                                        @endcan

                                        @can ('checkin', $item) {{-- User is permitted to check-in items --}}
                                            <a href="{{ route('inventory.checkin', $item) }}" class="text-success text-decoration-none ml-1">
                                                <i class="fe fe-plus-square"></i>
                                            </a>
                                        @endcan

                                        @if ($currentUser->hasAnyRole(['admin', 'webmaster']))
                                            <a href="{{ route('inventory.admin.actions', $item) }}" class="text-decoration-none text-muted ml-3">
                                                <i class="fe fe-activity"></i>
                                            </a>
                                        @endif

                                        <a href="{{ route('inventory.show', $item) }}" class="text-muted text-decoration-none ml-1">
                                            <i class="fe fe-eye"></i>
                                        </a>

                                        <a href="{{ route('inventory.item.destroy', $item) }}" class="text-danger text-decoration-none ml-1">
                                            <i class="fe fe-trash-2"></i>
                                        </a>
                                    </span>
                                </td> {{-- /// END options --}}
                            </tr>
                        @empty {{-- There are no tiems found in the application --}}
                            <tr>
                                <td class="text-muted" colspan="6">
                                    <i class="fe fe-info mr-1"></i>
                                    Er zijn momenteel geen hulpgoederen gevonden in de applicatie of onder de matchende zoek parameter
                                </td>
                            </tr>
                        @endforelse {{-- /// END loop --}}
                    </tbody>
                </table>
            </div>

            {{ $items->links() }} {{-- Pagination view instance --}}
        </div>
    </div>
@endsection
