@extends('templates.template')

@section('main')
    @foreach ($apartments as $apartment)
        <div>
            {{ $apartments }}
        </div>        
    @endforeach
@endsection