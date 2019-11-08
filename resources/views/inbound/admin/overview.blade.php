@extends('layouts.app', ['title' => 'Materiele donaties'])

@section('content')
    <div class="container-fluid py-3">
        <div class="page-header">
            <h1 class="page-title">Donaties</h1>
            <div class="page-subtitle">Overzicht</div>

            <div class="d-flex page-options">
                <div class="btn-group">
                    <button type="button" class="btn btn-orange shadow-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fe fe-settings mr-2"></i> Opties
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">
                            <i class="text-muted fe fe-file-text mr-1"></i>Donatie pagina
                        </a>
                        <a class="dropdown-item" href="{{ route('inbound.admin-overview') }}">
                            <i class="text-muted fe fe-list mr-1"></i> Inkomende donaties</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid pb-3">
        <div class="card card-body shadow-sm border-0">
            <h6 class="border-bottom border-gray pb-1 mb-3">
                <i class="fe fe-list mr-1 text-secondary"></i> Overzicht van inkomende donaties
            </h6>

            @include ('flash::message') {{-- Flash session view partial --}}

            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="border-top-0" scope="col">Donateur</th>
                            <th class="border-top-0" scope="col">Status</th>
                            <th class="border-top-0" scope="col">Spullen</th>
                            <th class="border-top-0" scope="col">Aantal</th>
                            <th class="border-top-0" scope="col">Geregistreerd op</th>
                            <th class="border-top-0" scope="col">&nbsp;</th> {{-- Column for the function shortcuts --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($donations as $donation)
                        @empty {{-- There are currenty no donations in the application. --}}
                            <tr>
                                <td colspan="6" class="text-muted">
                                    <i class="fe fe-info mr-1"></i> Er zijn momenteel geen inkomende donaties
                                </td>
                            </tr>
                        @endforelse {{-- /// END donation loop --}}
                    </tbody>
                </table>
            </div>

            {{ $donations->links() }} {{-- Pagination view instance --}}
        </div>
    </div>
@endsection
