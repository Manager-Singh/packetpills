<div class="col">
        @if($user->insurance)
            @foreach($user->insurance as $insurance)
              
                       
        <div class="col">     
        <div class="row">
        <div class="col-md-6">
        <div class="card">
            <img class="card-img-top" src="{{asset('/').$insurance->front_img}}" alt="Bologna" height=300>
        </div>
        </div>
        <div class="col-md-6">
        <div class="card">
            <img class="card-img-top" src="{{asset('/').$insurance->back_img}}" alt="Bologna" height=300>
        </div>
        </div>
        </div>
        </div><!--table-responsive-->
                 
              
            @endforeach
        @endif
</div><!--table-responsive-->




<style>
    p.card-text span {
    width: 100%;
    display: flex;
}
    </style>
