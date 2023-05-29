@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column maximus" style="min-height: calc(100vh - 374px);">
  @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
    <h1>Benutzer Übersicht</h1>

<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Vorname</th>
        <th scope="col">Nachname</th>
        <th scope="col">Mail</th>
        <th scope="col">Rolle</th>
        @if(auth()->check())
            @if(auth()->user()->role_id==1)
                <th scope="col">Aktion</th>
            @endif
        @endif
      </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $user->firstname }}</td>
        <td>{{ $user->lastname }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role->name }}</td>
        @if(auth()->check())
            @if(auth()->user()->role_id==1)
                <td style="width: 200px;">
                    <button type="button" class="btn btn-primary">
                      <a href="{{route('users.edit',$user->id)}}" style="color:white;">Edit</a>
                    </button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </td>
            @endif
        @endif
      </tr>
    @endforeach

    </tbody>
  </table>
<div>

@endsection