<section class="card">
    <header class="card-header bg-info">
          <h4 class="mb-0 text-white">Jobs With Consignment information</h4>
    </header>
    <div class="card-body">
    
       <div class="row">
          <input type="hidden" name="consignment_id" value="{{$consignment->id}}" />

          <div class="col-md-3">
              <div class="form-group">
                  <label class="form-label">Job Number (Auto)</label>
                  <input readonly type="text" value="{{$consignment->job_number_prefix}}" class="form-control" placeholder="Job Number" />
              </div>
          </div>

          <div class="col-md-3">
              <div class="form-group">
                  <label class="form-label">Consignee (Company Name)</label>
                  <input readonly  value="{{$consignment->customer->customer_name}}" 
                  class="form-control" placeholder="Consignee (Company Name)" />
              </div>
          </div>

          <div class="col-md-3">
              <div class="form-group">
                  <label class="form-label">BL/AWB No</label>
                  <input readonly value="{{$consignment->blawbno}}"
                  class="form-control" placeholder="BL/AWB No">
              </div>
          </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">Package Type</label>
                    <input readonly class="form-control" value="{{$consignment->package_type}}" />
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">No Of Packages</label>
                <input readonly value="{{$consignment->no_of_packages}}"  class="form-control" />
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">Vessel / Flight Name</label>
                <input readonly  value="{{$consignment->vessel}}"  
                class="form-control" placeholder="Vessel">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label class="form-label">IGM No</label>
                <input  readonly value="{{$consignment->igmno}}" class="form-control"  />
            </div>
        </div>

        <div class="col-md-3">
              <div class="form-group">
                  <label class="form-label">IGM Date</label>
                  <input  type="date" readonly  value="{{ \Carbon\Carbon::parse($consignment->igm_date)->format('Y-m-d') }}" class="form-control" placeholder="IGM Date">
              </div>
         </div>
         <div class="col-md-3">
              <div class="form-group">
                  <label class="form-label">Select Invoice Currency</label>
                  <input  readonly  value="{{$consignment->currency}}" class="form-control"  />
              </div>
          </div>

      </div> 
  </div>
</section>