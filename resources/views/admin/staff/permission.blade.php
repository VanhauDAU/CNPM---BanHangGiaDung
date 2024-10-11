@extends('layouts.admin')

@section('title')
    Phân Quyền Nhóm: {{$staff->ten_chuc_vu}}
@endsection

@section('content-admin')
<div class="container d-flex mb-4 justify-content-center align-items-center">
    <a href="{{route("admin.staffs.index")}}" class="btn btn-warning me-5">Quay Lại</a>
    <h1 class="text-start m-0 fw-bold fs-4 p-0">Phân Quyền Nhóm: {{$staff->ten_chuc_vu}}</h1>
</div>
<form action="" method="POST">
    @csrf
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="20%">Module</th>
                <th>Quyền</th>
            </tr>
        </thead>
        <tbody>
            @if($modules->count())
                @foreach($modules as $module)
            <tr>
                <td>{{$module->title}}</td>
                <td>
                    <div class="row">
                        @if(!empty($roleListArr))
                            @foreach($roleListArr as $roleName => $roleLabel)
                                <div class="col-2">
                                    <label for="role_{{$module->name}}_{{$roleName}}">
                                        <input type="checkbox" name="role[{{$module->name}}][]" id="role_{{$module->name}}_{{$roleName}}" value="{{$roleName}}" {{isRole($roleArr, $module->name,$roleName) ? 'checked' : ''}} class="role-checkbox">
                                        {{$roleLabel}}
                                    </label>
                                </div>
                            @endforeach
                        @endif
                        @if($module->name == 'Staffs')
                        <div class="col-3">
                            <label for="role_{{$module->name}}_permission">
                                <input type="checkbox" name="role[{{$module->name}}][]" id="role_{{$module->name}}_permission" value="permission" {{isRole($roleArr, $module->name,'permission') ? 'checked' : ''}} class="role-checkbox">
                                Phân Quyền
                            </label>
                        </div>
                        @endif
                    </div>
                </td>
            </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    <button class="btn btn-primary">Phân Quyền</button>
</form>

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.role-checkbox').change(function() {
        let moduleName = $(this).attr('id').split('_')[1];
        if ($(this).is(':checked') && ['add', 'edit', 'delete', 'permission'].includes($(this).val())) {
            $('#role_' + moduleName + '_view').prop('checked', true);
        }
    });
});
</script>
@endsection
@endsection
