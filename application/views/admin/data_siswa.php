
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Siswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Siswa</a></li>
              <li class="breadcrumb-item active">Data Siswa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#add_siswa"><i class="fa fa-plus"></i> Add Siswa</button>
                <!-- <h3 class="card-title">DataTable with default features</h3> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nama Siswa</th>
                    <th>Email</th>
                    <th>Foto Profil</th>
                    <th>Option</th>
                  </tr>
                  </thead>
                  <tbody> 
                    <?php

                    foreach ($user as $u) {
                    ?>
                    <tr>
                        <td><?php echo $u->nama ?></td>
                        <td><?php echo $u->email ?></td>
                        <td><img height="20px" src="<?= base_url() . 'assets/profile_picture/' . $u->image; ?>"></td>
                        <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#update_siswa"><i class="fa fa-edit"></i> Update</button>
                        <a href="<?php echo ('delete_siswa/' . $u->id); ?>" onclick="javascript: return confirm('yakin ingin hapus?')" class="btn btn-danger remove" ><i class="fa fa-trash"></i> Delete</a>                        
                        <a href="<?php echo site_url('admin/update_siswa/' . $u->id); ?>" class="btn btn-info"><i class="fa fa-edit"></i> Update </a>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Modal Add -->
<div class="modal fade" id="add_siswa" tabindex="-1" role="dialog" aria-labelledby="add_siswa" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_siswa">Add Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url() ?>admin/add_siswa" enctype="multipart/form-data" method="post">
          <div class="form-group">
            <label for="" class="col-form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama">
          </div>
          <div class="form-group">
            <label for="" class="col-form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>
          <div class="form-group">
            <label for="" class="col-form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
          </div>
          <div class="form-group">
            <label for="" class="col-form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" id="retype_password" name="retype_password">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal Edit -->
<div class="modal fade" id="update_siswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Siswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url() ?>admin/user_edit" enctype="multipart/form-data" method="post">
          <div class="form-group">
            <input type="hidden" name="id" value="<?= $u->id ?>">
            <input type="hidden" name="password" value="<?= $u->password ?>">
            <input type="hidden" name="is_active" value="<?= $u->is_active ?>">
            <input type="hidden" name="date_created" value="<?= $u->date_created ?>">
            <label for="" class="col-form-label">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $u->nama ?>">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>
