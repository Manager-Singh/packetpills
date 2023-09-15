<div class="col">
        @if($user->healthcard)
        <div class="row">
        <div class="col-md-6">
        <div class="card">
            <img class="card-img-top" src="{{asset('/').$user->healthcard->front_img}}" alt="Bologna" height=300>
        </div>
        </div>
        <div class="col-md-6">
        <div class="card">
            <img class="card-img-top" src="{{asset('/').$user->healthcard->back_img}}" alt="Bologna" height=300>
        </div>
        </div>
        </div>
   
           
        @endif
</div><!--table-responsive-->
<style>
    
    </style>
