<div class="accounts col-lg-12">
    <section class="card">
        <header class="card-header bg-info">
            <h4 class="mb-0 text-white">Accounts</h4>
        </header>
        <div class="card-body">
            <?php 
            $header = json_decode($model->header);    
            // dd($header);
            ?>

            <div class="row">
                <div class="col-md-5 nopadding">
                    <div class="form-group">
                        <label>Account</label>
                        <input value="Dues" name="header[title]" value="{{$header->title ?? ''}}"
                        class="form-control" />
                    </div>
                </div>
                <div class="col-md-2 nopadding">
                        <label>Amount</label>
                        <input readonly value="{{$header->amount ?? ''}}" name="header[amount]" class="gtotal form-control" />
                </div>
                <div class="col-md-5 nopadding">
                    <div class="form-group">
                        <label>Pay Order In Favor OF</label>
                            <input value="{{$header->company ?? ''}}" name="header[company]" 
                            class="form-control" />
                    </div>
                </div>
            </div>

            <div class="data_rows" >
            
            </div>
            <div class="row">
                <div class="col-12 text-center ">
                    <button class="add_row btn btn-success text-white" type="button">
                    <i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>
    </section>
</div>