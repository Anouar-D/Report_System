@extends('layouts.app')

@section('content')

@include('partials.status')

<div class="container">
    <div class="card">
        <div class="card-header text-center">
            <b>Report Wijzigen</b>
        </div>
        
        <form action="{{ route('report.update', $report->id) }}" method="post" class="card-body">
            @csrf
            @method('PATCH')
            <div class="container">
                <div class="form-group row">
                    <label for="title" class="col-md-3 col-form-label text-md-right">Titel</label>
                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $report->title }}" required autocomplete="title" autofocus>
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="report" class="col-md-3 col-form-label text-md-right">Report</label>
                    <div class="col-md-6">
                        <textarea id="report" type="text" class="form-control @error('report') is-invalid @enderror" name="report" required autocomplete="report">{{ $report->report }}</textarea>
                        @error('report')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group container text-center">
                    <button type="submit" class="btn btn-secondary ">Verzenden</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection