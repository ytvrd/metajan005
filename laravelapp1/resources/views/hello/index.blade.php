@extends('layouts.helloapp')



<!--
@section('menubar')
    @parent
    インデックスページ
@endsection
-->

@section('content')
<link rel="stylesheet" href="{{ asset('css/exa1.css') }}">
    <input type="button" id="shanai" value="社内用" onClick="location.href='../public/hello/exa'"></input>
    <input type="button" id="banhan" value="番販用" onClick="location.href='../public/hello/ban'"></input>
    <input type="button" id="cmmeta" value="CM用" onClick="location.href='../public/hello/cmmeta'"></input>
@endsection

