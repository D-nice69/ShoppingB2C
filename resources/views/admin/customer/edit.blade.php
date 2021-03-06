@extends('adminPartials.layout')
@section('title')
Edit customer
@endsection
@section('js')

{{-- <script>
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
</script> --}}
@endsection
@section('content')
<div class="form-w3layouts">
    <section class="panel">
        <header class="panel-heading">
            Phân quyền người dùng
        </header>
        <div class="panel-body">
            <div class="col-12">
                <form role="form" action="{{ route('adminCustomer.update',['id'=>$customer->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên</label>
                        <input disabled class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ $customer->name }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input disabled class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ $customer->email }}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">SĐT</label>
                        <input disabled class="form-control @error('phone') is-invalid @enderror" name="phone"
                            value="{{ $customer->phone }}">
                        @error('phone')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="">Vai trò</label>
                        <select class="form-control select2_multiple  @error('role_id') is-invalid @enderror" name="role_id">
                            @foreach($roles as $key=>$role)
                            <option {{ ($role->id == $roleCustomer->id) ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-info">Cập nhật</button>
                </form>
            </div>

        </div>
    </section>
</div>
@endsection