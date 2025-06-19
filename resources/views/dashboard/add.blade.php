@extends('blank')

@section('title',$title)

@section('content')
<div class="content">
    <div class="container">
        <div class="row">

            <div class="col">

                @livewire('commande-form')

            </div>

        </div>
    </div>
</div>
@endsection
