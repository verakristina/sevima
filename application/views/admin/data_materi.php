
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Materi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Materi</a></li>
              <li class="breadcrumb-item active">Data Materi</li>
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
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#add_materi"><i class="fa fa-plus"></i> Add Materi</button>
                <!-- <h3 class="card-title">DataTable with default features</h3> -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama Guru</th>
                    <th>Nama Mapel</th>
                    <th>Deskripsi</th>
                    <th>Option</th>
                  </tr>
                  </thead>
                  <tbody> 
                    <?php

                    foreach ($user as $u) {
                    ?>
                    <tr>
                        <td><?php echo $u->id ?></td>
                        <td><?php echo $u->nama_guru ?></td>
                        <td><?php echo $u->nama_mapel ?></td>
                        <td><?= substr($u->deskripsi, 0, 30); ?>.&nbsp;.&nbsp;.&nbsp;.&nbsp;.&nbsp;.&nbsp;.</td>
                        <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#update_siswa"><i class="fa fa-edit"></i> Update</button>
                        <a href="<?php echo ('delete_siswa/' . $u->id); ?>" onclick="javascript: return confirm('yakin ingin hapus?')" class="btn btn-danger remove" ><i class="fa fa-trash"></i> Delete</a>                        
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
<div class="modal fade" id="add_materi" tabindex="-1" role="dialog" aria-labelledby="add_materi" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_materi">Add Materi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url() ?>admin/add_materi" enctype="multipart/form-data" method="post">
          <div class="form-group">
            <label for="" class="col-form-label">Nama Lengkap</label>
            <input autocomplete="off" required type="text" list="nama_guru" onkeyup="autofill()" id="namaguru" name="nama_guru" class="form-control">
            <datalist id=nama_guru>
                <?php
                include "koneksi.php";
                $qry = mysqli_query($koneksi, "SELECT nama_guru From guru");
                while ($t = mysqli_fetch_array($qry)) {
                    echo "<option value='$t[nama_guru]'>";
                }
                ?>
            </datalist>
          </div>
          <div class="form-group">
            <label for="" class="col-form-label">Nama Mata Pelajaran</label>
            <input type="text" class="form-control" name="nama_mapel" id="nama_mapel" required placeholder="Pilih nama guru yang valid agar nama mapel muncul" readonly>
          </div>
          <div class="form-group">
            <label for="" class="col-form-label">Upload Video Pembelajaran</label>
            <input  type="file" name="video"  class="form-control" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
          </div>
          <div class="form-group">
            <label for="" class="col-form-label">Kelas</label>
            <select required id="inputState" name="kelas" class="form-control">
                <option selected>Pilih disini</option>
                <option value="X">X IPA</option>
                <option value="X">X IPS</option>
                <option value="X">X AGAMA</option>
                <option value="XI">XI IPA</option>
                <option value="XI">XI IPS</option>
                <option value="XI">XI AGAMA</option>
                <option value="XII">XII IPA</option>
                <option value="XII">XII IPS</option>
                <option value="XII">XII AGAMA</option>
                <!-- <option value="X">X ( Kelas Sepuluh )</option>
                <option value="XI">XI ( Kelas Sebelas )</option>
                <option value="XII">XII ( Kelas Dua Belas )</option> -->
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
        <form action="<?php echo base_url() ?>admin/user_edit/<?php echo $u->id ?>" enctype="multipart/form-data" method="post">
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
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>
            function autofill() {
                var nama_guru = $("#namaguru").val();
                $.ajax({
                    url: '../autofill.php',
                    data: "nama_guru=" + nama_guru,
                }).done(function(data) {
                    var json = data,
                        obj = JSON.parse(json);
                    $('#nama_mapel').val(obj.nama_mapel);
                });
            }
        </script>
        <script>
            $('.custom-file-input').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });
        </script>
        