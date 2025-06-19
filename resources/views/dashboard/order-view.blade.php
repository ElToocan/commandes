@extends('blank')

@section('title',$title)

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="d-flex gap-4 mb-4">

                    <a href="{{ route('view',['state'=>'en_attente']) }}"
                       class="btn btn-{{ session()->get('orderStateExpected') == 'en_attente' ? 'primary' : 'outline-primary' }} mr-2">
                        En attente </a>

                    <a href="{{ route('view',['state'=>'terminer']) }}"
                       class="btn btn-{{ session()->get('orderStateExpected') == 'terminer' ? 'success' : 'outline-success' }} mr-2">
                        Terminées </a>

                </div>

            </div>

            <div class="row">
                @foreach($orders as $order)
                    @livewire('order-view',['order'=> $order])
                @endforeach
            </div>

        </div>
    </div>
@endsection

