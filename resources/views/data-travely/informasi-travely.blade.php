@extends('layouts.app')

<main id="main" class="main">

<div class="pagetitle">
  <h1>Data Travely</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item active">Informasi Travely</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Display success or warning messages -->
                    @if (session('success'))
                        <div class="alert alert-primary" btn="close" aria-label="Close">
                            {{ session('success') }}
                        </div>
                    @elseif (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif

                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#verticalycentered">
                        Tambah Data
                    </button>
                    <div class="modal fade" id="verticalycentered" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Informasi Travely</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3" action="{{ route('itr.addTravel') }}" method="POST">
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
                                            <label for="jumlah_kursi" class="form-label">Kursi </label>
                                            <input type="text" class="form-control" id="jumlah_kursi" name="jumlah_kursi" placeholder="Masukkan Jumlah Kursi">
                                        </div>
                                        <div class="col-12">
                                            <label for="tanggal_keberangkatan" class="form-label">Tanggal Keberangkatan</label>
                                            <input type="date" class="form-control" id="tanggal_keberangkatan" name="tanggal_keberangkatan" placeholder="Masukkan Tanggal Keberangkatan">
                                        </div>
                                        <div class="col-12">
                                            <label for="jam_keberangkatan" class="form-label">Jam Keberangkatan</label>
                                            <input type="time" class="form-control" id="jam_keberangkatan" name="jam_keberangkatan" placeholder="Masukkan Jam Keberangkatan">
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

                    <!-- Table with stripped rows -->
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Keberangkatan</th>
                                <th>Tujuan</th>
                                <th>Kursi Tersedia</th>
                                <th>Tanggal Keberangkatan</th>
                                <th>Jam Keberangkatan</th>
                                <th>Pilihan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($travels as $travel)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $travel->keberangkatan }}</td>
                                <td>{{ $travel->tujuan }}</td>
                                <td>{{ $travel->jumlah_kursi }}</td>
                                <td>{{ $travel->tanggal_keberangkatan }}</td>
                                <td>{{ $travel->jam_keberangkatan }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-1">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editTravelModal{{ $travel->id }}">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <form action="{{ route('itr.deleteTravel', $travel->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger mt-3">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <!-- modal edit Informasi Travely -->
                                <div class="modal fade" id="editTravelModal{{ $travel->id }}" tabindex="-1" aria-labelledby="editTravelModal{{ $travel->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editTravelModal{{ $travel->id }}Label">Edit Informasi Travel</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="row g-3" action="{{ route('itr.updateTravel', ['id' => $travel->id])}}" method="POST">
                                                    @csrf
                                                    @method('PUT') <!-- Mengganti metode POST dengan PUT -->
                                                    <div class="col-12">
                                                        <label for="keberangkatan" class="form-label">Keberangkatan</label>
                                                        <select class="form-select" aria-label="Default select" name="keberangkatan" value="{{ $travel->keberangkatan }}">
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
                                                        <select class="form-select" aria-label="Default select" name="tujuan" value="{{ $travel->tujuan }}">
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
                                                        <label for="jumlah_kursi" class="form-label">Jumlah Kursi</label>
                                                        <input type="text" class="form-control" id="jumlah_kursi" name="jumlah_kursi" placeholder="Masukkan Jumlah Kursi" value="{{ $travel->jumlah_kursi }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="tanggal_keberangkatan" class="form-label">Tanggal Keberangkatan</label>
                                                        <input type="date" class="form-control" id="tanggal_keberangkatan" name="tanggal_keberangkatan" placeholder="Masukkan Tanggal Keberangkatan" value="{{ $travel->tanggal_keberangkatan }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="jam_keberangkatan" class="form-label">Jam Keberangkatan</label>
                                                        <input type="time" class="form-control" id="jam_keberangkatan" name="jam_keberangkatan" placeholder="Masukkan Jam Keberangkatan" value="{{ $travel->jam_keberangkatan }}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </form><!-- End General Form Elements --> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
