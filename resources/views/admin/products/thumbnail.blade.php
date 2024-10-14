<section class="card">
    <header class="card-header bg-info">
        <h4 class="mb-0 text-white">Image</h4>
    </header>
    <div class="card-body">       
            <div class="form-group my-2 file_manager_parent" > 
                <label class="form-label" for="">Thumbnail : </label>
                <select placeholder="Select an option" class="file_manager" name="image">
                    <option id="{{$product->image}}" value="{{$product->image}}">{{$product->image}}</option>
                </select>
            </div>
            
            <div class="form-group my-2 file_manager_parent" > 
                <label class="form-label" for="">Hover Image :</label>
                <select placeholder="Select an option" class="file_manager" name="hover_image">
                    <option id="{{$product->hover_image}}" value="{{$product->hover_image}}">{{$product->hover_image}}</option>
                </select>
                @if($product->get_hover_image)
                    <img class="pt-3" style="width: 100px" height="100px" src="{{asset($product->get_hover_image->path)}}" />
                @endif
            </div>
      </div>
</section>