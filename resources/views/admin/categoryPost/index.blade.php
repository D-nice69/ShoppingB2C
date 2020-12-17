@extends('adminPartials.layout')
@section('title')
Post categories List
@endsection
@section('js')
<script src="{{ asset('admins/delete/delete.js') }}"></script>
<script src="js/dataTables/brand.js"></script>
@endsection
@section('content')
@include('admin.toast')
<div class="table-agile-info">
    <div class="panel panel-default">
        <div class="panel-heading">
            Danh sách danh mục bài viết
        </div>
        <br/>
        {{-- <div class="row w3-res-tb">
            <div class="col-sm-5 m-b-xs">
                <select class="inpu\t-sm form-control w-sm inline v-middle">
                    <option value="0">Bulk action</option>
                    <option value="1">Delete selected</option>
                    <option value="2">Bulk edit</option>
                    <option value="3">Export</option>
                </select>
                <button class="btn btn-sm btn-default">Apply</button>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-3">
                <div class="input-group">
                    <input type="text" class="input-sm form-control" placeholder="Search">
                    <span class="input-group-btn">
                        <button class="btn btn-sm btn-default" type="button">Go!</button>
                    </span>
                </div>
            </div>
        </div> --}}
        <div class="table-responsive">
            <table id="myTable" class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th style="width:20px;">
                            <label class="i-checks m-b-none">
                                <input type="checkbox"><i></i>
                            </label>
                        </th>
                        <th>Tên</th>
                        <th>Mô tả</th>
                        <th>Ẩn/Hiện</th>
                        <th style="width:30px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cPosts as $cpost)
                    <tr>
                        <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                        </td>
                        <td>{{ $cpost->name }}</td>                        
                        <td>{{ $cpost->description }}</td>                        
                        <td>
                            <span class="text-ellipsis">
                                @if($cpost->status==0)
                                <a href="{{ route('categoryPost.unactive',['id'=>$cpost->id]) }}"><span
                                        class="fa fa-eye"></span></a>
                                @else
                                <a href="{{ route('categoryPost.active',['id'=>$cpost->id]) }}"><span
                                        class="fa fa-eye-slash"></span></a>
                                @endif
                            </span>
                        </td>
                        <td>
                            {{-- @can('edit_product') --}}
                            <a href="{{ route('categoryPost.edit',['id'=>$cpost->id]) }}">
                                <i class="fa fa-pencil-square-o text-success text-active"></i>
                            </a>
                            {{-- @endcan --}}
                            {{-- @can('delete_product') --}}
                            <a href="" class="action_delete"
                                data-url="{{ route('categoryPost.delete',['id'=>$cpost->id]) }}">
                                <i class="fa fa-times text-danger text"></i>
                            </a>
                            {{-- @endcan --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <footer class="panel-footer">
            <div class="row">
                <div class="col-sm-5 text-center">
                        <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                    </div>
                <div class="col-sm-7 text-right text-center-xs">
                    {{$cPosts->links()}}
                </div>
            </div>
        </footer> --}}
    </div>
</div>
@endsection