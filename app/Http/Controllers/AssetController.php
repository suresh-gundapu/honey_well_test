<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssetController extends Controller
{
    public function index()
    {
        $listingData['data'] = Asset::all();

        return view('assets_list', $listingData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('assets_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $inputParams = $request->all();
            $validator = validator::make($request->all(), [
                "name" => "required",
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $asset = new Asset();
            $asset->name = $inputParams['name'];
            $asset->uuid = (string) Str::uuid();;

            $asset->save();
            return redirect(url('/assets'))->withSuccess("added successfully");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $paramsList['data'] = Asset::where('id', $id)->first();
        if (empty($paramsList['data'])) {

            return redirect(url('/assets'))->withWarnings('No record Founds');
        }
        return view('assets_edit', $paramsList);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $inputParams = $request->all();
            $assetId = $inputParams['id'];
            $assetData = Asset::where('id', $assetId)->first();
            $assetData->name = $inputParams['name'];
            $assetData->save();
            return redirect(url('/assets'))->with('success', "Updated successfully")->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        try {
            $paramsArray = $request->all();
            $users = Asset::where('id', $paramsArray['id'])->delete();
            $returnArray['success'] = "1";
            $returnArray['message'] = 'Deleted successfully';
        } catch (\Exception $e) {
            $returnArray['success'] = "0";
            $returnArray['message'] = $e->getMessage();
        }
        return response()->json($returnArray, 200);
    }

    public function changeStatus(Request $request)
    {
        try {

            $paramsArray = $request->all();
            if ($paramsArray['status'] == "Active") {
                $status_code_final = "Inactive";
            } else {
                $status_code_final = "Active";
            }
            $values = array('status' =>  $status_code_final);
            Asset::where('id', $paramsArray['id'])->update($values);
            $retArr['success'] = "1";
            $retArr['message'] = 'Successfully Updated';
        } catch (\Exception $e) {
            $retArr['success'] = "0";
            $retArr['message'] = $e->getMessage();
        }
        return response()->json($retArr, 200);
    }
}
