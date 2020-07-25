@extends('partials.header')
@section('content')

    <div class="container">
        @if(!empty($week))
            <div class="row col s12 center-align">
                <h5>Oversigt {{ $week->start_date . ' - ' . $week->end_date }}</h5>
            </div>
            <table class="striped highlight centered">
                <thead>
                    <tr>
                        <th>Ret</th>
                        <th>Kok</th>
                        <th>Dato</th>
                        <th>Effort</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($week->days as $day)
                    <tr>
                        <td>{{ $day->meal->name  }}</td>
                        <td>{{ $day->chef }}</td>
                        <td>{{ $day->date }}</td>
                        <td>{{ $day->meal->effort }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <br>
            <div class="col s12 center-align">
                <a class="btn z-depth-1" href="{{ route('week.create') }}">Ny Madplan</a>
            </div>
        @else
            <br>
            <div class="row col s12 center-align">
                <a class="btn z-depth-1" href="{{ route('week.create') }}">Opret Madplan</a>
            </div>
        @endif
    </div>

@endsection
