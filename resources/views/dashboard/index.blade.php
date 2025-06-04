<div class="content">
    <div class="container">
        <div class="row">

            @foreach($orders as $order)
                @if($order->state == "en cours" )

                    <!-- card left-->
                    <div class="col-lg-3">
                        <div class=" {{ $order->type == 'Emporter' ? 'card card-danger card-outline' : 'card card-primary card-outline' }}  ">
                            <div class="card-header">
                                <h5 class="card-title m-0">Commande {{$order->id}}</h5>
                            </div>
                            <div class="card-body">
                                <h6 class="card-title">{{$order->type}}</h6>
                                <br><br>


                                @foreach(\App\Models\OrderLine::where('order_id',$order->id)->get() as $orderLine)
                                    <p class="card-text"> {{ \App\Models\Product::where('id',$orderLine->product_id)->first()->name .' x'.$orderLine->quantity }} </p>
                                @endforeach

                                <a href="#" class="btn btn-danger">Annuler</a>
                                <a href="#" class="btn btn-success">Valider</a>
                            </div>
                        </div>
                    </div>
                @endif

            @endforeach



            <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
