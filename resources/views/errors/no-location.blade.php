@extends ('layouts.app', ['title' => 'Geen inzamelpunt'])

@section('content')
    <div class="container-fluid py-3">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-error border-bottom-0">
                <span class="card-title">
                    <i class="fe fe-alert-octagon mr-2"></i> Oh nee! Geen inzamelpunt toegewezen
                </span>
            </div>

            <div class="card-body">
                <p class="card-text">Hey {{ $currentUser->name }},</p>

                <p class="card-text">
                    Het lijkt erop dat er momenteel geen inzamel punt van {{ config('app.name') }} is toewezen aan je en hierdoor de applicatie niet kunt gebruiken.<br>
                    Het kan zijn dat de administrator of een webmaster dit nog niet in orde heeft gemakt voor je. Vandaar dat we willen vragen om nog even geduld te hebben.
                </p>

                <p class="card-text">
                    Of indien dat je denkt dat dit een fout is kan je altijd een administrator of webmaster van de applicatie contacteren zodat hij/zij dit kan nakijken voor je.
                </p>
            </div>

            <div class="card-footer bg-white">
                <a href="" class="btn btn-outline-danger" role="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fe fe-power mr-1"></i> Afmelden
                </a>
            </div>
        </div>
    </div>
@endsection
