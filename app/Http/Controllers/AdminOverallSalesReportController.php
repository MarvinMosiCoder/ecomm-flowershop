<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use App\Models\InventoryModel;
	use App\Models\SalesModel;
	use Carbon\Carbon;

	class AdminOverallSalesReportController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "flower_name";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = false;
			$this->button_edit = false;
			$this->button_delete = false;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "inventory_tbl";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Code","name"=>"code"];
			$this->col[] = ["label"=>"Flower Name","name"=>"flower_name"];
			$this->col[] = ["label"=>"Arrival","name"=>"arrival"];
			$this->col[] = ["label"=>"Stock","name"=>"stock"];
			$this->col[] = ["label"=>"House Stock","name"=>"house_stock"];
			$this->col[] = ["label"=>"Price","name"=>"price"];
			$this->col[] = ["label"=>"Flower Type","name"=>"flower_type"];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];

			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Code","name"=>"code","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Flower Name","name"=>"flower_name","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Arrival","name"=>"arrival","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Stock","name"=>"stock","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"House Stock","name"=>"house_stock","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Price","name"=>"price","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Flower Type","name"=>"flower_type","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Status","name"=>"status","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Store Id","name"=>"store_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"store,id"];
			//$this->form[] = ["label"=>"Created By","name"=>"created_by","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			//$this->form[] = ["label"=>"Updated By","name"=>"updated_by","type"=>"number","required"=>TRUE,"validation"=>"required|integer|min:0"];
			# OLD END FORM

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
	        $this->script_js = NULL;


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
	        $this->load_js[] = asset("datetimepicker/bootstrap-datetimepicker.min.js");
	        
	        
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
	        $this->load_css[] = asset("datetimepicker/bootstrap-datetimepicker.min.css");
	        
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
	        //Your code here
	            
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
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

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

		public function getIndex(Request $request) {
			if(!CRUDBooster::isView()) CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
			$data = [];
			$data['page_title'] = 'Over all Sales Report';

			$store_id = CRUDBooster::myStoreId();

			if(in_array(CRUDBooster::myPrivilegeId(),[1,3])){
				$inventory = InventoryModel::leftjoin('stores','inventory_tbl.store_id','=','stores.id')
				->leftjoin('sub_masterfile_flower_type','inventory_tbl.flower_type','=','sub_masterfile_flower_type.id')
				->select('inventory_tbl.*','stores.store_name','sub_masterfile_flower_type.description')->get();
				$sales = SalesModel::
				groupBy('sales_tbl.inv_id')
				->select(
							'inv_id as id',
							DB::raw('SUM(price) as sales_price'),
							DB::raw('SUM(quantity) as quantity'),
						   )
				->get()->toArray();
	
				$finalData = [];
	
				foreach($inventory as $invKey => $invVal){
					$i = array_search($invVal['id'], array_column($sales,'id'));
					if($i !== false){
						$invVal['sales'] = $sales[$i];
						$finalData[] = $invVal;
					}else{
						$invVal['sales'] = "";
						$finalData[] = $invVal;
					}
				}
				$data['reports'] = $finalData;
			}else{
				$inventory = InventoryModel::leftjoin('stores','inventory_tbl.store_id','=','stores.id')
				->leftjoin('sub_masterfile_flower_type','inventory_tbl.flower_type','=','sub_masterfile_flower_type.id')
				->select('inventory_tbl.*','stores.store_name','sub_masterfile_flower_type.description')->where('store_id', $store_id)->get();
				$sales = SalesModel::
				groupBy('sales_tbl.inv_id')
				->select(
							'inv_id as id',
							DB::raw('SUM(price) as sales_price'),
							DB::raw('SUM(quantity) as quantity'),
						   )
				->where('sales_tbl.store_id', $store_id)
				->get()->toArray();
	
				$finalData = [];
	
				foreach($inventory as $invKey => $invVal){
					$i = array_search($invVal['id'], array_column($sales,'id'));
					if($i !== false){
						$invVal['sales'] = $sales[$i];
						$finalData[] = $invVal;
					}else{
						$invVal['sales'] = "";
						$finalData[] = $invVal;
					}
				}
				$data['reports'] = $finalData;
			}

			return $this->view("admin.overall-sales-report", $data);
		}

		public function filterReport(Request $request){
			ini_set('memory_limit','-1');
            ini_set('max_execution_time', 0);
			$fields = Request::all();
			$from = $fields['from'];
			$to   = $fields['to'];

			$data = [];
			$data['page_title'] = 'Generated Sales Report';
			$store_id = CRUDBooster::myStoreId();

			if(in_array(CRUDBooster::myPrivilegeId(),[1,3])){
				$inventory = InventoryModel::leftjoin('stores','inventory_tbl.store_id','=','stores.id')
				->leftjoin('sub_masterfile_flower_type','inventory_tbl.flower_type','=','sub_masterfile_flower_type.id')
				->select('inventory_tbl.*','stores.store_name','sub_masterfile_flower_type.description')->get();
				
				$sales = SalesModel::
				groupBy('sales_tbl.inv_id')
				->select(
							'inv_id as id',
							DB::raw('SUM(price) as sales_price'),
							DB::raw('SUM(quantity) as quantity'),
						   )
				->whereBetween('sales_tbl.date_of_purchase',[$from,$to])
				->get()
				->toArray();
	
				$finalData = [];
	
				foreach($inventory as $invKey => $invVal){
					$i = array_search($invVal['id'], array_column($sales,'id'));
					if($i !== false){
						$invVal['sales'] = $sales[$i];
						$finalData[] = $invVal;
					}else{
						$invVal['sales'] = "";
						$finalData[] = $invVal;
					}
				}
				$data['reports'] = $finalData;
			}else{
				$inventory = InventoryModel::leftjoin('stores','inventory_tbl.store_id','=','stores.id')
				->leftjoin('sub_masterfile_flower_type','inventory_tbl.flower_type','=','sub_masterfile_flower_type.id')
				->select('inventory_tbl.*','stores.store_name','sub_masterfile_flower_type.description')->where('store_id', $store_id)->get();
				
				$sales = SalesModel::
				groupBy('sales_tbl.inv_id')
				->select(
							'inv_id as id',
							DB::raw('SUM(price) as sales_price'),
							DB::raw('SUM(quantity) as quantity'),
						   )
				->whereBetween('sales_tbl.date_of_purchase',[$from,$to])
				->where('sales_tbl.store_id', $store_id)
				->get()->toArray();
	
				$finalData = [];
	
				foreach($inventory as $invKey => $invVal){
					$i = array_search($invVal['id'], array_column($sales,'id'));
					if($i !== false){
						$invVal['sales'] = $sales[$i];
						$finalData[] = $invVal;
					}else{
						$invVal['sales'] = "";
						$finalData[] = $invVal;
					}
				}
				$data['reports'] = $finalData;
			}
			$data['from'] = $from;
			$data['to']   = $to;

			return $this->view("admin.generated-sales-report", $data);

		}


	}