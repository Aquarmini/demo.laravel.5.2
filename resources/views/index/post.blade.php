@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="/index/index/input" method="post">
                <input type="text" name="name">
                <input type="text" name="key" value="{{$key}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                <input type="submit">
            </form>
        </div>
    </div>
@endsection
