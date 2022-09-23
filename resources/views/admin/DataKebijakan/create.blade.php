@extends('admin.layout.master')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DATA ARSIP SURAT</h2>
        </div>
        @if($message=Session::get('success'))
            <div class="alert bg-teal" role="alert">          
                <p align="center" style="color: white;">  <em class="fa fa-lg fa-close">&nbsp;</em>     
                    {{$message}}
                </p>
            </div>
        @endif
        <!-- Vertical Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Tambah Arsip Surat
                        </h2>
                        
                    </div>
                    <div class="body">
                        <form enctype="multipart/form-data" method="POST" action="{{url('admin/surat/create')}}">
                            @csrf
                            <label for="nama_kebijakan">NOMOR DATA</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="nama_kegiatan" class="form-control" placeholder="Nomor" name="nomor" required value="{{rand()}}">
                                </div>
                            </div>
                            <label for="nama_kebijakan">KATEGORI </label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="kategori" class="form-control" placeholder="kategori" name="kategori" required>
                                </div>
                            </div>
                            <label for="nama_kebijakan">JUDUL </label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="nama_kegiatan" class="form-control" placeholder="Judul" name="judul" required>
                                </div>
                            </div>
                            <label for="file_kebijakan">FILE</label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="file" name="file" id="nis" class="form-control" placeholder="file kebijakan" required  accept=".xlsx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                </div>
                            </div>
                            <label for="nama_kebijakan">KOLOM YANG DI VALIDASI </label>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="kolom" class="form-control" 
                                    placeholder="Masukkan kolom yang ingin di validasi contoh : NIK , NB: MOHON PERHATIKAN BESAR KECIL NYA NAMA KOLOM!" name="kolom" required>
                                </div>
                            </div>
                              <div class="row clearfix">
                                <div class="col-md-1">
                              <a href="{{url('admin/surat')}}"><button type="button" class="btn btn-primary center-block" >KEMBALI</button></a>
                         </div>
                         <div class="col-md-2" >
                             <button type="submit" class="btn btn-success center-block" >CLEAR DATA DOUBLE SEKARANG</button>
                         </div>
                     </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Vertical Layout -->
        
    </div>
</section>
@endsection