@extends('layouts.theme')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Products info </h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <input type="text" class="form-controller" id="search" name="search" style="margin-left: 0px;padding-right: 500px"></input>
                </div>
                <div id="data">

                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#search').on('keyup',function(){
        $value=$(this).val();
        $.ajax({
            type : 'get',
            url : '{{URL::to('search')}}',
            data:{'search':$value},
            success:function(data){
                //$('#data').html(data);
                document.getElementById("data").innerHTML=data;
            }
        });
    })
</script>
<script type="text/javascript">
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
</script>
@endsection
