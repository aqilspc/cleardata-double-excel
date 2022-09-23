@extends('admin.layout.master')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>DATA DETAIL</h2>
        </div>

        <!-- Vertical Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Lihat Detail
                        </h2>
                        
                    </div>
                    <div class="body">
                        <p>Nomor : {{$data->nomor}}</p>
                        <p>Kategori : {{$data->kategori}}</p>
                        <p>Judul : {{$data->judul}}</p>
                        <p>Waktu : {{$data->created_at}}</p>
                     <div class="row clearfix">
                        <div class="col-md-4">
                         <a href="{{url('admin/surat')}}"><button type="button" class="btn btn-primary  
                            center-block" >KEMBALI</button>
                         </a>
                    </div>
                 <div class="col-md-4">
                     <a href="{{$data->result}}" target="_blank"><button type="button" class="btn btn-primary center-block" >UNDUH HASIL</button></a>
                </div>
                <div class="col-md-4">
                     <p align="center">HASIL PENGECEKAN DOUBLE</p>
                     <?php echo $data->result_text?>
                </div>
                </div>
            </div>
        </div>
        <!-- #END# Vertical Layout -->
        
    </div>
</section>
@endsection