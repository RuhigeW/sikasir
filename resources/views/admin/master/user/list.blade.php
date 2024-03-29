@extends('layout.layout')
@section('content')
    
@endsection
<div class="content-body">

    <div class="row page-titles mx-0">
        <div class="col p-md-0">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">{{$title}}</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$title}}</a></li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{$title}}</h4>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCreate">
                            <i class="fa fa-plus"></i>
                            Tambah Data
                        </button>
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
                                            <a href="#modalEdit"{{$row->id}} data-toggle="modal" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i>Edit</a>
                                            <a href="#modalHapus"{{$row->id}} data-toggle="modal" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i>Delete</a>
                                        </td>
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
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="from-control" name="name" placeholder="nama lengkap" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="from-control" name="email" placeholder="email" required>
                    </div>
                    <div class="form-group">
                        <label>password</label>
                        <input type="text" class="from-control" name="password" placeholder="password" required>
                    </div>
                </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role" required>
                            <option value="" hidden>-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach ($data_user as $row)
<div class="modal fade" id="modalEdit{{ $d->$id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data User</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                </button>
            </div>
            <form method="POST" action="/user/update/{{ $d->id }}">
                @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" value="{{ $d->nama_lengkap }}" class="from-control" name="name" placeholder="nama lengkap" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" value="{{ $d->email }}" class="from-control" name="email" placeholder="email" required>
                        </div>
                        <div class="form-group">
                            <label>password</label>
                            <input type="text" class="from-control" name="password" placeholder="password" required>
                        </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="role" required>
                            <option <?php if($d['role']=="admin") echo "selected"; ?> value="admin">Admin</option>
                            <option <?php if($d['role']=="kasir") echo "selected"; ?> value="kasir">Kasir</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@foreach ($data_user as $row)
<div class="modal fade" id="modalHapus{{ $d->$id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Data User</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <form method="GET" action="/user/update/{{ $d->id }}">
            @csrf
                <div class="modal-body">
                        <div class="form-group">
                            <h5>Apakah Anda Ingin Menghappus Data ini?</h5>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>Close</button>
                        <button type="submit" class="btn btn-danger"><i class="fa fa-save"></i>Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection