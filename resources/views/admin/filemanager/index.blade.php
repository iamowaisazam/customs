@extends('admin.layout')
@section('css')

<link rel="stylesheet" type="text/css"
href="{{asset('admin/assets/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')}}">
<link rel="stylesheet" type="text/css"
href="{{asset('admin/assets/node_modules/datatables.net-bs4/css/responsive.dataTables.min.css')}}">
<link href="{{asset('admin/assets/node_modules/switchery/dist/switchery.min.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="admin/assets/css/search-table.css">

<link rel="stylesheet" href="{{asset('admin/assets/css/pages/search-table.css')}}">
<style>
   

    @media (max-width: 767px){
        .container-fluid, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {
           
            overflow: scroll!important;
        }
    }
    #popupFormContainer {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #ffffff;
        padding: 20px;
        border: 1px solid #ccc;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
        z-index: 1000;
    }

    /* Styles for the form inside the popup */
    #popupFormContainer form {
        width: 100%;
    }

    /* Styles for the form inputs */
    #popupFormContainer input[type="text"],
    #popupFormContainer input[type="file"],
    #popupFormContainer button {
        width: 100%;
        margin-bottom: 10px;
    }

    /* Styles for the buttons */
    #popupFormContainer button {
        padding: 10px;
        border: none;
        cursor: pointer;
    }

    /* Styles for the close button */
    #closePopupBtn {
        background-color: #ff0000;
        color: #ffffff;
    }
    header.card-header.bg-info {
    text-align: center;
    }
p.text-success, p.text-danger {
    text-align: center;
}
</style>
@endsection

@section('content')
      <!--popup code -->
  

      <!--Endpopup code -->



    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">ALL Files List 
            </h4>
        </div>
        <div class="col-md-7 align-self-center text-end">
            <div class="d-flex justify-content-end align-items-center">
                <ol class="breadcrumb justify-content-end">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">filesmanager</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <section class="card">
                <header class="card-header bg-info">
                    <h4 class="mb-0 text-white">File Filters</h4>
                </header>
                <div class="card-body">    
                    <div class="table-responsive">
                        <div class="container">
                            <form id="orderForm">
                                <div class="row">
                                    <div class="col">
                                        <label for="customerName">File ID:</label>
                                        <input type="number" placeholder="ID" class="customerName id"/>
                                    </div>
                                    <div class="col">
                                        <label for="email">Group:</label>
                                        <select class="customerName group">
                                            <option value="" disabled selected>Select Group</option>
                                            @foreach($uniqueGroups as $val)
                                                <option value="{{$val}}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col">
                                        <label for="phone">Extension:</label>
                                        <select class="customerName extension">
                                            <option value="" disabled selected>Select Extension</option>
                                            @foreach($uniqueExtensions as $val)
                                                <option value="{{$val}}">{{$val}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="address">Title:</label>
                                        <input type="text" placeholder="Title" class="customerName title "/>
                                    </div>
                                    <div class="col">
                                        <label for="orderNumber">File Size:</label>
                                        <input type="number" placeholder="Size" class="customerName size"/>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="startDate">Start Date:</label>
                                        <input type="date" class="startDate" id="startDate" >
                                    </div>
                                    <div class="col">
                                        <label for="endDate">End Date:</label>
                                        <input type="date" class="endDate " id="endDate" >
                                    </div>
                                </div>

                                <div class="sidebar">
                                    <button type="button" class="search_result" id="searchorders">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- page start-->
                <div class="row">
                    <div class="col-sm-12">
                        <section class="card">
                          <header class="card-header bg-info" style="display: flex; justify-content: space-between;">
                            <h4 class="mb-0 text-white">All files List</h4>
                            <button id="openPopupBtn" class="btn btn-primary text-white">Add Files</button>
                          </header> 
                        <div class="card-body">    
                          <div class="table-responsive">
                            <table id="example23" class="mydatatable display nowrap table table-hover table-striped border" cellspacing="0" width="100%">
                                    <thead>
                                        
                                        <tr class="" >
                                            <th class="hidden-phone">Action</th> 
                                            <th>#ID</th>
                                            <th>Grouping</th>
                                            <th>Image</th>
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>Extension</th>
                                            {{-- <th>Type</th> --}}
                                            <th>Size</th>
                                            {{-- <th>Path</th> --}}
                                         
                                        </tr>
                                     </thead>
                                    <tbody>
                             </tbody>
                        </table>
                    </div>
                    </div>
                </div>
           </section>
        </div>
      </div>
      
      
@include('admin.filemanager.addpopup')

@endsection
 @section('js')

       <!-- This is data table -->
       
       <script src="{{asset('admin/assets/node_modules/datatables.net/js/jquery.dataTables.min.js')}}">
       </script>
       
       <script src="{{asset('admin/assets/node_modules/datatables.net-bs4/js/dataTables.responsive.min.js')}}">
       </script>
       
       <script src="{{asset('admin/assets/node_modules/switchery/dist/switchery.min.js')}}"></script>
       
       <script>
        $(function () {
          
            var application_table = $('.mydatatable').DataTable({
           processing: true,
            "searching": true,  
            fixedColumns: false,
            fixedHeader: false,
            scrollCollapse: false,
            scrollX: true,
            // scrollY: '500px',
            autoWidth: false, 
            dom: 'lfrtip',
            serverSide: true,
            lengthMenu: [[10,25, 50, 100,500],[10,25, 50, 100,500]],
            ajax: {
                url: "{{URL::to('/admin/filemanager')}}",
                type: "GET",
                data: function ( d ) {
                    d.id = $('.id').val();
                    d.startDate = $('.startDate').val();
                    d.endDate = $('.endDate').val();
                    d.title = $('.title').val();
                    d.type = $('.type').val();
                    d.fileName = $('.fileName').val();
                    d.size = $('.size').val();
                    d.path = $('.path').val();
                    d.extension = $('.extension').val();
                    d.group = $('.group').val();

                }
            },
            initComplete: function () {  
                $('.js-switch').each(function () {
                   new Switchery($(this)[0], $(this).data());
                 });               
            }
        });
        
        $("#searchButton").click(e =>{ 
            application_table.search($('input[type=search]').val());
            application_table.draw();
        });
        $('.search_result').click(function(){          
           
            // users_table.search($('input[type=search]').val());
            application_table.draw();
        }); 
        $("#example23 thead .row-checkbox").change(function (e) { 
            var isChecked = $(this).prop('checked');
            $('#example23 tbody .row-checkbox').prop('checked', isChecked);
        });

     


      });
      
    var openPopupBtn = document.getElementById('openPopupBtn');
    var popupFormContainer = document.getElementById('popupFormContainer');
    var closePopupBtn = document.getElementById('closePopupBtnn');


    openPopupBtn.addEventListener('click', function() {
        popupFormContainer.style.display = 'block';
    });


    closePopupBtn.addEventListener('click', function() {
        popupFormContainer.style.display = 'none';
    });




    document.getElementById('fileUploadForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var submitButton = document.getElementById('btn-submit-files');
    const jsonDisplay = document.getElementById('jsonDisplay');
    var form = this;

    document.getElementById('loader').style.display = 'block';
    submitButton.style.color = 'transparent';
    submitButton.disabled = true;

    var errorMessage = document.getElementById('error-message');
    var allFieldsFilled = true;

    // Prepare form data
    var formData = new FormData(form);
    form.querySelectorAll('[required]').forEach(function(input) {
        if (!input.value) {
            allFieldsFilled = false;
        }
    });

    if (!allFieldsFilled) {
        document.getElementById('loader').style.display = 'none';
        submitButton.style.color = '';
        submitButton.disabled = false;
        errorMessage.style.display = 'block';
        return;
    } else {
        errorMessage.style.display = 'none';
    }

    // Send AJAX request
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => {
        document.getElementById('loader').style.display = 'none';
        submitButton.style.color = '';
        submitButton.disabled = false;

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            jsonDisplay.innerHTML = "<p class='text-success'>" + data.success + "</p>";
            updateLastRecord(data.getData);
        } else {
            jsonDisplay.innerHTML = "<p class='text-danger'>" + (data.error || 'An error occurred') + "</p>";
        }
    })
    .catch(error => {
        console.error('Error:', error);
        jsonDisplay.innerHTML = "<p class='text-danger'>" + error.message + "</p>";
    });
});

function updateLastRecord(data) {
    var application_table = $('.mydatatable').DataTable();
    var lastRowIndex = application_table.rows().count() - 1; 
    var rowData = application_table.row(lastRowIndex).data();

 
    rowData[0] = data.field1;
    rowData[1] = data.field2;
   


    application_table.row(lastRowIndex).data(rowData).draw();
}



    </script>
@endsection