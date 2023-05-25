@extends('layouts.app')

@section('content')

<div class="container d-flex flex-column maximus" style="min-height: calc(100vh - 374px);">
    <h1>Benutzer Übersicht</h1>

<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Mail</th>
        <th scope="col">Rolle</th>
        <th scope="col">Aktion</th>
      </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
      <tr>
        <th scope="row">{{ $loop->iteration }}</th>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role->name }}</td>
        <td>
            <button type="button" class="btn btn-primary">Edit</button>
            <button type="button" class="btn btn-danger">Delete</button>

        </td>
      </tr>
    @endforeach

    </tbody>
  </table>
<div>

@endsection