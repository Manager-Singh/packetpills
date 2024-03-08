
<!-- <style>
  .alert-main {
    position: fixed;
    background-color: rgb(33 40 67 / 25%);
    top: 0;
    bottom: 0;
    right: 0;
    opacity: 1;
    width: 100%;
    z-index: 10;
    justify-content: center;
    align-items: center;
    display: flex;
}
.alert-main .alert {
    z-index: 1000;
    position: absolute;
    width: 50%;
}
.alert-main button.close:after{
    all:unset;
}
.message-alert {
    margin: 4rem;
    text-align: center;
    font-size: 16px;
}
 </style> -->
 @if($errors->any())
 <div class="alert-main">
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>

        @foreach($errors->all() as $error)
            {!! $error !!}<br/>
        @endforeach
    </div>
    </div>
@elseif(session()->get('flash_success'))
    <div class="alert-main">
    <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="message-alert">
        @if(is_array(json_decode(session()->get('flash_success'), true)))
            {!! implode('', session()->get('flash_success')->all(':message<br/>')) !!}
        @else
            {!! session()->get('flash_success') !!}
        @endif
        </div>
    </div>
</div>
@elseif(session()->get('flash_warning'))
 <div class="alert-main">
    <div class="alert alert-warning" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="message-alert">
        @if(is_array(json_decode(session()->get('flash_warning'), true)))
            {!! implode('', session()->get('flash_warning')->all(':message<br/>')) !!}
        @else
            {!! session()->get('flash_warning') !!}
        @endif
        </div>
    </div>
    </div>
@elseif(session()->get('flash_info'))
<div class="alert-main">
    <div class="alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="message-alert">
        @if(is_array(json_decode(session()->get('flash_info'), true)))
            {!! implode('', session()->get('flash_info')->all(':message<br/>')) !!}
        @else
            {!! session()->get('flash_info') !!}
        @endif
        </div>
    </div>
    </div>
@elseif(session()->get('flash_danger'))
<div class="alert-main">
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="message-alert">
        @if(is_array(json_decode(session()->get('flash_danger'), true)))
            {!! implode('', session()->get('flash_danger')->all(':message<br/>')) !!}
        @else
            {!! session()->get('flash_danger') !!}
        @endif
        </div>
    </div>
    </div>
@elseif(session()->get('flash_message'))
<div class="alert-main">

    <div class="alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="message-alert">
        @if(is_array(json_decode(session()->get('flash_message'), true)))
            {!! implode('', session()->get('flash_message')->all(':message<br/>')) !!}
        @else
            {!! session()->get('flash_message') !!}
        @endif
        </div>
    </div>
    </div>
@endif



@push('after-scripts')
<script>
jQuery(document).ready(function($){  
    $('.alert-main .close').click(function(){

    $('.alert-main').fadeOut();

    })

})


</script>

@endpush
