@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
            <p class="float-left m-2">
                <b>Gebruikers</b>
            </p> 
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary float-right">Aanmaken</a>
        </div>
            <div class="card-body">
                <div class="row text-center font-weight-bold border-left border-right del2">
                        <div class="col-sm-2">Voornaam</div>
                        <div class="col-sm-2">Achternaam</div>
                        <div class="col-sm-2">Email</div>
                        <div class="col-sm-1">Admin</div>
                        <div class="col-sm-1">Wijzigen</div>
                        <div class="col-sm-2">Wachtwoord resetten</div>
                        <div class="col-sm-2">Verwijderen</div>
                </div>
                <hr>
                @foreach($users as $user)
                    <div class="row text-center">
                        <div class="col-sm-2 border-left border-right"><b class="del1">Voornaam: </b>{{ $user->first_name }}</div>
                        <div class="col-sm-2 border-left border-right"><b class="del1">Achternaam: </b>{{ $user->last_name }}</div>
                        <div class="col-sm-2 border-left border-right"><b class="del1">Email: </b>{{ $user->email }}</div>
                        <div class="col-sm-1 border-left border-right"><b class="del1">Admin: </b>@if($user->is_admin) Ja @else Nee @endif</div>
                        <div class="col-sm-1 border-left border-right del2">
                            <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-secondary m-2"><i class="fas fa-edit"></i></a>
                        </div>
                        <div class="col-sm-2 border-left border-right del2">
                            <a href="" class="btn btn-secondary m-2"><i class="fas fa-lock-open"></i></a>
                        </div>
                        <form class="col-sm-2 border-left border-right del2" action="{{ route('admin.user.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Weet u het zeker?')" class="btn btn-danger pl-3 pr-3">
                                <i class="fa fa-times"></i>
                            </button>
                        </form>
                        
                        <div class="col-sm-6 del1 justify-content-center">
                            <a href="" class="btn btn-secondary m-2"><i class="fas fa-edit"></i></a>
                            <a href="" class="btn btn-secondary m-2"><i class="fas fa-lock-open"></i></a>
                            <form class="m-2" action="{{ route('admin.user.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Weet u het zeker?')" class="btn btn-danger pl-3 pr-3">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <hr>
                @endforeach
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection