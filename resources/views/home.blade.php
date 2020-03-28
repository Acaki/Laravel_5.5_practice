@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ $selectedDate }}
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach ($availableDates as $availableDate)
                    @if ($availableDate === $selectedDate)
                        <a class="dropdown-item" href="#">{{ $availableDate }}</a>
                    @else
                        <a class="dropdown-item" href="/home?date={{ $availableDate }}">{{ $availableDate }}</a>
                    @endif
                @endforeach
            </div>
        </div>
        <table class="table table-bordered mt-4">
            <thead>
            <tr>
                <th scope="col">星座</th>
                <th scope="col">日期</th>
                <th scope="col">整體運勢</th>
                <th scope="col">愛情運勢</th>
                <th scope="col">事業運勢</th>
                <th scope="col">財運運勢</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($fortunes as $fortune)
                <tr>
                    <td>{{ $fortune->constellation }}</td>
                    <td>{{ $fortune->date }}</td>
                    <td>
                        評分： {{ $fortune->overall_fortune_score }}/5 <br><br> {{ $fortune->overall_fortune_description }}
                    </td>
                    <td>
                        評分： {{ $fortune->love_fortune_score }}/5 <br><br> {{ $fortune->love_fortune_description }}
                    </td>
                    <td>
                        評分： {{ $fortune->career_fortune_score }}/5 <br><br> {{ $fortune->career_fortune_description }}
                    </td>
                    <td>
                        評分： {{ $fortune->wealth_fortune_score }}/5 <br><br> {{ $fortune->wealth_fortune_description }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
