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
        <th scope="col">Status</th>
        @if(auth()->check())
            @if(auth()->user()->role_id==1)
                <th scope="col">Aktion</th>
            @endif
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach($users as $user)
            @if(auth()->check() && auth()->user()->role_id==1 && auth()->user()->id !== $user->id)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                  @if($user->role_id==1)
                    <td>-</td>
                  @else
                    <td class="{{ $user->verified ? 'verified' : 'not-verified' }}">
                      {{ $user->verified ? 'verifiziert' : 'nicht verifizert'  }}
                    </td>
                  @endif
                  <td style="width: 250px;">
                      <button type="button" class="btn btn-primary">
                        <a href="{{ route('users.edit',$user->id) }}" style="color:white;">Edit</a>
                      </button>
                      <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline;">
                        @method('DELETE')
                          @csrf                      
                          <button type="submit" class="btn btn-danger" style="color:white;">Löschen</button>
                      </form>
                    
                      @if($user->verified == 0)
                        @if($user->role_id == 2 || $user->role_id ==3)
                            <form action="{{ route('users.approve',$user->id) }}" method="POST" style="display: inline;">
                                @method('PUT')
                                @csrf
                                <button type="submit" class="btn btn-success" style="color:white;">Verify</button>
                            </form>
                          @endif
                      @endif
                  </td>
              </tr>
            @endif
        @endforeach
    </tbody>
  </table>
<div>

@endsection
