@extends('layout.main')

@section('content')
    <h2>Convert from decimal to binary</h2>
    <form action="{{route('binary.convert')}}">
        <div class="form-group">
            <input type="hidden" name="from" value="decimal">
            <input type="text" name="number" class="form-control" @if(isset($dec_original)) value="{{$dec_original}}" @endif>
        </div>
        <button type="submit" class="btn btn-success">Convert</button>
    </form>
    <h3>Result: {{$decimal ?? ''}}</h3>

    <h2>Convert from binary to decimal</h2>
    <form action="{{route('binary.convert')}}">
        <div class="form-group">
            <input type="hidden" name="from" value="binary" >
            <input type="text" name="number" class="form-control" @if(isset($bin_original)) value="{{$bin_original}}" @endif>
        </div>
        <button type="submit" class="btn btn-success">Convert</button>
    </form>
    <h3>Result: {{$binary ?? ''}}</h3>
@stop
