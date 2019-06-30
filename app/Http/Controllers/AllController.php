<?php

namespace App\Http\Controllers;

use App\User;
use App\Nilai;
use App\Matakuliah;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AllController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function login(Request $req)
    {
        $cekUser = User::where('username', $req->username)->first();
        if(!empty($cekUser)) {
            if(Hash::check($req->password, $cekUser->password)) {
                return response()->json($cekUser);
            } else {
                return response()->json("Wrong Password");
            }
        } else {
            return response()->json("No User");
        }
    }

    public function inputNilai(Request $req)
    {
        $data = array(
            'nim' => $req->nim,
            'matkul' => $req->matkul,
            'nilai' => $req->nilai,
            'smt' => $req->smt
        );

        $insert = Nilai::insert([$data]);

        if(!empty($insert)) {
            return response()->json($insert);
        } else {
            return response()->json("Input Error");
        }
    }

    public function cekNilai(Request $req)
    {
        $nilai = Nilai::where([['nim', '=', $req->nim], ['smt', '=', $req->smt]])->get();

        if(!empty($nilai)) {
            return response()->json($nilai);
        } else {
            return response()->json("Tidak ada nilai di semester ini.");
        }
    }

    protected function convertNilai($nilai)
    {
        if($nilai < 45) {
            return 0;
        } elseif ($nilai >= 45 && $nilai < 60) {
            return 1*3;
        } elseif ($nilai >= 60 && $nilai < 62) {
            return 2*3;
        } elseif ($nilai >= 62 && $nilai < 65) {
            return 2.30*3;
        } elseif ($nilai >= 65 && $nilai < 68) {
            return 2.70*3;
        } elseif ($nilai >= 68 && $nilai < 74) {
            return 3*3;
        } elseif ($nilai >= 74 && $nilai < 77) {
            return 3.30*3;
        } elseif ($nilai >= 77 && $nilai < 80) {
            return 3.70*3;
        } elseif ($nilai >= 80 && $nilai < 101) {
            return 4*3;
        }
    }

    public function cekIpk(Request $req)
    {
        $nilai = Nilai::where('nim', $req->nim)->get();

        $smt1 = 0;$smt2 = 0;$smt3 = 0;$smt4 = 0;$smt5 = 0;$smt6 = 0;$smt7 = 0;$smt8 = 0;
        $mat1 = 0;$mat2 = 0;$mat3 = 0;$mat4 = 0;$mat5 = 0;$mat6 = 0;$mat7 = 0;$mat8 = 0;
        $ips1 = 0;$ips2 = 0;$ips3 = 0;$ips4 = 0;$ips5 = 0;$ips6 = 0;$ips7 = 0;$ips8 = 0;
        $totIps = 0; $divIps = 0;

        foreach ($nilai as $ips) {
            if($ips->smt == 1) {
                $smt1 += $this->convertNilai($ips->nilai);
                $mat1 += 3;
            } elseif ($ips->smt == 2) {
                $smt2 += $this->convertNilai($ips->nilai);
                $mat2 += 3;
            } elseif ($ips->smt == 3) {
                $smt3 += $this->convertNilai($ips->nilai);
                $mat3 += 3;
            } elseif ($ips->smt == 4) {
                $smt4 += $this->convertNilai($ips->nilai);
                $mat4 += 3;
            } elseif ($ips->smt == 5) {
                $smt5 += $this->convertNilai($ips->nilai);
                $mat5 += 3;
            } elseif ($ips->smt == 6) {
                $smt6 += $this->convertNilai($ips->nilai);
                $mat6 += 3;
            } elseif ($ips->smt == 7) {
                $smt7 += $this->convertNilai($ips->nilai);
                $mat7 += 3;
            } elseif ($ips->smt == 8) {
                $smt8 += $this->convertNilai($ips->nilai);
                $mat8 += 3;
            }
        }

        if($mat1 != 0) {
            $ips1 = round($smt1/$mat1, 2);
        }
        if($mat2 != 0) {
            $ips2 = round($smt2/$mat2, 2);
        }
        if($mat3 != 0) {
            $ips3 = round($smt3/$mat3, 2);
        }
        if($mat4 != 0) {
            $ips4 = round($smt4/$mat4, 2);
        }
        if($mat5 != 0) {
            $ips5 = round($smt5/$mat5, 2);
        }
        if($mat6 != 0) {
            $ips6 = round($smt6/$mat6, 2);
        }
        if($mat7 != 0) {
            $ips7 = round($smt7/$mat7, 2);
        }
        if($mat8 != 0) {
            $ips8 = round($smt8/$mat8, 2);
        }

        if($ips1 != 0) {
            $totIps += $ips1;
            $divIps +=1;
        }
        if($ips2 != 0) {
            $totIps += $ips2;
            $divIps +=1;
        }
        if($ips3 != 0) {
            $totIps += $ips3;
            $divIps +=1;
        }
        if($ips4 != 0) {
            $totIps += $ips4;
            $divIps +=1;
        }
        if($ips5 != 0) {
            $totIps += $ips5;
            $divIps +=1;
        }
        if($ips6 != 0) {
            $totIps += $ips6;
            $divIps +=1;
        }
        if($ips7 != 0) {
            $totIps += $ips7;
            $divIps +=1;
        }
        if($ips8 != 0) {
            $totIps += $ips8;
            $divIps +=1;
        }

        $ipk = $totIps/$divIps;

        $nilai = array(
            'smt1' => $ips1,
            'smt2' => $ips2,
            'smt3' => $ips3,
            'smt4' => $ips4,
            'smt5' => $ips5,
            'smt6' => $ips6,
            'smt7' => $ips7,
            'smt8' => $ips8,
            'ipk' => $ipk
        );

        if(!empty($nilai)) {
            return response()->json($nilai);
        } else {
            return response()->json("Tidak ada nilai.");
        }
    }

    public function getMahasiswa()
    {
        $mahasiswa = User::where('role', 'MAHASISWA')->get();

        if($mahasiswa) {
            return response()->json($mahasiswa);
        } else {
            return response()->json("No Mahasiswa");
        }
    }

    public function getMatkul()
    {
        $matkul = Matakuliah::all();

        if($matkul) {
            return response()->json($matkul);
        } else {
            return response()->json("No Matkul");
        }
    }
}
