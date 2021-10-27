@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (Auth::user()->hasRole('superadministrator'))
                        You are logged in as Super Admin!
                    @endif
                    @if (Auth::user()->hasRole('administrator'))
                        You are logged in as Admin!
                    @endif
                    @if (Auth::user()->hasRole('instructor'))
                        You are logged in as Instructor!
                    @endif
                    @if (Auth::user()->hasRole('student'))
                        You are logged in as Student!
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
