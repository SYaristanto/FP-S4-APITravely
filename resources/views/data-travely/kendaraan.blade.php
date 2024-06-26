@extends('layouts.app')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Data Travely</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Kendaraan</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <!-- Vertically centered Modal -->
              <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                Tambah Data
              </button>
              <div class="modal fade" id="verticalycentered" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Kendaraan</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="row g-3" action="{{ route('kdr.addKendaraan') }}" method="POST">
                        @csrf
                        <div class="col-12">
                            <label for="armada" class="mt-2 form-label">Armada</label>
                            <select class="form-select" aria-label="Default select" name="armada">
                                <option selected disabled>Pilih Armada</option>
                                <option value="Toyota Hiace">Toyota Hiace</option>
                                <option value="Isuzu ELF">Isuzu ELF</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label for="plat_nomor" class="mt-2 form-label">Plat Nomor</label>
                            <input type="text" class="form-control" id="plat_nomor" name="plat_nomor" placeholder="Masukkan Plat Nomor">
                        </div>
                        <div class="col-12">
                            <label for="kapasitas" class="form-label">Kapasitas</label>
                            <input type="text" class="form-control" id="kapasitas" name="kapasitas" placeholder="Masukkan Kapasitas Kursi">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                      </form><!-- End General Form Elements --> 
                    </div>
                  </div>
                </div>
              </div><!-- End Vertically centered Modal-->
            </div>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Armada</th>
                    <th>Plat Nomor</th>
                    <th>Kapasitas</th>
                    <th>Pilihan</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($kendaraan as $kdr)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $kdr->armada }}</td>
                      <td>{{ $kdr->plat_nomor }}</td>
                      <td>{{ $kdr->kapasitas }}</td>
                      <td>
                        <div class="d-flex align-items-center gap-1">
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="">
                              <i class="bi bi-pencil-square"></i>
                          </button>
                          <form action="" method="POST" class="">
                              <button type="submit" class="btn btn-danger mt-3">
                                  <i class="bi bi-trash"></i>
                              </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

</main><!-- End #main -->

