@extends('layouts.app')

@section('content')

@include('partials.status')

<div class="container">
    <div class="card">
        <div class="card-header text-center">
            <b>Report Aanmaken</b>
        </div>
        
        <form action="{{ route('admin.user.store') }}" method="post" class="card-body">
            @csrf
            <div class="container">
                <div class="form-group row">
                    <label for="first_name" class="col-md-3 col-form-label text-md-right">Voornaam</label>
                    <div class="col-md-6">
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name">
                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="last_name" class="col-md-3 col-form-label text-md-right">Achternaam</label>
                    <div class="col-md-6">
                        <input id="last_name" type="text" class="@error('last_name') is-invalid @enderror form-control" name="last_name" value="{{ old('last_name') }}">
                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-3 col-form-label text-md-right">E-mail Adress</label>
                    <div class="col-md-6">
                        <input id="email" type="text" class="@error('email') is-invalid @enderror form-control" name="email" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="is_admin" class="col-md-3 col-form-label text-md-right">Admin</label>
                    <div class="col-md-6">
                        <input id="is_admin" type="checkbox" class="@error('is_admin') is-invalid @enderror form-control" name="is_admin" @if(old('is_admin')) checked @endif>
                        @error('is_admin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                {{-- <div class="form-group row">
                    <label for="is_active" class="col-md-3 col-form-label text-md-right">Actief</label>
                    <div class="col-md-6">
                        <input id="is_active" type="checkbox" class="@error('is_active') is-invalid @enderror form-control" name="is_active">{{ old('is_admin') }}
                        @error('is_active')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div> --}}

                <div class="form-group container text-center">
                    <button type="submit" class="btn btn-secondary ">Verzenden</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection