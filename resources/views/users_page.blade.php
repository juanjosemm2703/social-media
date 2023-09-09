@extends('layouts.master')
@section('title')
    Users Meda Media
@endsection
@section('content')
    <section class="users">
        <h1>Users</h1>
        <div class="users__grid">
            @foreach($users as $user)
            <a href="{{url("user/$user->user_id")}}">
            <div class="users__card">
                <h2>{{$user->name}}</h2>
                <div class="users__card-footer">
                        <i class="fa-regular fa-message"></i>
                        <p>{{$user->post_count}} posts</p>`
                </div>
            </div>
            </a>
            @endforeach
        </div>
    <section>
@endsection