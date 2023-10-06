<div class="col">
 <h4 class="text-center">Medications Details</h4>
    @if ($user->insurance)
        <div class="panel-group wrap myaccordion" id="accordionprimaryI" role="tablist" aria-multiselectable="true">
            <div class="panel">
                <div class="panel-heading" role="tab" id="headingprimaryI">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordionprimaryI"
                            href="#collapseprimaryI" aria-expanded="true"
                            aria-controls="collapseprimaryI">
                            Primary Insurance
                        </a>
                    </h4>
                </div>
                <div id="collapseprimaryI" class="panel-collapse collapse in" role="tabpanel"
                    aria-labelledby="headingprimaryI">
                    <div class="panel-body">
                        
                    </div>
                </div>
            </div>
        </div>


    @endif
   
</div><!--table-responsive-->
