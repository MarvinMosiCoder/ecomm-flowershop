<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use App\Models\InventoryModel;
	use App\Models\InventoryImageModel;
	use App\Models\FlowerTypeModel;
	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Reader\Exception;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
	use PhpOffice\PhpSpreadsheet\IOFactory;


	class AdminInventoryTblController extends \crocodicstudio\crudbooster\controllers\CBController {
		public function __construct() {
			// Register ENUM type
			DB::getDoctrineSchemaManager()->getDatabasePlatform()->registerDoctrineTypeMapping("enum", "string");
		}
	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "id";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			if(in_array(CRUDBooster::myPrivilegeId(),[1,3])){
			    $this->button_table_action = true;
			}else{
				$this->button_table_action = false;
			}
			$this->button_bulk_action = false;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = true;
			$this->button_delete = false;
			$this->button_detail = false;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = true;
			$this->table = "inventory_tbl";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Flower Name","name"=>"flower_name"];
			// $this->col[] = ["label"=>"Image","name"=>"image"];
			$this->col[] = ["label"=>"Type","name"=>"flower_type","join"=>"sub_masterfile_flower_type,description"];
			$this->col[] = ["label"=>"Price","name"=>"price"];
			//$this->col[] = ["label"=>"Arrival","name"=>"arrival"];
			$this->col[] = ["label"=>"Stock","name"=>"stock"];
			//$this->col[] = ["label"=>"House Stock","name"=>"house_stock"];
			$this->col[] = ["label"=>"Store","name"=>"store_id","join"=>"stores,store_name"];
			$this->col[] = ["label"=>"Status","name"=>"status"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
	
			if(CRUDBooster::getCurrentMethod() == 'getEdit' || CRUDBooster::getCurrentMethod() == 'postEditSave' || CRUDBooster::getCurrentMethod() == 'getDetail') {
				$this->form[] = ['label'=>'Flower Type','name'=>'flower_type','type'=>'select','width'=>'col-sm-5', 'disabled'=>true,'datatable'=>'sub_masterfile_flower_type,description','datatable_where'=>"status = 'ACTIVE'"];
				$this->form[] = ['label'=>'Flower Name','name'=>'flower_name','type'=>'text','width'=>'col-sm-5', 'readonly'=>true];
				$this->form[] = ['label'=>'Price','name'=>'price','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-5'];
			}
		    
			//$this->form[] = ['label'=>'Percent Sale','name'=>'percent_sale','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			//$this->form[] = ['label'=>'Quantity','name'=>'quantity','type'=>'number','validation'=>'required|integer|min:0','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();
			if(CRUDBooster::getCurrentMethod() == 'getIndex') {
				$this->index_button[] = ["label"=>"Add Inventory","icon"=>"fa fa-plus-circle","url"=>CRUDBooster::mainpath('add-inventory'),"color"=>"success"];
				$this->index_button[] = ["label"=>"Upload Inventory","icon"=>"fa fa-upload","url"=>CRUDBooster::mainpath('inventory-upload'),'color'=>'primary'];
			}


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = "
			$(document).ready(function() {
				$('#btn_export_data').prop('class', 'btn btn-sm btn-success btn-export-data');
				$('#btn_export_data').children().prop('class', 'fa fa-download');
			});
			";


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        $this->load_js[] = asset("jquery-fat-zoom/js/zoom.js");
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
			if(in_array(CRUDBooster::myPrivilegeId(),[1,3])){
				$query->where('inventory_tbl.status','ACTIVE')->orderBy('inventory_tbl.id', 'DESC'); 
			}else{
				$query->where('store_id', Crudbooster::myStoreId())->where('inventory_tbl.status','ACTIVE')->orderBy('inventory_tbl.id', 'DESC'); 
			}
			
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
			$fields = Request::all();
			$postdata['flower_name']      = $fields['flower_name'];
			$postdata['item_description'] = $fields['item_description'];
			$postdata['arrival']          = $fields['arrival'];
			$postdata['stock']            = $fields['quantity'];
			$postdata['flower_type']      = $fields['flower_type'];
			$postdata['price']            = $fields['price'];
			$postdata['percent_sale']     = $fields['percent_sale'];
			$postdata['store_id']         = CRUDBooster::myStoreId();
			$postdata['status']           = 'ACTIVE';
			$postdata['created_by']       = CRUDBooster::myId();

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
			$fields = Request::all();
			$header = InventoryModel::where(['created_by' => CRUDBooster::myId()])->orderBy('id','desc')->first();
			
			$files 	= $fields['image'];
			$images = [];
			if (!empty($files)) {
				$counter = 0;
				foreach($files as $file){
					$counter++;
					$name = time().rand(1,50) . '.' . $file->getClientOriginalExtension();
					$filename = $name;
					$file->move('vendor/crudbooster/inventory_images',$filename);
					$images[]= $filename;

					$header_images               = new InventoryImageModel;
					$header_images->inv_id       = $header->id;
					$header_images->file_name    = $filename;
					$header_images->ext 	     = $file->getClientOriginalExtension();
					$header_images->created_by   = CRUDBooster::myId();
					$header_images->save();
				}
			}

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }

		public function getAddInventory() {
	        if(!CRUDBooster::isCreate() && $this->global_privilege == false) {
				CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
			}
            $data = [];
			$this->cbLoader();
			$data['page_title']  = 'Add Inventory';
			$data['flower_type'] = FlowerTypeModel::select('*')->get();
			return $this->view("admin.add-inventory", $data);

	    }

		public function getEdit($id) {
	        if(!CRUDBooster::isCreate() && $this->global_privilege == false) {
				CRUDBooster::redirect(CRUDBooster::adminPath(), trans('crudbooster.denied_access'));
			}
            $data = [];
			$this->cbLoader();
			$data['page_title']  = 'Edit Inventory';
			$data['inventory_data'] = InventoryModel::select('*')->where('id',$id)->first();

			return $this->view("admin.edit-inventory-vue", $data);

	    }

		public function UploadInventory() {
			$data['page_title']= 'Inventory Upload';
			return view('import.inventory-upload', $data)->render();
		}

		public function InventoryUpload(Request $request) {
			$path_excel = $request->file('import_file')->store('temp');
			$path = storage_path('app').'/'.$path_excel;
			Excel::import(new InventoryImport, $path);	
			CRUDBooster::redirect(CRUDBooster::adminpath('assets_supplies_inventory'), trans("Upload Successfully!"), 'success');
		}

		function downloadInventoryTemplate() {
			if(Crudbooster::myPrivilegeId() == 2){
				$arrHeader = [
					"flower_type"        => "flower_type",
					"flower_name"        => "flower_name",
					"stock"              => "stock",
					"price"              => "price"
				];
				$arrData = [
					"flower_type"        => "Fresh Flowers / Dried Flowers",
					"flower_name"        => "CHINA ROSE",
					"stock"              => "1",
					"price"              => "100",
				];
				$spreadsheet = new Spreadsheet();
				$spreadsheet->getActiveSheet()->fromArray(array_values($arrHeader), null, 'A1');
				$spreadsheet->getActiveSheet()->fromArray($arrData, null, 'A2');
				$filename = "inventory-template-".date('Y-m-d');
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
				header('Cache-Control: max-age=0');
				$writer = new Xlsx($spreadsheet);
				$writer->save('php://output');
			}else{
				$arrHeader = [
					"flower_type"        => "flower_type",
					"flower_name"        => "flower_name",
					"stock"              => "stock",
					"price"              => "price",
					"store"              => "store"
				];
				$arrData = [
					"flower_type"        => "Fresh Flowers / Dried Flowers",
					"flower_name"        => "CHINA ROSE",
					"stock"              => "1",
					"price"              => "100",
					"store"              => "name of store"
				];
				$spreadsheet = new Spreadsheet();
				$spreadsheet->getActiveSheet()->fromArray(array_values($arrHeader), null, 'A1');
				$spreadsheet->getActiveSheet()->fromArray($arrData, null, 'A2');
				$filename = "inventory-template-".date('Y-m-d');
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
				header('Cache-Control: max-age=0');
				$writer = new Xlsx($spreadsheet);
				$writer->save('php://output');
			}
			
		}


	}