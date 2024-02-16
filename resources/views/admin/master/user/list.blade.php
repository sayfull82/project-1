@extends('layout.layout')
@section('content')

<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{ $title }}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{ $title }}</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-item-center">
                            <h4 class="card-title">{{ $title }}</h4>
                            <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalCreate">
                                <i class="fa fa-plus"></i>
                                Tambah Data
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $no = 1;
                                    @endphp
                                    @foreach ($data_user as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->role }}</td>
                                        <td>
                                            <a href="#modalEdit{{ $row->id }}" data data-toggle="modal" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                            <a href="#modalEdit{{ $row->id }}" data data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Data User</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form method="POST" action="/user/store">
                @csrf
                <div class="modal-body">
                    <div class="form-grup">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" placeholder="Nama Lengkap ..." required>
                    </div>
                    <div class="form-grup">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="email ..." required>
                    </div>
                    <div class="form-grup">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="password ..." required>
                    </div>
                    <div class="form-grup">
                        <label>Role</label>
                        <select class="form-control" name="role" required>
                            <option value="" hidden>-- Pilih Role --</option>
                            <option value="admin">admin</option>
                            <option value="kasir">kasir</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($data_user as $d)
<div class="modal fade" id="modalEdit{{ $d->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data User</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form method="POST" action="/user/update/{{$d->id}}">
                @csrf
                <div class="modal-body">
                    <div class="form-grup">
                        <label>Nama Lengkap</label>
                        <input type="text" value="{{ $d->name }}" class="form-control" name="name" placeholder="Nama Lengkap ..." required>
                    </div>
                    <div class="form-grup">
                        <label>Email</label>
                        <input type="email" value="{{ $d->email }}" class="form-control" name="email" placeholder="email ..." required>
                    </div>
                    <div class="form-grup">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="password ..." required>
                    </div>
                    <div class="form-grup">
                        <label>Role</label>
                        <select class="form-control" name="role" required>
                            <option <?php if ($d['role'] == "admin") echo "selected"; ?> value="admin">admin</option>
                            <option <?php if ($d['role'] == "kasir") echo "selected"; ?> value="kasir">kasir</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@foreach ($data_user as $d)
<div class="modal fade" id="modalHapus{{ $c->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Data User</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form method="GET" action="/user/destroy/{{$d->id}}">
                @csrf
                <div class="modal-body">
                    <div class="form-grup">
                        <H5>Apakah Anda Ingin Menghapus Data Ini ?</H5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i> Close</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>Hapus</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@endsection