<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\mahasiswa;
use App\pengunjung;
use App\Charts\Echarts;
use Validator;

class buku_tamuController extends Controller
{

    public function index()
    {
        $tujuans = pengunjung::select('keperluan')->distinct()->pluck('keperluan','keperluan');
        $pengunjung = DB::SELECT(DB::RAW("select DATE_FORMAT(created_at, '%d/%m/%Y') as tanggal, count(id) as total from pengunjung GROUP BY tanggal ORDER BY DATE_FORMAT(created_at, '%Y%m%d') asc"));
        $keperluan = DB::SELECT(DB::RAW("select keperluan, count(id) as total from pengunjung GROUP BY keperluan"));
        $keaktivan = DB::SELECT(DB::RAW("select users.nama as nama, count(pengunjung.id) as total from pengunjung JOIN users on pengunjung.nim = users.nim GROUP BY nama ORDER BY total desc limit 5"));

        $chart_pengunjung = new Echarts;
        $tanggal_pengunjung = ["00/00/0000"];
        $total_pengunjung = [0];
        foreach ($pengunjung as $kunjung) {
          array_push($tanggal_pengunjung, $kunjung->tanggal);
          array_push($total_pengunjung, $kunjung->total);
        }

        $chart_pengunjung->labels($tanggal_pengunjung);
        $chart_pengunjung->dataset('Total Pengunjung', 'line', $total_pengunjung);
        $chart_pengunjung->options([
          'tooltip'  => [
            'trigger' => 'axis',
            'axisPointer' => [
              'type' => 'cross',
              'label' => [
                  'backgroundColor' => '#6a7985'
              ]
            ],
          ],
          'toolbox' => [
              'feature' => [
                  'saveAsImage' => []
              ]
          ],
          'xAxis' => [
              'type' => 'category',
              'boundaryGap' => false
          ],
          'yAxis' => [
              'type' => 'value',
              'boundaryGap' => [0, '100%']
          ],
          'dataZoom' => [
            [
              'type' => 'inside',
              'start' => 0,
              'end' => 100
            ], [
                'start' => 0,
                'end' => 100,
                'handleIcon' => 'M10.7,11.9v-1.3H9.3v1.3c-4.9,0.3-8.8,4.4-8.8,9.4c0,5,3.9,9.1,8.8,9.4v1.3h1.3v-1.3c4.9-0.3,8.8-4.4,8.8-9.4C19.5,16.3,15.6,12.2,10.7,11.9z M13.3,24.4H6.7V23h6.6V24.4z M13.3,19.6H6.7v-1.4h6.6V19.6z',
                'handleSize' => '80%',
                'handleStyle' => [
                    'color' => '#fff',
                    'shadowBlur' => 3,
                    'shadowColor' => 'rgba(0, 0, 0, 0.6)',
                    'shadowOffsetX' => 2,
                    'shadowOffsetY' => 2
                ]
            ]
          ],
        ]);
        $chart_pengunjung->datasets[0]->options([
          'areaStyle' => ['normal' => []],
          'label' => [
                'normal' => [
                    'show' => true,
                    'position' => 'top'
                ],
            ],
            'smooth' => true,
            // 'symbol' => 'none',
            'sampling' => 'average',
        ]);
        // dd($chart_pengunjung);

        $chart_tujuan = new Echarts;
        $label_keperluan = [];
        $total_keperluan = [];
        foreach ($keperluan as $perlu) {
          array_push($label_keperluan, $perlu->keperluan);
          array_push($total_keperluan, $perlu->total);
        }
        $chart_tujuan->labels($label_keperluan);
        $chart_tujuan->dataset('Keperluan Pengunjung', 'pie', $total_keperluan);
        $chart_tujuan->options([
          'tooltip' => [
              'trigger' => 'item',
              'formatter' => "{a} <br/>{b} : {c} ({d}%)"
          ],
          'legend' => [
            'x' => 'center',
            'y' => 'bottom',
          ],
          "xAxis" => [
            "show" => false
          ],
          "yAxis" => [
            "show" => false
          ],
          'calculable' => false,
        ]);
        $chart_tujuan->datasets[0]->options([
            'type' => 'pie',
            'radius' => '55%',
            'center' => ['50%', '50%'],
            'roseType' => 'area',
            'selectedMode' => 'single',
            'label' => [
                'formatter' => "{b} : {c} ({d}%)"
            ],
        ]);
        // dd($chart_tujuan);

        $chart_pengunjung_terbiasa = new Echarts;
        $label_keaktivan = [];
        $total_keaktivan = [];
        foreach ($keaktivan as $aktiv) {
          array_push($label_keaktivan, $aktiv->nama);
          array_push($total_keaktivan, $aktiv->total);
        }
        $chart_pengunjung_terbiasa->labels($label_keaktivan);
        $chart_pengunjung_terbiasa->dataset('Top Pengunjung', 'bar', $total_keaktivan)->color('#1d6d24');
        $chart_pengunjung_terbiasa->options([
            'tooltip'  => [
                'trigger' => 'axis',
            ],
            'xAxis' => [
                'type' => 'category',
            ],
            'yAxis' => [
                'type' => 'value',
                'boundaryGap' => [0, '100%']
            ],
            "legend" => [
              "show" => false
            ]
        ]);

        // dd($chart_pengunjung_terbiasa);



        return view('index',compact('tujuans','chart_pengunjung','chart_tujuan','chart_pengunjung_terbiasa'));
    }

    public function dataajax(Request $request)
    {
        $pengunjungs = pengunjung::select('users.nama as nama', 'pengunjung.keperluan as keperluan','pengunjung.created_at')->join('users','pengunjung.nim','=','users.nim')->WhereRaw("DATE_FORMAT(pengunjung.created_at,'%Y%m%d') =DATE_FORMAT(now(),'%Y%m%d')")->get();

        if($request->data==1){
          $pengunjungs = pengunjung::select('users.nama as nama', 'pengunjung.keperluan as keperluan','pengunjung.created_at')->join('users','pengunjung.nim','=','users.nim')->WhereRaw("DATE_FORMAT(pengunjung.created_at,'%Y%m%d') =DATE_FORMAT(now(),'%Y%m%d')")->get();
        }else if($request->data==30){
          $pengunjungs = pengunjung::select('users.nama as nama', 'pengunjung.keperluan as keperluan','pengunjung.created_at')->join('users','pengunjung.nim','=','users.nim')->WhereRaw('`pengunjung`.`created_at` between DATE_SUB(now(), INTERVAL 30 day) and now()')->get();
        }else if($request->data==365){
          $pengunjungs = pengunjung::select('users.nama as nama', 'pengunjung.keperluan as keperluan','pengunjung.created_at')->join('users','pengunjung.nim','=','users.nim')->WhereRaw('`pengunjung`.`created_at` between DATE_SUB(now(), INTERVAL 365 day) and now()')->get();
        }
        return '{"data" : '.json_encode($pengunjungs).'}';
    }

    public function isi(Request $request)
    {
        if($request->lainnya){
          $validation = Validator::make($request->all(), [
              'nim' => 'required',
              'lainnya' => 'required'
          ]);
        }else{
          $validation = Validator::make($request->all(), [
            'nim' => 'required',
            'keperluan' => 'required'
          ]);
        }

        $error_array = array();
        $success_output = '';
        if ($validation->fails())
        {
            foreach($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
            return ['eror'=>$error_array,'pesan'=>'eror'];
        }




        try {
          $pengunjung = new pengunjung;
          $pengunjung->nim = $request->nim;
          $pengunjung->keperluan = $request->keperluan;
          if($request->lainnya){
            if($request->lainnya=='Lainnya' || $request->lainnya=='lainnya'){
              return ['eror'=>['Tidak Boleh Memasukan Lainnya'],'pesan'=>'eror'];
            }
            $pengunjung->keperluan = $request->lainnya;
          }
          $pengunjung->save();
          return ['success'=>['Selamat Datang '.$pengunjung->mahasiswa->nama],'pesan'=>'success'];
        } catch (\Exception $e) {
          return ['eror'=>[$e->getMessage(),'Terjadi Eror Saat Memasukan Data','Masukan Data NIM Dengan Benar'],'pesan'=>'eror'];
        }
    }

    public function dataset(Request $request)
    {

        $data = new Echarts;

        if($request->data==1){
          $pengunjung = DB::SELECT(DB::RAW("select DATE_FORMAT(created_at, '%d/%m/%Y') as tanggal, count(id) as total from pengunjung GROUP BY tanggal"));
        }elseif($request->data==2){

        }elseif($request->data==3){

        }


        return $data->api();
    }

    public function store(Request $request)
    {
        if($request->lainnya){
          $request->validate([
              'nim' => 'required',
              'lainnya' => 'required'
          ]);
        }else{
          $request->validate([
            'nim' => 'required',
            'keperluan' => 'required'
          ]);
        }

        try {
          $pengunjung = new pengunjung;
          $pengunjung->nim = $request->nim;
          $pengunjung->keperluan = $request->keperluan;
          if($request->lainnya){
            if($request->lainnya=='Lainnya' || $request->lainnya=='lainnya'){
              return ['eror'=>['Tidak Boleh Memasukan Lainnya'],'pesan'=>'eror'];
            }
            $pengunjung->keperluan = $request->lainnya;
          }
          $pengunjung->save();
          toast()->success('Selamat Datang'.$pengunjung->mahasiswa->nama, 'Berhasil');
        } catch (\Exception $e) {
          toast()->error($e->getMessage(), 'Error');
        }

        return redirect('/#buku_tamu');

    }
}
