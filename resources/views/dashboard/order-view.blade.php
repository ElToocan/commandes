@extends('blank')

@section('title',$title)

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">

                <div class="d-flex gap-4 mb-2">

                    <a href="{{ route('view',['state'=>'en_attente']) }}"
                       class="btn btn-{{ session()->get('orderStateExpected') == 'en_attente' ? 'primary' : 'outline-primary' }} mr-2">
                        En attente </a>

                    <a href="{{ route('view',['state'=>'terminer']) }}"
                       class="btn btn-{{ session()->get('orderStateExpected') == 'terminer' ? 'success' : 'outline-success' }} mr-2">
                        Terminées </a>

                </div>

                <button class="btn btn-secondary mb-2 mr-2" type="button" data-toggle="collapse" data-target="#searchForm" aria-expanded="false" aria-controls="searchForm">
                    <i class="fa fa-filter"></i>
                </button>

                <div class="collapse" id="searchForm">
                    <form method="GET" action="{{ route('view', ['state' => session()->get('orderStateExpected')]) }}">
                        <div class="row g-3 align-items-center mb-2">
                            <div class="col-auto">
                                <input type="date" id="date" name="date" class="form-control"
                                       value="{{ request('date') }}">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-secondary">Rechercher</button>
                            </div>
                        </div>
                    </form>
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

