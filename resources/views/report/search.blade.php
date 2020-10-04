@extends('layouts.app')

@section('content')

@include('partials.status')

<div class="container">
    <div class="card">
        <div class="card-header text-center">
            <b>Gezochte Reports</b>
        </div>
        
        <div class="card-body">
            @if(!empty($users[0]))
                <form action="{{ route('report.search') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" value="{{ $oldSearch }}" placeholder="Zoek op gebruiker voornaam">
                        <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                        </div>
                    </div>
                </form>
                <hr>
                @foreach ($users as $user)
                    <p class="border-bottom">
                        {{ $user->first_name.' '.$user->last_name }}
                    </p>
                    @foreach ($user->report as $report)
                        <div class="row">
                            <div class="del2">
                                @if($report->user_id === Auth::id() || Auth::user()->is_admin)
                                    <div class="col-sm-1">
                                        <a href="{{ route('report.edit', $report->id) }}" class="btn btn-secondary"><i class="fas fa-edit"></i></a>
                                    </div>
                                @endif
                            </div>

                            <div class="col-sm-11">
                                {{ date_format($report->created_at, 'd/m/Y H:i:s') .' | '. $report->title}} 
                            </div>
                        </div>
                        <div class="row">
                            <div class="del2">
                                @if(Auth::user()->is_admin)
                                    <form action="{{ route('report.destroy', $report->id) }}" method="post" class="col-sm-1 mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Weet u het zeker?')" style="height:45px; width:45px;">&nbsp;<i class="fa fa-times" aria-hidden="true"></i>&nbsp;</button>
                                    </form>
                                @elseif(Auth::check() && $report->user_id === Auth::id())
                                    <div class="col-sm-1"></div>
                                @endif
                            </div>
                            <div class="col-sm-10 ml-5">
                                <div class="border p-2"><b>Report: </b><?php echo($report->report); ?></div>
                            </div>
                        </div>
                        <div class="del1 mt-1 container">
                            @if(Auth::user()->is_admin)
                                <form action="{{ route('report.destroy', $report->id) }}" method="post" class="float-right">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Weet u het zeker?')">&nbsp;<i class="fa fa-times" aria-hidden="true"></i>&nbsp;</button>
                                </form>
                            @endif
                            @if(Auth::check() && $report->user_id === Auth::id() || Auth::check() &&  Auth::user()->is_admin)
                                <div class="float-right">
                                    <a href="{{ route('report.edit', $report->id) }}" class="btn btn-secondary"><i class="fas fa-edit"></i></a>
                                </div>
                            @endif
                        </div>
                        <hr class="m-5">
                    @endforeach
                @endforeach
            @else
                <p class="text-center">Geen reports gevonden</p>
                <p class="text-center"><a href="{{ route('report.create') }}">Klik hier om u eerst report aan te maken</a></p>
            @endif
        </div>
    </div>
</div>

@endsection