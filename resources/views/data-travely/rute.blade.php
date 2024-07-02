@extends('layouts.app')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Data Travely</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Rute</li>
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
                    <h5 class="modal-title">Rute</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="row g-3" action="{{ route('rts.addRute') }}" method="POST">
                      @csrf
                      <div class="col-12">
                        <label for="keberangkatan" class="form-label">Keberangkatan</label>
                        <select class="form-select" aria-label="Default select" name="keberangkatan">
                            <option selected disabled>Pilih Lokasi Keberangkatan</option>
                            <option value="Jakarta Barat">Jakarta Barat</option>
                            <option value="Jakarta Selatan">Jakarta Selatan</option>
                            <option value="Jakarta Pusat">Jakarta Pusat</option>
                            <option value="Jakarta Timur">Jakarta Timur</option>
                            <option value="Jakarta Utara">Jakarta Utara</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Bekasi">Bekasi</option>
                            <option value="Bogor">Bogor</option>
                            <option value="Cirebon">Cirebon</option>
                            <option value="Depok">Depok</option>
                        </select>
                      </div>
                      <div class="col-12">
                        <label for="tujuan" class="form-label">Tujuan</label>
                        <select class="form-select" aria-label="Default select" name="tujuan">
                            <option selected disabled>Pilih Lokasi Tujuan</option>
                            <option value="Jakarta Barat">Jakarta Barat</option>
                            <option value="Jakarta Selatan">Jakarta Selatan</option>
                            <option value="Jakarta Pusat">Jakarta Pusat</option>
                            <option value="Jakarta Timur">Jakarta Timur</option>
                            <option value="Jakarta Utara">Jakarta Utara</option>
                            <option value="Bandung">Bandung</option>
                            <option value="Bekasi">Bekasi</option>
                            <option value="Bogor">Bogor</option>
                            <option value="Cirebon">Cirebon</option>
                            <option value="Depok">Depok</option>
                        </select>
                      </div>
                      <div class="col-12">
                          <label for="harga_per_orang" class="form-label">Harga per Orang</label>
                          <input type="text" class="form-control" id="harga_per_orang" name="harga_per_orang" placeholder="Masukkan Harga Per Orang">
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
                  <th>Keberangkatan</th>
                  <th>Tujuan</th>
                  <th>Harga per Orang</th>
                  <th>Pilihan</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($rutes as $rts)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $rts->keberangkatan }}</td>
                      <td>{{ $rts->tujuan }}</td>
                      <td>{{ $rts->harga_per_orang }}</td>
                      <td>
                        <div class="d-flex align-items-center gap-1 ">
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editRuteModal{{ $rts->id }}">
                              <i class="bi bi-pencil-square"></i>
                          </button>
                          <form action="{{ route('rts.deleteRute', $rts->id) }}" method="POST" class="">
                            @csrf
                            @method('DELETE')
                              <button type="submit" class="btn btn-danger mt-3">
                                  <i class="bi bi-trash"></i>
                              </button>
                          </form>
                        </div>
                      </td>
                      <!-- modal edit rute-->
                      <div class="modal fade" id="editRuteModal{{ $rts->id }}" tabindex="-1" aria-labelledby="editRuteModal{{ $rts->id }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editRuteModal{{ $rts->id }}Label">Edit Data Rute</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form class="row g-3" action="{{ route('rts.updateRute', ['id' => $rts->id]) }}" method="POST">
                                  @csrf
                                  @method('PUT')
                                  <div class="col-12">
                                      <label for="keberangkatan" class="form-label">Keberangkatan</label>
                                      <select class="form-select" aria-label="Default select" name="keberangkatan">
                                        @foreach ($rutes as $rts)
                                          <option value="{{ $rts->id }}">{{ $rts->keberangkatan }}</option>
                                          <option value="Jakarta Barat">Jakarta Barat</option>
                                          <option value="Jakarta Selatan">Jakarta Selatan</option>
                                          <option value="Jakarta Pusat">Jakarta Pusat</option>
                                          <option value="Jakarta Timur">Jakarta Timur</option>
                                          <option value="Jakarta Utara">Jakarta Utara</option>
                                          <option value="Bandung">Bandung</option>
                                          <option value="Bekasi">Bekasi</option>
                                          <option value="Bogor">Bogor</option>
                                          <option value="Cirebon">Cirebon</option>
                                          <option value="Depok">Depok</option>
                                        @endforeach
                                      </select>
                                      <!-- <input type="text" class="form-control" id="keberangkatan" name="keberangkatan" value="{{ $rts->keberangkatan }}"> -->
                                    </div>
                                    <div class="col-12">
                                      <label for="tujuan" class="form-label">Tujuan</label>
                                      <select class="form-select" aria-label="Default select" name="tujuan">
                                        @foreach ($rutes as $rts)
                                          <option value="{{ $rts->id }}">{{ $rts->tujuan }}</option>
                                          <option value="Jakarta Barat">Jakarta Barat</option>
                                          <option value="Jakarta Selatan">Jakarta Selatan</option>
                                          <option value="Jakarta Pusat">Jakarta Pusat</option>
                                          <option value="Jakarta Timur">Jakarta Timur</option>
                                          <option value="Jakarta Utara">Jakarta Utara</option>
                                          <option value="Bandung">Bandung</option>
                                          <option value="Bekasi">Bekasi</option>
                                          <option value="Bogor">Bogor</option>
                                          <option value="Cirebon">Cirebon</option>
                                          <option value="Depok">Depok</option>
                                        @endforeach
                                      </select>
                                  </div>
                                  <div class="col-12">
                                      <label for="harga_per_orang" class="form-label">Harga Per Orang</label>
                                      <input type="text" class="form-control" id="harga_per_orang" name="harga_per_orang" value="{{ $rts->harga_per_orang }}">
                                  </div>
                                  <div class="modal-footer">
                                      <button type="submit" class="btn btn-primary">Save changes</button>
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
    </div>
  </div>
</section>

</main><!-- End #main -->

