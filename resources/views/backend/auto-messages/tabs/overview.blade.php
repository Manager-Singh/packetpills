<div class="col">
    <div class="row">
        <div class="col-md-6">
        <p>Page {{$iteam->page_no}}. Prescription</p>
            <img src="https://www.gravatar.com/avatar/a5a6282196510b708b24535a22e21974.jpg?s=80&amp;d=mm&amp;r=g" class="user-profile-image">
        </div>
        <div class="col-md-6">
        <div class="card">
            <h5 class="card-header">Medications Detials</h5>
            <div class="card-body">
                <!-- <h5 class="card-title">Medications Detials</h5> -->
                {{ Form::model($prescription, ['route' => ['admin.prescriptions.update', $prescription], 'class' => '', 'role' => 'form', 'method' => 'PATCH', 'id' => 'edit-role', 'files' => true]) }}
                    <div class="form-row">
                        <div class="form-group col-md-12">
                        <label for="inputEmail4">Drugs</label>
                        <select class="drugs form-control" name="drug_id">
                            @if($drugs)
                            @foreach($drugs as $drug)
                            <option value="{{$drug->id}}">{{$drug->name}}</option>
                            @endforeach
                            @endif
                                
                                </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="input-drug-qty-filled">Quantity Filled</label>
                            <input type="number" class="form-control" id="input-drug-qty-filled" placeholder="Quantity Filled">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    {{ Form::close() }}

            </div>
        </div>
            
        
        </div>
        
    </div>
</div><!--table-responsive-->

@push('after-scripts')
<script>

    // In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('.drugs').select2();
});
</script>
@endpush
