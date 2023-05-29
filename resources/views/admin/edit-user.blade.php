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
        <td>
          <form method="POST" action="{{ route('users.update', $user) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
              @if($user->id == request()->route('user')->id)
                <select name="role" id="role" class="form-control">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->role_id === $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
              </div>
            </td>
            <td>
              <button type="submit" class="btn btn-primary">Ok</button>
              <button type="button" class="btn btn-danger">Delete</button>
            </td>
         
              @else
              <p>{{ $user->role->name }}</p>
              <td>
                <button type="button" class="btn btn-primary">
                  <a href="{{route('users.edit',$user->id)}}" style="color:white;">Edit</a>
                </button>
                <button type="button" class="btn btn-danger">Delete</button>
            </td>
          @endif
        </form>
        
    
     
      </tr>
    @endforeach

    </tbody>
  </table>
<div>

@endsection