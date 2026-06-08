@extends('layouts.app_home')

@section('header')
<link rel="stylesheet" href="{{ asset('assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('content')
     
    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb" role="navigation" class="pull-left">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home fa"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">User Management</li>
                        </ol>
                    </nav>
                    <div class="pull-right ">
                        <a href="{{ route('home') }}" class="btn btn-danger btn-sm fsDefault" style="margin-left: 12px;">
                            <i class="fas fa-angle-double-left"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div id="accordion" class="panel-group">
                <div class="card card-default">
                    <div class="card-header" >
                        <h4 class="card-title" style="color: #32395c;"> LIST DATA USERS </a>
                        </h4>
                    </div>
                    <div class="card-body">                                
                        <div class="panel panel-default" style="border-color: #ddd;">                        
                            <div id="listItems" class="panel-body">
                                @if (Auth::user()->user_type == 'admin')
                                <a href="#" class="add-modal btn btn-primary btn-sm mb-2 fsDefault"><li><i class="fa fa-plus"></i> Add User</li></a>
                                @endif
                                <table class="table table-hover table-responsive table-bordered mb-0 data-table">
                                    <thead>
                                        <tr>
                                            <th class="txtCenter" width="20">No</th>
                                            <th class="txtCenter" width="280">Name</th>
                                            <th class="txtCenter" width="360">Full Name</th>
                                            <th class="txtCenter" width="280">Email</th>
                                            <th class="txtCenter" width="180">Type</th>
                                            <th class="txtCenter" width="180">Group</th>
                                            <th class="txtCenter" width="180">Status</th>
                                            <th class="txtCenter" width="130">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>                                
                            </div>
                        </div>
                    </div>
                </div>   
            </div>

            <div style="clear: both"></div>            
        </div>
    </div>

    <!-- Modal form to Add or Update -->
    <div id="addModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="registerForm" autocomplete="off">
                        @csrf
    
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
    
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" onkeyup="this.value = this.value.toUpperCase();" autofocus>
    
                                <span class="text-danger">
                                    <strong id="name-error"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="full_name" class="col-md-4 col-form-label text-md-right">{{ __('Full Name') }}</label>
    
                            <div class="col-md-6">
                                <input id="full_name" type="text" class="form-control" name="full_name" value="{{ old('full_name') }}" onkeyup="this.value = this.value.toUpperCase();" autofocus>
    
                                <span class="text-danger">
                                    <strong id="full_name-error"></strong>
                                </span>
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
    
                                <span class="text-danger">
                                    <strong id="email-error"></strong>
                                </span>
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required">
    
                                <span class="text-danger">
                                    <strong id="password-error"></strong>
                                </span>
                            </div>
                        </div>
    
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
    
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_type" class="col-md-4 col-form-label text-md-right">{{ __('User Type') }}</label>

                            <div class="col-md-6">
                                <select  class="form-control" id="user_type" name="user_type">
                                    {{-- <option value="-"> PILIH TYPE </option> --}}
                                    <option value="user" selected>USER</option>
                                    @if (Auth::user()->user_grp == 'all')
                                    <option value="admin">ADMIN</option>
                                    @endif
                                </select>

                                <span class="text-danger">
                                    <strong id="user_type-error"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="user_grp" class="col-md-4 col-form-label text-md-right">{{ __('User Group') }}</label>

                            <div class="col-md-6">
                                <select  class="form-control" id="user_grp" name="user_grp">
                                    {{-- <option value="-"> PILIH GROUP </option> --}}
                                    @if (Auth::user()->user_grp == 'supp' || Auth::user()->user_grp == 'all')
                                    <option value="supp" selected>SUPPLIER</option>
                                    @endif
                                    @if (Auth::user()->user_grp == 'cust' || Auth::user()->user_grp == 'all')
                                    <option value="cust" selected>CUSTOMER</option>
                                    @endif
                                    @if (Auth::user()->user_grp == 'all')
                                    <option value="all">ALL</option>
                                    @endif
                                </select>

                                <span class="text-danger">
                                    <strong id="user_grp-error"></strong>
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>

                            <div class="col-md-6">
                                <select  class="form-control" id="status" name="status">
                                    {{-- <option value="-"> PILIH TYPE </option> --}}
                                    <option value="activated" selected>ACTIVATED</option>
                                    <option value="deactivated">DEACTIVATED</option>
                                </select>

                                <span class="text-danger">
                                    <strong id="status-error"></strong>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm download fsDefault" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button> 
                    <button type="button" class="btn btn-primary btn-sm add fsDefault">
                        <span class='glyphicon glyphicon-check'></span> Save
                    </button>
                    <button type="button" class="btn btn-primary btn-sm edit fsDefault">
                        <span class='glyphicon glyphicon-check'></span> Update
                    </button> 
                </div> 
            </div>
        </div>
    </div>

    <!-- Modal form to delete -->
    <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title-del"></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                </div>
                <div class="modal-body">
                    <h3 class="text-center">Are you sure delete this data?</h3>
                    <input type="hidden" id="name_del"> 
                    {{-- <br /> --}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-sm fsDefault" data-dismiss="modal">
                            <span class='glyphicon glyphicon-remove'></span> Close
                        </button>
                        <button type="button" class="btn btn-danger btn-sm delete fsDefault" data-dismiss="modal">
                            <span id="" class='glyphicon glyphicon-trash'></span> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
<script src="{{ asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>

<script>
    var table = '';
    var vUrl = '{{ route('users') }}';

    $(function() {         
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: vUrl,
            @if (Auth::user()->user_type != 'admin')
            columnDefs: [
                { visible: false, width: 40, targets: 4 },
                { visible: false, width: 40, targets: 5 },
                { width: 720, targets: 2}
              ],
            @endif
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                {data: 'name', name: 'name'},
                {data: 'full_name', name: 'full_name'},
                {data: 'email', name: 'email'},
                {data: 'user_type', name: 'user_type'},
                {data: 'user_grp', name: 'user_grp'},
                {data: 'status', name: 'status'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            aLengthMenu: [[25, 50, 75, -1], [25, 50, 75, "All"]],
            iDisplayLength: 25,
            rowCallback: function( row, data, index ) {
                $('td', row).css({'padding':'4px 8px'});
                $('td:eq(0)', row).css({'text-align':'right'});
                $('td:eq(1)', row).css({'text-align':'left'});
                $('td:eq(2)', row).css({'text-align':'left'});
                $('td:eq(3)', row).css({'text-align':'left'});
                $('td:eq(4)', row).css({'text-align':'left'});
                $('td:eq(5)', row).css({'text-align':'left'});
                $('td:eq(6)', row).css({'text-align':'left'});
                $('td:eq(7)', row).css({'text-align':'center'});
                @if (Auth::user()->user_type != 'admin')
                $('td:eq(5)', row).css({'text-align':'center'});
                @endif
            },
        });
    });
</script>

<script>
    $(".card .card-header").css({"background-color": "rgb(0 43 255 / 19%)", "border": "1px solid #002bff17"});

    $(document).on('click', '.add-modal', function() {
        $('#name-error').html("");
        $('#full_name-error').html("");
        $('#email-error').html("");
        $('#password-error').html("");

        $('.modal-title').text('Add User');
        $('#name').prop('readonly', false);
        $('#name').val('');
        $('#full_name').val('');
        $('#email').val('');
        $('#password').val('');
        $('#password-confirm').val('');        
        $('#user_type').val('');
        $('#user_grp').val('');
        @if (Auth::user()->user_grp == 'supp')
        $('#user_type').val('user');
        $('#user_grp').val('supp');
        @endif
        @if (Auth::user()->user_grp == 'cust')
        $('#user_type').val('user');
        $('#user_grp').val('cust');
        @endif
        $('#status').val('activated');
        $('#addModal').modal({backdrop: 'static', keyboard: true});
        $('.edit').hide();
        $('.add').show();
    });

    $('.modal-footer').on('click', '.add', function() {        
        var registerForm = $("#registerForm");
        var formData = registerForm.serialize();

        $('#name-error').html("");
        $('#full_name-error').html("");
        $('#email-error').html("");
        $('#password-error').html("");
        $('#user_type-error').html("");
        $('#user_grp-error').html("");
        $('#status-error').html("");

        $.ajax({
            url: '{{ url('/users_save') }}',         
            type: 'POST',
            data: formData,
            success: function(data) {                
                // console.log(data);
                if(data.errors) {
                    if(data.errors.name){
                        $( '#name-error' ).html( data.errors.name[0] );
                    }
                    if(data.errors.email){
                        $( '#email-error' ).html( data.errors.email[0] );
                    }
                    if(data.errors.password){
                        $( '#password-error' ).html( data.errors.password[0] );
                    }                 
                }
                if(data.success) {
                    // setInterval(function(){ 
                    $('#addModal').modal('hide');
                    toastr.success('Data saved successfully!', {timeOut: 5000});
                    table.draw();
                    // }, 3000);
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        }); 
    });

    $(document).on('click', '.edit-modal', function() {
        var id = $(this).data('id');
        $.ajax({
            type: 'GET',
            url : '{{ url('/users') }}/'+encodeURIComponent(id)+'/edit',
            data: '',
            success: function(data)
            {
                $('.modal-title').text('Change Data User');
                $('#name').prop('readonly', true);
                $('#name').val(data.name);
                $('#full_name').val(data.full_name);
                $('#email').val(data.email);
                $('#user_type').val(data.user_type);
                $('#user_grp').val(data.user_grp);
                $('#status').val(data.status);
                $('#addModal').modal({backdrop: 'static', keyboard: true});
                $('.add').hide();
                $('.edit').show();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('.modal-footer').on('click', '.edit', function() {  
        $('#name-error').html("");
        $('#full_name-error').html("");
        $('#email-error').html("");
        $('#password-error').html("");
        $('#user_type-error').html("");
        $('#user_grp-error').html("");
        $('#status-error').html("");
        var registerForm = $("#registerForm");
        var formData = registerForm.serialize();

        $.ajax({
            url: '{{ url('/users_upd') }}',         
            type: 'POST',
            data: formData,
            success: function(data) {                
                // console.log(data);
                if(data.errors) {
                    if(data.errors.name){
                        $( '#name-error' ).html( data.errors.name[0] );
                    }
                    if(data.errors.email){
                        $( '#email-error' ).html( data.errors.email[0] );
                    }
                    if(data.errors.password){
                        $( '#password-error' ).html( data.errors.password[0] );
                    }                 
                }
                if(data.success) { 
                    $('#addModal').modal('hide');
                    toastr.success('Data updated successfully!', {timeOut: 5000});
                    table.draw();
                }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });      
    });

    $(document).on('click', '.delete-modal', function() {
        $('#name_del').val($(this).data('id'));
        $('.modal-title-del').text('Delete User');
        $('#deleteModal').modal('show');
    });
    
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'DELETE',
            url: '{{ url('/users_del') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'name': $('#name_del').val(),
            },
            success: function(data) {
                toastr.success('Data deleted successfully!', {timeOut: 5000});
                // $('#itemBody').load(location.href +' #itemBody>*','');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
</script>
@endsection
