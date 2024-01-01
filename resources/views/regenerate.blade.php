<!-- resources/views/regenerate.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Regenerate Token</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <p>Please regenerate your token by clicking the button below:</p>
                        <form action="{{ url('regenerate/token/' . session('phone')) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Regenrate</button>
                        </form>
                        
                        

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
