@extends('frontend::layouts.base', ['bodyClass' => 'home'])

@section('body')
    <div class="container">
    </div>

    <div class="jumbotron text-center">
        <div class="logo"><img src="{{ asset('images/laravelio.png') }}" title="Laravel.io"></div>
        <h2>The Laravel Community Portal</h2>

        <div style="margin-top:40px">
            @if (Auth::guest())
            @else
            @endif
        </div>
    </div>
@endsection
