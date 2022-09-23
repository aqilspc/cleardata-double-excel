<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Shuchkin\SimpleXLSX;
use Excel;
use App\Exports\DataExport;
class SuratController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
       //helper
    public function uploadFile(Request $request,$oke)
    {
            $result ='';
            $file = $request->file($oke);
            $name = $file->getClientOriginalName();
            // $tmp_name = $file['tmp_name'];

            $extension = explode('.',$name);
            $extension = strtolower(end($extension));

            $key = rand();
            $tmp_file_name = "{$key}.{$extension}";
            $tmp_file_path = "admin/file/surat/";
            $file->move($tmp_file_path,$tmp_file_name);
            // if(move_uploaded_file($tmp_name, $tmp_file_path)){
            $result = $tmp_file_name;
            // }
            $arr =[];
            $arr[0] = 'admin/file/surat'.'/'.$result;
            $arr[1] = url('admin/file/surat').'/'.$result;
        return $arr;
    }

    public function index()
    {
        $data = DB::table('arsip_surat')
        ->get();
        return view('admin.DataKebijakan.index',compact('data'));
    }

    public function createPage()
    {
        return view('admin.DataKebijakan.create');
    }

    public function editPage($id)
    {
        $data = DB::table('arsip_surat')->where('id',$id)->first();
        return view('admin.DataKebijakan.edit',compact('data'));
    }


    public function detailPage($id)
    {
        $data = DB::table('arsip_surat')->where('id',$id)->first();
        return view('admin.DataKebijakan.detail',compact('data'));
    }

    public function clearDataDouble($file,$kolom)
    {
        $xlsx =SimpleXLSX::parse(public_path($file));
        $ff = $xlsx->rows();
        $arrResult = [];
            foreach ( $ff as $k => $r ) 
            {
                if ( $k === 0 ) {
                    $header_values = $r;
                    continue;
                }
                $rows[] = array_combine( $header_values, $r );
            }
            $mentah = $rows;
            $headerList = array_keys($mentah[0]); // is array
            if(!in_array($kolom, $headerList)){
                $arrResult[0] = 001;
                $arrResult[1] = implode(',', $headerList);
                return $arrResult;
            }
            $arrTmp = [];
            for ($i=0; $i < count($mentah); $i++)
            {
                $validateKolom = $mentah[$i][$kolom];
                array_push($arrTmp, $validateKolom);
            }

            //lihat double 
            $doubleResult = array_count_values($arrTmp);
            $doubleText = '<ul>';
            $countDouble = 0;
            foreach ($doubleResult as $dbk => $dbv) {
               if($dbv > 1){
                  $doubleText .= '<li>Data '.$kolom.' : '.$dbk.' : '.$dbv.'</li>';
                  $countDouble++;
               }
            }
            if($countDouble == 0){
                 $doubleText .= '<li>Data '.$kolom.' Clean Tidak Ada Yang Double</li>';
            }
            $doubleText.='</ul>';

            //filter double
            $filter = [];
            foreach ($mentah as $value)
            {
                $filter[$value[$kolom]] = $value;
            }
            $filterResult = array_values($filter);
            
            $doubleSave = $this->saveToPublic($filterResult,$headerList);

            $arrResult[0] = 002;
            $arrResult[1] = $doubleText;
            $arrResult[2] = $doubleSave;
            return $arrResult;
    }
    public function saveToPublic($data,$headerList)
    {
        $rand = rand();
        Excel::store(new DataExport($data,$headerList), 'data_result_'.$rand.'_.xlsx','real_public');
        $url = url('/').'/'.'data_result_'.$rand.'_.xlsx';
        return $url;
    }
    public function create(Request $request)
    {
        $file = $request->file('file');
        $ext = $file->getClientOriginalExtension();
        if($ext == 'xls' || $ext == 'xlsx'){
            $upload = $this->uploadFile($request,'file');
            $clear = $this->clearDataDouble($upload[0],$request->kolom);
            if($clear[0] == 001){
                return redirect()->back()->with('success','Data gagal kolom yang anda masukkan yakin '.$request->kolom.' tidak ada di dalam file , berikut list kolom di file anda '.$clear[1].' ');
            }
            $ins = DB::table('arsip_surat')->insertGetId([
                    'judul'=>$request->judul,
                    'kategori'=>$request->kategori,
                    'nomor'=>$request->nomor,
                    'kolom'=>$request->kolom,
                    'file'=>$upload[1],
                    'result_text'=>$clear[1],
                    'result'=>$clear[2],
                    'created_at'=>Carbon::now()->format('Y-m-d')
                ]);
            return redirect('admin/surat')->with('success','Data berhasil disimpan silhkan LIHAT hasil di button mata record data!');
        }else{
            return redirect()->back()->with('success','Data gagal di upload kaena bukan file excel');
        }
    }

    // public function update(Request $request,$id)
    // {
    //     if($request->file('file') != null)
    //     {
    //         $fixGambar = $this->uploadFile($request,'file');
    //     }else
    //     {
    //         $fixGambar = $request->old_file;
    //     }
    //     DB::table('arsip_surat')->where('id',$id)->update(
    //         [
    //             'judul'=>$request->judul,
    //             'kategori'=>$request->kategori,
    //             'nomor'=>$request->nomor,
    //             'file'=>$fixGambar,
    //             'created_at'=>Carbon::now()->format('Y-m-d')
    //         ]);
    //     return redirect('admin/surat')->with('success','Data berhasil diubah');
    // }


    public function delete($id)
    {
        DB::table('arsip_surat')->where('id',$id)->delete();
        return redirect('admin/surat')->with('success','Data berhasil dihapus');
    }

    public function download_pdf($id)
    {
        $data = DB::table('arsip_surat')->where('id',$id)->select('file','judul')->first();
        $headers = array('Content-Type: application/pdf');
        $fixname = explode('/', $data->file);
        $fixfile= end($fixname);
        $file = public_path().'/admin/file/surat/'.$fixfile;
        return response()->download($file, ''.$data->judul.'.pdf', $headers);              
        
    }

    public function about()
    {
        return view('admin.DataKebijakan.about');
    }
}
