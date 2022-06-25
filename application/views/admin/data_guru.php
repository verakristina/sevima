
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Guru</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Guru</a></li>
              <li class="breadcrumb-item active">Data Guru</li>
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
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#add_guru"><i class="fa fa-plus"></i> Add Guru</button>
                <!-- <h3 class="card-title">DataTable with default features</h3> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>NIP</th>
                    <th>Nama Guru</th>
                    <th>Email</th>
                    <th>Nama Mapel</th>
                    <th>Option</th>
                  </tr>
                  </thead>
                  <tbody> 
                    <?php

                    foreach ($user as $u) {
                    ?>
                    <tr>
                        <td><?php echo $u->nip ?></td>
                        <td><?php echo $u->nama_guru ?></td>
                        <td><?php echo $u->email ?></td>
                        <td><?php echo $u->nama_mapel ?></td>
                        <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#update_guru"><i class="fa fa-edit"></i> Update</button>
                        <a href="<?php echo ('delete_guru/' . $u->nip); ?>" onclick="javascript: return confirm('yakin ingin hapus?')" class="btn btn-danger remove" ><i class="fa fa-trash"></i> Delete</a>                        
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
<div class="modal fade" id="add_guru" tabindex="-1" role="dialog" aria-labelledby="add_guru" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_guru">Add Guru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url() ?>admin/add_guru" enctype="multipart/form-data" method="post">
        <?php
            $random_code = rand(100, 200);

            $chdt = "";
            if($random_code >= 100){
            $chdt = "19".$random_code;
            }else{
            $chdt = "".$random_code;
            }
        ?>
          <div class="form-group">
            <label for="" class="col-form-label">Nomor Induk Pegawai</label>
            <input type="text" class="form-control" id="nip" name="nip"value="<?php echo $chdt; ?>"readonly>
          </div>
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
            <input type="password" class="form-control" id="password2" name="password2">
          </div>
          <div class="form-group">
            <label for="" class="col-form-label">Mapel Yang Di ajar</label>
            <select class="form-control selectric" name="mapel">
                <option>Matematika</option>
                <option>IPA</option>
                <option>Bahasa Inggris</option>
                <option>Bahasa Indonesia</option>
                <option>Pendidikan Agama Islam</option>
            </select>
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
<div class="modal fade" id="update_guru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Guru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url() ?>admin/guru_edit" enctype="multipart/form-data" method="post">
          <div class="form-group">
            <label for="" class="col-form-label">Nomor Induk Pegawai</label>
            <input type="text" class="form-control" id="nip" name="nip"value="<?php echo $chdt; ?>"readonly>
          </div>
          <div class="form-group">
            <label for="" class="col-form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama"value="<?php echo $u->nama_guru; ?>">
          </div>
          <div class="form-group">
            <label for="" class="col-form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email"value="<?php echo $u->email; ?>">
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
