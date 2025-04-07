@extends('master.layout')
@section('title', $post->title)

@section('content')
    {{ $post->content }}
@endsection
