@csrf 
<div class="row">
    @foreach($prescription->medications as $key => $medication)
    <div class="col-3 mb-2 medication-se">
        <label class="card">
            <input class="card__input" name="medication_ids[]" value="{{ $medication->id }}" type="checkbox"/>
            <div class="card__body">
            <div class="card__body-cover card__body-cover-image">
                <span class="card__body-cover-checkbox"> 
                    <svg class="card__body-cover-checkbox--svg" viewBox="0 0 12 10">
                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                    </svg>
                </span>
            
                <div class="details-main ">
                    <div class="doctor-se">
                        <span class="title-la">Doctor Name: </span>  <span class="title-he">{{ $medication->prescribing_doctor }}</span> 
                    </div>
                    <div class="drug-se">
                        <span class="title-la">Drug Name: </span>  <span class="title-he">{{ $medication->drug_name }}</span> 
                    </div>
                    <div class="price">
                        <span class="title-la subtitle">Price: </span> <span class="title-he"> ${{ $medication->price }} </span>
                    </div>
                </div>
            
                </div>
            </div>
        </label>
    </div>
    @endforeach
    </div> <!-- row -->
    <input type="hidden" name="prescription_id" value="{{ $prescription->id }}"/>
    <div class="row">
    <div class="col-md-12 text-center">
    <button type="submit" class="btn btn-primary btn-lg order-btn submit">Submit To Refill</button>
    </div>
    </div><!-- row -->

</div>