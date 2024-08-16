@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="list-unstyled mt-3" style="">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (Session::has('error_message'))
    <div class="alert alert-warning alert-dismissible fade show text-white" role="alert">
        <strong>Error : &nbsp;&nbsp;</strong>&nbsp;&nbsp;{{ Session::get('error_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (Session::has('success_message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success:&nbsp;&nbsp; </strong>&nbsp;&nbsp;{{ Session::get('success_message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
