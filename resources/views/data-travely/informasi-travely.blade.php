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
                                            <label for="kendaraan_id" class="form-label">Armada</label>
                                            <select class="form-select" aria-label="Default select" name="kendaraan_id" required>
                                                <option selected disabled>Pilih Armada</option>
                                                @foreach ($kendaraan as $kdr)
                                                    <option value="{{ $kdr->id }}">{{ $kdr->armada }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="rute_id" class="form-label">Keberangkatan</label>
                                            <select class="form-select" aria-label="Default select" name="rute_id">
                                                <option selected disabled>Pilih Keberangkatan</option>
                                                @foreach ($rutes as $rts)
                                                    <option value="{{ $rts->id }}">{{ $rts->keberangkatan }} - {{ $rts->tujuan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- <div class="col-12">
                                            <label for="rute_id" class="form-label">Tujuan</label>
                                            <select class="form-select" aria-label="Default select" name="rute_id">
                                                <option selected disabled>Pilih Tujuan</option>
                                                @foreach ($rutes as $rts)
                                                    <option value="{{ $rts->id }}">{{ $rts->tujuan }}</option>
                                                @endforeach
                                            </select>
                                        </div> -->
                                        <div class="col-12">
                                            <label for="kursi_tersedia" class="form-label">Kursi Tersedia</label>
                                            <input type="text" class="form-control" id="kursi_tersedia" name="kursi_tersedia" placeholder="Masukkan Jumlah Kursi">
                                        </div>
                                        <div class="col-12">
                                            <label for="tanggal_keberangkatan" class="form-label">Tanggal Keberangkatan</label>
                                            <input type="date" class="form-control" id="tanggal_keberangkatan" name="tanggal_keberangkatan" placeholder="Masukkan Tanggal Keberangkatan">
                                        </div>
                                        <!-- <div class="col-12">
                                            <label for="jam_keberangkatan" class="form-label">Kendaraan</label>
                                            <input type="text" class="form-control" id="jam_keberangkatan" name="jam_keberangkatan" placeholder="Masukkan Jam Keberangkatan">
                                        </div> -->
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
                                <th>Armada</th>
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
                                <td>{{ $travel->kendaraan->armada }}</td>
                                <td>{{ $travel->rute->keberangkatan }}</td>
                                <td>{{ $travel->rute->tujuan }}</td>
                                <td>{{ $travel->kursi_tersedia }}</td>
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
                                                <form class="row g-3" action="{{ route('itr.updateTravel', ['id' => $travel->id]) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="col-12">
                                                        <label for="kendaraan_id" class="form-label">Armada</label>
                                                        <select class="form-select" aria-label="Default select" name="kendaraan_id" value="{{ $travel->armada }}">
                                                            @foreach ($kendaraan as $kdr)
                                                                <option value="{{ $kdr->id }}">{{ $kdr->armada }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="rute_id" class="form-label">Keberangkatan</label>
                                                        <select class="form-select" aria-label="Default select" name="rute_id" value="{{ $travel->rute_id }}">
                                                            @foreach ($rutes as $rts)
                                                                <option value="{{ $rts->id }}">{{ $rts->keberangkatan }} - {{ $rts->tujuan }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="kursi_tersedia" class="form-label">Kursi Tersedia</label>
                                                        <input type="text" class="form-control" id="kursi_tersedia" name="kursi_tersedia" value="{{ $travel->kursi_tersedia }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="tanggal_keberangkatan" class="form-label">Tanggal Keberangkatan</label>
                                                        <input type="date" class="form-control" id="tanggal_keberangkatan" name="tanggal_keberangkatan" value="{{ $travel->tanggal_keberangkatan }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label for="jam_keberangkatan" class="form-label">Jam Keberangkatan</label>
                                                        <input type="time" class="form-control" id="jam_keberangkatan" name="jam_keberangkatan" value="{{ $travel->jam_keberangkatan }}">
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
                    <!-- End Table with stripped rows -->
                </div>
            </div>
        </div>
    </div>
</section>

</main><!-- End #main -->
