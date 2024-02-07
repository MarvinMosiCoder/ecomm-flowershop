<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\HeadingRowImport;
use App\Models\InventoryModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use DB;
use CRUDBooster;
use Excel;
use App\Imports\InventoryImport;
use App\Imports\AdminInventoryImport;
use App\Imports\BulkSalesImport;


class AdminImportController extends \crocodicstudio\crudbooster\controllers\CBController{

    // INVENTORY UPLOAD
    public function InventoryUpload(Request $request) {
        $path_excel = $request->file('import_file')->store('temp');
        $path = storage_path('app').'/'.$path_excel;

        if(Crudbooster::myPrivilegeId() == 2){
            $headings = array_filter((new HeadingRowImport)->toArray($path)[0][0]);
            if (count($headings) !== 5) {
                CRUDBooster::redirect(CRUDBooster::adminpath('inventory_tbl'), 'Template column not match, please refer to downloaded template.', 'danger');
            } else {
                try {
                    Excel::import(new InventoryImport, $path);	
                    CRUDBooster::redirect(CRUDBooster::adminpath('inventory_tbl'), trans("Upload Successfully!"), 'success');
                    
                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    $failures = $e->failures();
                    
                    $error = [];
                    foreach ($failures as $failure) {
                        $line = $failure->row();
                        foreach ($failure->errors() as $err) {
                            $error[] = $err . " on line: " . $line; 
                        }
                    }
                    
                    $errors = collect($error)->unique()->toArray();
            
                }
                CRUDBooster::redirect(CRUDBooster::adminpath('inventory_tbl'), $errors[0], 'danger');
            }
        }else{
            $headings = array_filter((new HeadingRowImport)->toArray($path)[0][0]);
            if (count($headings) !== 5) {
                CRUDBooster::redirect(CRUDBooster::adminpath('inventory_tbl'), 'Template column not match, please refer to downloaded template.', 'danger');
            } else {
                try {
                    Excel::import(new AdminInventoryImport, $path);	
                    CRUDBooster::redirect(CRUDBooster::adminpath('inventory_tbl'), trans("Upload Successfully!"), 'success');
                    
                } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                    $failures = $e->failures();
                    
                    $error = [];
                    foreach ($failures as $failure) {
                        $line = $failure->row();
                        foreach ($failure->errors() as $err) {
                            $error[] = $err . " on line: " . $line; 
                        }
                    }
                    
                    $errors = collect($error)->unique()->toArray();
            
                }
                CRUDBooster::redirect(CRUDBooster::adminpath('inventory_tbl'), $errors[0], 'danger');
            }
        }
        
    }

    // SALES UPLOAD
    public function bulkSalesUpload(Request $request) {
        $path_excel = $request->file('import_file')->store('temp');
        $path = storage_path('app').'/'.$path_excel;

        $headings = array_filter((new HeadingRowImport)->toArray($path)[0][0]);

        if (count($headings) !== 6) {
			CRUDBooster::redirect(CRUDBooster::adminpath('sales_tbl'), 'Template column not match, please refer to downloaded template.', 'danger');
		} else {
            try {
                Excel::import(new BulkSalesImport, $path);	
                CRUDBooster::redirect(CRUDBooster::adminpath('sales_tbl'), trans("Upload Successfully!"), 'success');
                
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
                
                $error = [];
                foreach ($failures as $failure) {
                    $line = $failure->row();
                    foreach ($failure->errors() as $err) {
                        $error[] = $err . " on line: " . $line; 
                    }
                }
                
                $errors = collect($error)->unique()->toArray();
        
            }
            CRUDBooster::redirect(CRUDBooster::adminpath('sales_tbl'), $errors[0], 'danger');

		}
    }


}

?>
