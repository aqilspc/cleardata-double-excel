@extends('admin.layout.master')
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                DATA TENTANG DEVELOPER
                
            </h2>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>DATA DIRI
                        </h2>
                    </div>
                    <div class="body">

                         <div class="row clearfix">
                                <div class="col-md-3">
                              <div class="image">
                                <a style="cursor: pointer;" data-toggle="modal" data-target="#gantiFoto">
                                    <img src="{{url('images/izza.jpg')}}" width="100px" height="100%" alt="User" />
                                </a>
                            </div>
                         </div>
                         <div class="col-md-4">
                                <p>NIM : 1931710017</p>
                                <p>NAMA : Corneza Nabetha Nuril Izza HadneL</p>
                                <p>KELAS : MI 3F</p>
                                <p>ABSEN : 02</p>
                         </div>
                     </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
    </div>
</section>
<script type="text/javascript">
@if (Session::has('messages')) 
    alert("{{ Session::get('messages') }}");
@endif
</script>
@endsection

