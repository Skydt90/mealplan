@extends('partials.header')

@section('content')
    <!--suppress ALL -->
    <div class="container">
        <br>
        <div class="row">
            <form action="{{ route('week.store') }}" method="POST" class="col s12">
                @csrf
                <div class="row">
                    <div class="input-field col s12">
                        <select name="days">
                            @for($i = 0; $i <= 7; $i++)
                                @if($i == 0)
                                    <?php continue; ?>
                                    <option value="" disabled selected>Antal dage der skal laves mad</option>
                                @endif
                                <option value="{{ $i }}">{{ $i == 1 ? $i .' dag' : $i .' dage'}} </option>" }}
                            @endfor
                        </select>
                        <label>Dage</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <select name="effort">
                            @for($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}">{{ App\Models\Meal::EFFORT[$i] }} </option>" }}
                            @endfor
                        </select>
                        <label>Effort</label>
                    </div>
                </div>
                <div class="center-align">
                    <button type="submit" class="waves-effect waves-light btn valign-wrapper">Opret</button>
                </div>
            </form>
        </div>
    </div>
@endsection
