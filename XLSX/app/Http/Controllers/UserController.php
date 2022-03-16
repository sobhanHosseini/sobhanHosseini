<?php

namespace App\Http\Controllers;

use App\Exports\DocdefExport;
use App\Exports\ExportFile;
use App\Exports\GroupUserExport;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Models\Info;
use Illuminate\Http\Request;

//use Muserstwebsite\Excel\Excel;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;

class UserController extends Controller
{
    public function fileImportExport()
    {
        return view('file-import');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function fileImport(Request $request)
    {

        $a = Excel::toArray(new UsersImport, $request->file('file')->store('temp'));

        $title = $a[0][0];
        $len = count($a[0]);

        for ($i = 1; $i < $len; $i++) {
            for ($j = 0; $j < count($title); $j++) {
                if ($a[0][$i][$j])
                    Info::create([
                        'name' => $title[$j],
                        'email' => $a[0][$i][$j],
                    ]);
            }
        }

        return back();
    }

    public function dow($export, $value)
    {
        return Excel::download($export, $value . '.xlsx');
    }

    /**
     *get docdef's item
     */
    public function docdefLine()
    {

//
//        $data = '';
//        foreach ($province as $value) {
//
//            $data = $data . "'public/$value->ID' => [
//        'driver' => 'local',
//        'root' => storage_path('app/public/$value->ProvinceName'),
//        'url' => env('APP_URL').'/storage',
//        'visibility' => 'public',
//    ],\n";
//        }

//        file_put_contents(app_path('test.php'), "<?php\n\n" . $data);

        $docdefId = [
            101, 102, 103, 104, 105,
            106, 110, 111, 112, 113, 118,
            119, 120, 121, 114, 115, 116,
            117, 221, 300, 108, 109, 938,
            403, 402, 405, 406, 409, 407
        ];
//        $data = DB::table('mis.MIS_Places', 'p')
//            ->select()
//            ->join('mis.MIS_DocDefLinks as ddl', 'p.PlaceTypeID', 'ddl.PlaceTypeID')
//            ->join('mis.MIS_DocDefs as dd', 'ddl.DocDefID', 'dd.ID')
//            ->join('mis.MIS_DocDefLines as dl', 'dd.ID', 'dl.DocDefID')
//            ->join('mis.MIS_Item as mi', 'mi.ID', 'dl.MIS_ItemID')
//            ->leftJoin('mis.MIS_Cities as c', 'c.ID', 'p.CityID')
//            ->leftJoin('mis.MIS_Zones as z', 'z.ID', 'c.ZoneID')
//            ->leftJoin('mis.MIS_SubCenters as sc', 'sc.ID', 'z.SubCenterID')
//            ->leftJoin('mis.MIS_Centers as cn', 'cn.ID', 'sc.CenterID')
//            ->whereIn('cn.ID', [156, 138]);
//            ->where('dd.DocDefCode', 103)
//            ->orderBy('cn.CenterCode')
//            ->orderBy('sc.SubCenterCode')
//            ->orderBy('z.ZoneCode')
//            ->orderBy('c.CityCode')
//            ->orderBy('p.PlaceCode')->limit(4);

        $province = DB::table('mis.MIS_Provinces_copy1 as p')->get();

        foreach ($province as $prv) {
            $centers = DB::table('mis.MIS_Centers as p')->select('p.ID')->where('p.ProvinceID', $prv->ID)->where('p.ID', '>', 0)->whereIn('p.CenterTypeID', [1, 2])->get()->toArray();
            $centersId = [];
            foreach ($centers as $val) {
                array_push($centersId, $val->ID);
            }

            foreach ($docdefId as $value) {
                $data = DB::table('mis.MIS_Places', 'p')
                    ->select()
                    ->join('mis.MIS_DocDefLinks as ddl', 'p.PlaceTypeID', 'ddl.PlaceTypeID')
                    ->join('mis.MIS_DocDefs as dd', 'ddl.DocDefID', 'dd.ID')
                    ->join('mis.MIS_DocDefLines as dl', 'dd.ID', 'dl.DocDefID')
                    ->join('mis.MIS_Item as mi', 'mi.ID', 'dl.MIS_ItemID')
                    ->leftJoin('mis.MIS_Cities as c', 'c.ID', 'p.CityID')
                    ->leftJoin('mis.MIS_Zones as z', 'z.ID', 'c.ZoneID')
                    ->leftJoin('mis.MIS_SubCenters as sc', 'sc.ID', 'z.SubCenterID')
                    ->leftJoin('mis.MIS_Centers as cn', 'cn.ID', 'sc.CenterID')
                    ->whereIn('cn.ID', $centersId)
                    ->where('dd.DocDefCode', $value)->get()->toArray();

                if ($data) {
                    $export = new DocdefExport($data);
                    Excel::store($export, $value . '_' . $data[0]->DocDefName . '.xlsx', 'public/' . $data[0]->ProvinceID);
                }
            }
        }

    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public
    function fileExport()
    {
        $province = DB::table('mis.MIS_Provinces as p')->where('p.ID', '>', 0)->whereNotIn('p.ID', [126])->get()->toArray();

        /*
         * get employee mis
         */
        $data = [];
        foreach ($province as $value) {
            $groupId = [1710000002, 1043000001, 1043000002, 1043000003, 1043000004,
                1043000005, 1710000001, 1840000021, 1840000028, 1840000030,
                7, 9, 10, 12, 13, 15, 17, 22, 23, 24, 25, 33, 81, 83,
                34, 44, 45, 46, 47, 49, 50, 51, 52, 56, 57, 69, 70, 71,
                84, 88, 99, 100, 102, 103, 104, 105, 110, 112, 76,
                113, 114, 120, 122, 123, 124, 125, 127, 128, 129,
                260000001, 260000002, 400000004, 1321000001,
                1800000001, 1800000002, 1800000003, 1840000001,
                1840000003, 1840000006, 1840000014, 1840000018,
                1840000020, 1840000021, 1840000023, 1840000024];
            $count = 1;
            $province_id = $value->ID;

            $centers = DB::table('mis.MIS_Centers as p')->select('p.ID')->where('p.ProvinceID', $province_id)->get()->toArray();
            $centersId = [];
            foreach ($centers as $val) {
                array_push($centersId, $val->ID);
            }

            $tmp = DB::table('mis.MIS_Centers as center')
                ->select('ur.*', 'hm.NationalCode', 'gr.GroupName')
                ->join('mis.misCenterScuCompany as csc', 'center.ID', 'csc.CenterID')
                ->join('hrms.scuCompany as sc', 'sc.ID', 'csc.ScuCompanyID')
                ->join('mis.MIS_Users as ur', 'ur.CurrScuCompanyID', 'sc.ID')
                ->leftJoin('hrms.hrsEmployees as hm', 'ur.hrsEmployeeID', 'hm.ID')
                ->leftJoin('mis.MIS_Groups as gr', 'ur.GroupID', 'gr.ID')
                ->whereIn('center.ID', $centersId)
                ->whereNotIn('ur.GroupID', $groupId)
                ->orderBy('ur.GroupID')
                ->get()->toArray();

            array_push($tmp, $value->ProvinceName);
            array_push($data, $tmp);
        }
        $export = new GroupUserExport($data);
        // Excel::store($export, $value->ProvinceName . '.xlsx');
        return Excel::download($export, 'mis.xlsx');
    }


}
