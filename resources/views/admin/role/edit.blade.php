@extends('adminPartials.layout')
@section('title')
Update role
@endsection
@section('css')
<link rel="stylesheet" href="css/bootstrap4.css">
<style>
    .card-header {
        padding: 10px;
    }
    .card-body {
        padding: 10px;
    }
</style>
@endsection
@section('js')
{{-- <script src="js/jquery3.2.1.js"></script> --}}
{{-- <script src="js/bootstrap4.js"></script> --}}
{{-- <script src="js/ajax.js"></script> --}}
<script>
    $('.checkbox_wrapper').on('click',function(){
        $(this).parents('.card').find('.checkbox_child').prop('checked',$(this).prop('checked'));
    });
</script>
@endsection
@section('content')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Sửa vai trò
        </header>
        <form role="form" action="{{ route('role.update',['id'=>$role->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="panel-body">
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $role->name }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Mô tả vai trò</label>
                        <input class="form-control @error('display_name') is-invalid @enderror" name="display_name"
                            value="{{ $role->display_name }}">
                        @error('display_name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                @foreach($permission_parents as $key=>$permission_parent)
                <div class="col-12">
                    <div class="card border-primary">
                        <div class="card-header">
                            <label>
                                <input type="checkbox" class="checkbox_wrapper">
                                {{ $permission_parent->name }}
                            </label> 
                        </div>
                        <div class="card-body text-primary">
                            <div class="form-check-inline col-12">
                               @foreach($permission_parent->permissionChild as $key => $value)
                                <div class="col-{{ 12/$permission_parent->permissionChild->count() }}">
                                    <label>
                                        <input type="checkbox" {{ ($permission_role->contains('id',$value->id)) ? 'checked' : '' }} 
                                        value="{{ $value->id }}" 
                                        name="permission_id[]"
                                        class="checkbox_child">
                                        {{ $value->name }}
                                    </label>
                                </div>   
                               @endforeach
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
                @endforeach
                               
                <button type="submit" class="btn btn-info">Sửa</button>

            </div>
        </form>
    </section>
</div>
@endsection