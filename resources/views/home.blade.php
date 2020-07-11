@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> {{ __('Blog List') }} </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('status_err'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status_err') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="row pb-10">
                            <div class="col-md-6">
                                
                                <a href="{{ route('add-blog')}}" class="btn btn-info"> POST New Blog </a>
                            </div>
                            <div class="col-md-6">
                                <input type="search" id="datepicker" class="form-control search" name="search" placeholder="Search by Created Date" autocomplete="off" readonly="">
                            </div>
                        </div>
                    <div id="filterData">
                    <table class="table">
                       <tr>
                            <th> BLog Title </th> 
                            <th> Blog Description </th> 
                            <th> Categories </th> 
                            <th> Created Date  </th> 
                            <th> Event Status </th>  
                       </tr>

                       <tbody>
                           @foreach($data as $value) 
                                <tr>
                                    <th> {{ $value->title }}</th>
                                    <th> {{ $value->description }}</th>
                                    <th> {{ $value->categories() }}</th>
                                    <th> {{ $value->created_at }}</th>
                                    <th> {{ $value->is_active == 1 ? 'Active' : 'In-active' }}</th>
                                </tr>
                           @endforeach
                       </tbody>
                    </table>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

     <script type="text/javascript">
        $(function() {
        $('#datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            minDate: 0,
        });
    });

    $(document).on('change', '#datepicker', function(){
        search =  $(this).val();
        $.get("{{ route('home')}}", { search }, function(resp) {
            $("#filterData").html(resp);
        })
    })
</script>

@endsection