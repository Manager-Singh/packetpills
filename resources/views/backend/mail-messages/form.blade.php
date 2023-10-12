<div class="card-body">
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0">
                {{ __('labels.backend.access.mail-messages.management') }}
                <small class="text-muted">{{ __('labels.backend.access.mail-messages.create') }}</small>
            </h4>
        </div>
        <!--col-->
    </div>
    <!--row-->

    <hr>

    <div class="row mt-4 mb-4">
        <div class="col">
            <div class="form-group row">
                {{ Form::label('messsage', trans('validation.attributes.backend.access.mail-messages.message'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.mail-messages.message'), 'required' => 'required']) }}
                </div>
                <!--col-->
            </div>
            <div class="form-group row">
                {{ Form::label('message_for', trans('validation.attributes.backend.access.mail-messages.message_for'), ['class' => 'col-md-2 from-control-label required']) }}

                <div class="col-md-10">
                    {{ Form::text('message_for', null, ['class' => 'form-control', 'placeholder' => trans('validation.attributes.backend.access.mail-messages.message_for'), 'required' => 'required']) }}
               {{-- ,'disabled' => 'disabled' --}}
               
                </div>
                <!--col-->
            </div>
         
            <!--form-group-->

            <div class="form-group row">
                {{ Form::label('status', trans('validation.attributes.backend.access.mail-messages.status'), ['class' => 'col-md-2 from-control-label required']) }}
                <div class="col-md-10">
                    <div class="checkbox d-flex align-items-center">
                        <label class="switch switch-label switch-pill switch-primary mr-2" for="role-1"><input class="switch-input" type="checkbox" name="status" id="role-1" value="1" 
                        {{ ( !isset($mailMessage) || ( isset($mailMessage) && $mailMessage->status === 1)) ? "checked" : "" }}><span class="switch-slider" data-checked="on" data-unchecked="off"></span></label>
                    </div>
                </div>
                <!--col-->
            </div>
            <!--form-group-->
        </div>
        <!--col-->
    </div>
    <!--row-->
</div>
<!--card-body-->

@section('pagescript')
<script type="text/javascript">
    FTX.Utils.documentReady(function() {
        FTX.mailMessages.edit.init("{{ config('locale.languages.' . app()->getLocale())[1] }}");
    });
</script>
@stop