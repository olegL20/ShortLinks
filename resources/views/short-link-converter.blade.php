@extends('welcome')
@section('content')
    <form method="post" action="{{route('convert')}}">
        {{csrf_field()}}
        @if (isset($errors))
            @foreach ($errors->all() as $error)
                <p class="alert-danger" style="color: red;">{{$error}}</p>
            @endforeach
        @endif
        <input type="text" name="url" value="{{old('url')}}">
        <input type="datetime-local" name="expired_at" value="{{old('expired_at')}}">
        <input type="submit" value="Convert">
    </form>

    @if (Session::has('link'))
        <p>Your short link
            <a href="{{route('redirect-to-link', ['link' => Session::get('link')])}}">{{route('redirect-to-link', ['link' => Session::get('link')])}}</a>
        </p>
    @endif
@endsection
