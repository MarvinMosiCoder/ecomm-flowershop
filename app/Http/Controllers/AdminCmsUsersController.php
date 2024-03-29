<?php namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDbooster;
use crocodicstudio\crudbooster\controllers\CBController;

class AdminCmsUsersController extends CBController {


	public function cbInit() {
		# START CONFIGURATION DO NOT REMOVE THIS LINE
		$this->table               = 'cms_users';
		$this->primary_key         = 'id';
		$this->title_field         = "name";
		$this->button_action_style = 'button_icon';	
		$this->button_import 	   = FALSE;	
		$this->button_export 	   = FALSE;	
		# END CONFIGURATION DO NOT REMOVE THIS LINE
	
		# START COLUMNS DO NOT REMOVE THIS LINE
		$this->col = array();
		$this->col[] = array("label"=>"Name","name"=>"name");
		$this->col[] = array("label"=>"Email","name"=>"email");
		$this->col[] = array("label"=>"Privilege","name"=>"id_cms_privileges","join"=>"cms_privileges,name");
		$this->col[] = array("label"=>"Photo","name"=>"photo","image"=>1);		
		# END COLUMNS DO NOT REMOVE THIS LINE

		# START FORM DO NOT REMOVE THIS LINE
		$this->form = array(); 		
		$this->form[] = array("label"=>"Name","name"=>"name",'required'=>true,'validation'=>'required|alpha_spaces|min:3');
		$this->form[] = array("label"=>"Email","name"=>"email",'required'=>true,'type'=>'email','validation'=>'required|email|unique:cms_users,email,'.CRUDBooster::getCurrentId());		
		$this->form[] = array("label"=>"Photo","name"=>"photo","type"=>"upload","help"=>"Recommended resolution is 200x200px",'required'=>true,'validation'=>'required|image|max:1000','resize_width'=>90,'resize_height'=>90);											
		$this->form[] = array("label"=>"Privilege","name"=>"id_cms_privileges","type"=>"select","datatable"=>"cms_privileges,name",'required'=>true);		
		$this->form[] = array("label"=>"Store","name"=>"store_id","type"=>"select","datatable"=>"stores,store_name",'required'=>true);						
		// $this->form[] = array("label"=>"Password","name"=>"password","type"=>"password","help"=>"Please leave empty if not change");
		$this->form[] = array("label"=>"Password","name"=>"password","type"=>"password","help"=>"Please leave empty if not change");
		$this->form[] = array("label"=>"Password Confirmation","name"=>"password_confirmation","type"=>"password","help"=>"Please leave empty if not change");
		# END FORM DO NOT REMOVE THIS LINE
			
		$this->script_js = "
		$(document).ready(function() {
			$('#id_cms_privileges').select2();
			$('#store_id').select2();

			let x = $(location).attr('pathname').split('/');
			let add_action = x.includes('add');
			let edit_action = x.includes('edit');
			if (add_action){
				$('#form-group-store_id').hide();
				$('#store_id').removeAttr('required');
				
				$('#id_cms_privileges').change(function() {
					if($(this).val() == 1 || $(this).val() == 3){
						$('#form-group-store_id').hide();
						$('#store_id').removeAttr('required');
					}else{
						$('#form-group-store_id').show();
						$('#store_id').attr('required', 'required');
					}
				});
			}else if(edit_action){ 
				$('#form-group-store_id').hide();
				$('#store_id').removeAttr('required');
				$('#id_cms_privileges').change(function() {
					if($(this).val() == 1 || $(this).val() == 3){
						$('#form-group-store_id').hide();
						$('#store_id').removeAttr('required');
					}else if($(this).val() == 2){
						$('#form-group-store_id').show();
						$('#store_id').attr('required', 'required');
					}else{
						$('#form-group-store_id').hide();
						$('#store_id').removeAttr('required');
					}
				});

				if($('#id_cms_privileges').val() == 1 || $('#id_cms_privileges').val() == 3){
					$('#form-group-store_id').hide();
					$('#store_id').removeAttr('required');
				}else if($('#id_cms_privileges').val() == 2){
					$('#form-group-store_id').show();
					$('#store_id').attr('required', 'required');
				}
			}
		});

	
		";
	}

	

	public function getProfile() {			

		$this->button_addmore = FALSE;
		$this->button_cancel  = FALSE;
		$this->button_show    = FALSE;			
		$this->button_add     = FALSE;
		$this->button_delete  = FALSE;	
		$this->hide_form 	  = ['id_cms_privileges'];

		$data['page_title'] = cbLang("label_button_profile");
		$data['row']        = CRUDBooster::first('cms_users',CRUDBooster::myId());

        return $this->view('crudbooster::default.form',$data);
	}
	public function hook_before_edit(&$postdata,$id) { 
		unset($postdata['password_confirmation']);
	}
	public function hook_before_add(&$postdata) {      
	    unset($postdata['password_confirmation']);
	}
}
