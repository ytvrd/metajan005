@extends('layouts.helloapp')

@section('title','Edit')

@section('menubar')
    @parent
    更新ページ
@endsection

@section('content')
<form method="POST" action="/laravelapp1/public/hello" enctype="multipart/form-data">

@csrf

<input type="file" id="file" name="file" class="form-control">

<button type="submit">アップロード</button>

</form>
    
@endsection

@section('footer')
copyright 2020 tuyano.
@endsection