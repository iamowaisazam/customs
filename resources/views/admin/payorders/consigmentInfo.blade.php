<section class="card">
    <header class="card-header bg-info">
          <h4 class="mb-0 text-white">Jobs With Consignment information</h4>
    </header>
    <div class="card-body">
    
       <div class="row">
          <input type="hidden" name="consignment_id" value="{{$consignment->id}}" />

          <div class="col-md-4">
              <div class="form-group">
                  <label class="form-label">Job Number (Auto)</label>
                  <input readonly type="text" value="{{$consignment->job_number_prefix}}" name="job_number" 
                  class="form-control" placeholder="Job Number">
                  @if($errors->has('job_number'))
                   <p class="text-danger" >{{ $errors->first('job_number') }}</p>
                  @endif 
              </div>
          </div>

          <div class="col-md-3">
              <div class="form-group">
                  <label class="form-label">Your REF</label>
                  <input required value="{{$consignment->your_ref}}" name="your_ref" 
                  class="form-control" placeholder="Your REF">
                  @if($errors->has('your_ref'))
                   <p class="text-danger" >{{ $errors->first('your_ref') }}</p>
                  @endif 
              </div>
          </div>

          <div class="col-md-3">
              <div class="form-group">
                  <label class="form-label">BL/AWB No</label>
                  <input value="{{$consignment->blawbno}}"
                  class="form-control" name="blawbno" placeholder="BL/AWB No">
              </div>
          </div>
      <div class="col-md-3">
          <div class="form-group">
              <label class="form-label">Package Type</label>
              <select class="form-control" name="package_type" >
                  @foreach ($package_types as $p)
                      <option @if($consignment->package_type == $p) selected @endif 
                          >{{$p}}</option>
                  @endforeach
              </select>
              @if($errors->has('package_type'))
                  <p class="text-danger" >{{ $errors->first('package_type') }}</p>
              @endif 
          </div>
      </div>
      <div class="col-md-3">
          <div class="form-group">
              <label class="form-label">No Of Packages</label>
              <input value="{{$consignment->no_of_packages}}" name="no_of_packages" 
              class="form-control" placeholder="No of Packages">
              @if($errors->has('no_of_packages'))
                  <p class="text-danger" >{{ $errors->first('no_of_packages') }}</p>
              @endif 
          </div>
      </div>
      <div class="col-md-3">
          <div class="form-group">
              <label class="form-label">Vessel / Flight Name</label>
              <input required value="{{$consignment->vessel}}" name="vessel" 
              class="form-control" placeholder="Vessel">
              @if($errors->has('vessel'))
               <p class="text-danger" >{{ $errors->first('vessel') }}</p>
              @endif 
          </div>
      </div>
      <div class="col-md-3">
          <div class="form-group">
              <label class="form-label">IGM No</label>
              <input required value="{{$consignment->igmno}}" name="igmno" 
              class="form-control" placeholder="IGM No">
              @if($errors->has('igmno'))
               <p class="text-danger" >{{ $errors->first('igmno') }}</p>
              @endif 
          </div>
      </div>
      <div class="col-md-3">
              <div class="form-group">
                  <label class="form-label">IGM Date</label>
                  <input required type="date"  value="{{ \Carbon\Carbon::parse($consignment->igm_date)->format('Y-m-d') }}" name="igm_date" 
                  class="form-control" placeholder="IGM Date">
                  @if($errors->has('igm_date'))
                  <p class="text-danger" >{{ $errors->first('igm_date') }}</p>
                  @endif 
              </div>
         </div>
         <div class="col-md-4">
              <div class="form-group">
                  <label class="form-label">Select Invoice Currency</label>
                  <select class="form-control" name="currency">
                      @foreach ($currencies as $cr)
                      <option @if($model->currency == $cr['code']) selected @endif value="{{$cr['code']}}">{{$cr['code']}}</option>
                  @endforeach
                  </select>
                  @if($errors->has('currency'))
                  <p class="text-danger" >{{ $errors->first('currency') }}</p>
                  @endif 
              </div>
          </div>
      </div> 
  </div>
</section>