@extends('layouts.app')

@section('content')

<style>

/* Add any custom styles for the mobile view here */

/* For example, you can reduce font sizes and adjust table layout */

@media screen and (max-width: 800px) {
  .table-responsive {
    overflow-x: auto;
  }
  .table {
    width: 100%;
  }
}

</style>
<div class="container d-flex flex-column maximus" style="min-height: calc(100vh - 374px);">
  @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
    <h1>Benutzer Übersicht</h1>

  <div class="table-responsive">
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
                  <td><span class="badge badge-secondary">{{ $user->role->name }}</span></td>
                    @if($user->role_id==1)
                      <td>-</td>
                    @else
                      <td class="{{ $user->verified ? 'verified' : 'not-verified' }}">
                        {{ $user->verified ? 'verifiziert' : 'nicht verifizert'  }}
                      </td>
                    @endif
                    <td style="width: 100px;">
                        <div class="btn-group" role="group">
                          <a href="{{ route('users.edit',$user->id) }}" class="btn btn-primary btn-sm" style="color:white; text-decoration: none;">Edit</a>
                          <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline;">
                            @method('DELETE')
                              @csrf                      
                              <button type="submit" class="btn btn-danger btn-sm" style="color:white;" onclick="confirmDelete('{{ $user->name }}')">Delete</button>
                          </form>
                          @if($user->verified == 0)
                            @if($user->role_id == 2 || $user->role_id ==3)
                                <form action="{{ route('users.approve',$user->id) }}" method="POST" style="display: inline;">
                                    @method('PUT')
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" style="color:white;">Verify</button>
                                </form>
                              @endif
                          @endif
                        </div>
                    </td>
                </tr>
              @endif
          @endforeach
      </tbody>
    </table>
  </div>
<div>
  <script>
    function confirmDelete(username) {
        if (confirm("Möchtest du den Benutzer '" + username + "' wirklich löschen?")) {
            // Benutzer hat bestätigt, lösche den Benutzer
            document.getElementById('delete-form').submit();
        }else{
          return false;
        }
    }
</script>

@endsection
