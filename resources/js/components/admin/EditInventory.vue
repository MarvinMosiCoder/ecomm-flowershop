
<template>
    <form id="InventoryForm" enctype="multipart/form-data" v-on:submit.prevent="submitForm">   
        <input type="hidden" name="_token" :value="csrf" /> 
        <section id="loading">
            <div id="loading-content"></div>
        </section>
        <div class="row">
            <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="input">
                        <select2 placeholder="Choose Flower Type" v-model="form.type_of_flower" :options="options" name="type_of_flower" :settings="{width:'100%'}"/>
                        <span class="input__label"><span style="color:red">*</span> Flower Type</span>
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label class="input">
                        <input input-name="Flower Name" class="form-control input__field" type="text" v-model="form.flower_name" placeholder="Flower Name" name="flower_name" id="flower_name"/>
                        <span class="input__label"><span style="color:red">*</span> Flower Name</span>
                    </label>
                </div>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="input">
                        <input input-name="Item Description" class="form-control input__field" type="text" v-model="form.item_description" placeholder="Item Description" name="item_description" id="item_description">
                        <span class="input__label"><span style="color:red">*</span> Item Description</span>
                    </label>
                </div>
            </div>   
            <div class="col-md-6">
                <div class="form-group">
                    <label class="input">
                        <input input-name="Price" class="form-control input__field" type="text" placeholder="Price" v-model="form.price" name="price" id="price" @keypress="isNumber($event)">
                        <span class="input__label"><span style="color:red">*</span> Price</span>
                    </label>
                </div>
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="input">
                            <input input-name="Percentage Sale" class="form-control input__field" type="text" placeholder="Percentage Sale" v-model="form.percent_sale" name="percent_sale" id="percent_sale" @keypress="isNumber($event)">
                            <span class="input__label"><span style="color:red">*</span> Percentage Sale</span>
                        </label>
                    </div>
                </div>    
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="input">
                            <input input-name="Quantity" class="form-control input__field" type="text" placeholder="Quantity" v-model="form.quantity" name="quantity" id="quantity" @keypress="isNumber($event)">
                            <span class="input__label"><span style="color:red">*</span> Quantity</span>
                        </label>
                    </div>
                </div> 
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label"><span style="color:red">*</span> Image</label>
                        <input type="file" class="input__field" id="uploadfiles" ref="uploadfiles" multiple accept="image/jpeg" @change="onFileChange" style="width:100%;"/>
                        <div v-for="(image, key) in images" :key="key">
                            <div class="image-holder" style="margin-bottom:5px; margin-top:15px">
                                <img class="preview" width="180px;" hspace="10" height="120px" :ref="'image'" data-action="zoom" style="display: inline;" />
                            </div>    
                            <a class="btn btn-xs btn-danger" style="margin-left:10px" v-if="!isHidden" id="removeImageHeader" @click="removeImage(image, key)"><i class="fa fa-remove"></i></a>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="input">
                        <input type="text" placeholder="what are you looking for?" v-model="searchquery" v-on:keyup="autoComplete" class="form-control input__field">
                        <span class="input__label"> Search Item</span>
                        <ul class="ui-autocomplete ui-front ui-menu ui-widget ui-widget-content" v-if="data_results.length" id="ui-id-2" style="top: 35px; line-height: 1; width: 100%;">
                            <li class="list-group-item" v-for="result in data_results" :key="result.id" @click="select(result.id)" :class="selectedId === result.id ? 'my-selected-item-class':null">
                                {{ result.flower_name }}
                            </li>
                        </ul>
                    </label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box-header text-center">
                    <h3 class="box-title"><b>Item Details</b></h3>
                </div>
                <div class="box-body no-padding">
                    <table class="table" id="asset-items">
                        <thead class="text text-success">
                            <tr>                            
                                <th class="text-center">Digits Code</th>
                                <th class="text-center">Item Description</th>
                                <th class="text-center">Option</th> 
                                <th class="text-center">Value</th> 
                                <th class="text-center">Quantity</th> 
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(tableData,index) in tableRows" :key="index">                            
                                    <td>
                                        <input type="text" class="form-control" v-model="tableData.digits_code" :id="tableData.id"  :ref="'digits_code'" name="digits_code[]" >
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" v-model="tableData.description" :ref="'description'" name="description[]" >
                                    </td>
                                    <td>
                                        <select2 placeholder="Choose Flower Type" v-model="test_option" :options="finalLineOptions[index]" name="test_option[]" :id="'test_option'+index" @change="optionChange" :settings="{width:'100%'}"/>
                                    </td> 
                                    <td>
                                        <input class="form-control" type="text" placeholder="Value" v-model="tableData.value" name="value" id="value" @keypress="isNumber($event)">
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" placeholder="Quantity" v-model="tableData.lineQuantity" :id="'lineQuantity'+tableData.id" ref="lineQuantity" value="1" name="lineQuantity[]" @keypress="isNumber($event)">
                                    </td>
                                    <td>
                                        <a @click="deleteRow(index)" class="btn btn-sm btn-danger delete_item btn-lg"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>                        
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
       
        <!-- <a class="fa fa-plus pull-left"  @click="addRow" style="font-size:25px;color:#337ab7;cursor:pointer"></a> -->
        <hr>
        <div class='panel-footer'>
            <a class="btn btn-default"> Cancel</a>
            <button class="btn btn-primary pull-right" :disabled="isActive" type="submit" id="btnSubmit"> <i class="fa fa-save" ></i> Save</button>
        </div>
    </form>
</template>

<script>
import jsHelper from "../../assets/isNumber.js";
const {isNumber} = jsHelper();

    export default {
        props: ['inventory_data'],
        data(){
          return{
                form: {
                    type_of_flower: '',
                    flower_name: this.inventory_data.flower_name,
                    item_description: this.inventory_data.item_description,
                    price: this.inventory_data.price,
                    percent_sale: this.inventory_data.percent_sale,
                    quantity: this.inventory_data.stock,             
                },
                token: document.head.querySelector('meta[name="csrf-token"]').content,
                images: [],
                extensions: ['jpg','jpeg','gif','png'],
                options: [],
                finalLineOptions: [],
                lineOptionStack: [],
                isHidden: false,
                selectedFile: '',
                isActive: false,
                index: [0],
                tableRows: [],
                searchquery: '',
                data_results: [],
                selectedId : null,
                stack: [],
            }
        },
        mounted() {
            console.log(this.inventory_data)
            this.optionsValue()
            this.isNumber()
         
        },
        methods: {
            optionsValue(){
                axios.post('/optios-value')
                .then((response)=>{
                    this.options = response.data
                })
            },         
            onFileChange(e) {
                let vm = this;
                var selectedFiles = e.target.files;
                for (let i = 0; i < selectedFiles.length; i++) {
                    console.log(selectedFiles[i]);
                    this.images.push(selectedFiles[i]);  
                }

                for (let i = 0; i < this.images.length; i++) {
                    let reader = new FileReader();
                reader.onload = (e) => {
                    this.$refs.image[i].src = reader.result;

                    console.log(this.$refs.image[i].src);
                    };

                    reader.readAsDataURL(this.images[i]);
                }
            },
            removeImage(image, index) {
                this.images.splice(index, 1)
                this.onFileChange()
            },
            autoComplete(){
                this.data_results = [];
                if(this.searchquery.length > 2){
                axios.get('/search',{params: {searchquery: this.searchquery}}).then(response => {
                    this.data_results = response.data;
                    if(this.data_results == ""){
                        swal({  
                            type: 'error',
                            title: 'No item found!',
                            icon: 'error',
                            confirmButtonColor: "#367fa9",
                        });
                        return false;
                    }
                  
                });
                }
            },
            optionChange(e){
                this.lineOptionStack.push(parseInt(e))
               
            },
            select(itemId){
                this.selectedId = itemId,
                this.data_results = '',
                this.searchquery = '',
                axios.post('/get-search-data',{id: itemId})
                .then((response)=>{
                    if (!this.stack.includes(response.data.id)) {  
                        this.stack.push(response.data.id)  
                        this.tableRows.push({
                            id: itemId,
                            digits_code: response.data.flower_name,
                            description: response.data.item_description,
                            value: response.data.price,
                            lineQuantity: 1
                        });
                    }else{
                        swal({  
                            type: 'error',
                            title: 'item already added!',
                            icon: 'error',
                            confirmButtonColor: "#367fa9",
                        });
                        return false;
                    }   
                })
                //fill options line value
                this.lineOptions = [];
                axios.post('/optios-value')
                .then((response)=>{
                    response.data.forEach((item) => {
                        var idExists  = this.lineOptionStack.some(function(field) {
                            return field === item.id
                        })
                        if(!idExists){
                            this.lineOptions.push(item)     
                        }
                    });
                    this.finalLineOptions.push(this.lineOptions)
                })
                console.log(this.finalLineOptions)
            },
            deleteRow(index){    
                this.tableRows.splice(index,1)
                this.finalLineOptions.splice(index,1)
                this.stack.splice(index,1)
                var id = parseInt(document.querySelector("#test_option"+index).value)
                const removeIndex = this.lineOptionStack.findIndex(tier => tier === id)
                if (removeIndex === -1) return // means item not found
                this.lineOptionStack.splice(removeIndex, 1)
            },
            submitForm(event){
                var vm = this;
                    if(!this.form.type_of_flower){
                        swal({  
                            type: 'error',
                            title: 'Please choose type of flower!',
                            icon: 'error',
                            confirmButtonColor: "#367fa9",
                        });
                        event.preventDefault();
                        return false;
                    }

                    for (var x = 1; x < 6; ++x) {
                        if (this.$el[x]._value ==="") {
                            swal({  
                                type: 'error',
                                title: this.$el[x].attributes[0].nodeValue+' Required!',
                                icon: 'error',
                                confirmButtonColor: "#367fa9",
                            });
                            event.preventDefault();
                            return false;
                        }
                    }
                    
                    if(this.$refs.uploadfiles.files.length === 0){
                        swal({  
                            type: 'error',
                            title: 'Image Required!',
                            icon: 'error',
                            confirmButtonColor: "#367fa9",
                        });
                        event.preventDefault();
                        return false;
                    }
                    
                    for (var i = 0; i < this.$refs.uploadfiles.files.length; ++i) {
                        var file1 = this.$refs.uploadfiles.files[i].name;
                        if(file1){                        
                            var ext = file1.split('.').pop().toLowerCase();     
                            var exists  = this.extensions.some(function(field) {
                                return field === ext
                            });

                            if (!exists) {
                                swal({
                                    type: 'error',
                                    title: 'Invalid Image Extension for SI/DR!',
                                    icon: 'error',
                                    customClass: 'swal-wide',
                                    confirmButtonColor: "#367fa9"
                                });
                                return false;
                            }                  
                        }
                    }
                    swal({
                        title: "Are you sure?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#41B314",
                        cancelButtonColor: "#F9354C",
                        confirmButtonText: "Yes, send it!",
                        width: 450,
                        height: 200
                    },() => {
                        const config = {
                            headers: {
                                'content-type': 'multipart/form-data',
                            }
                        }
                        let formData = new FormData();
                        var files = this.$refs.uploadfiles.files;
                        var totalfiles = this.$refs.uploadfiles.files.length;
                        formData.append("_token", this.token);
                        for (var index = 0; index < totalfiles; index++) {
                            formData.append("files[]", files[index]);
                        }
                        formData.append("form_data", JSON.stringify(this.form));
                        formData.append("tableRowData", JSON.stringify(this.tableRows));  
                        axios.post('/save-inventory', formData, config)
                        .then(response => {
                                if (response.data.status == "success") {
                                swal({
                                    type: response.data.status,
                                    title: response.data.message,
                                });
                                setTimeout(function(){
                                    window.location.replace(document.referrer);
                                }, 1000); 
                            } else if (response.data.status == "error") {
                                swal({
                                    type: response.data.status,
                                    title: response.data.message,
                                });
                            }
                        }).catch(error => {
                            console.error(error);
                        }); 
                    });   
            },
            isNumber,
           
        },
      
    }
</script>

<style scope>
    :root {
    --color-light: white;
    --color-dark: #212121;
    --color-signal: #fab700;
    --color-background: var(--color-light);
    --color-text: var(--color-dark);
    --color-accent: var(--color-signal);
    --size-bezel: 0.5rem;
    --size-radius: 4px;
    line-height: 1.4;
    font-size: calc(0.6rem + 0.4vw);
    color: var(--color-text);
    background: var(--color-background);
    }
    /* Change the white to any color */
    input:-webkit-autofill,
    input:-webkit-autofill:hover, 
    input:-webkit-autofill:focus, 
    input:-webkit-autofill:active{
        -webkit-box-shadow: 0 0 0 30px white inset !important;
    }
    #asset-items th, td {
        border: 1px solid rgba(000, 0, 0, .5);
        padding: 8px;
    }
    input[type=file]{
        width: 100%;
        border: 1px solid #a7a5a5ee;
        padding: 3px;
    }

    input[type=file]::file-selector-button {
        margin-right: 20px;
        border: none;
        background: #367fa9;
        padding: 8px 18px;
        border-radius: 3px;
        color: #fff;
        cursor: pointer;
        transition: background .2s ease-in-out;
    }

    input[type=file]::file-selector-button:hover {
        opacity: 0.7;
    }

    
    .input {
        position: relative;
    }
    .input__label {
        position: absolute;
        left: 0;
        bottom: 0;
        padding: 2px;
        margin-bottom: 24px;
        margin-left: 10px;
        background: pink;
        background: var(--color-background);
        font-weight: bold;
        line-height: 1.2;
    }
    .input__field {
        box-sizing: border-box;
        display: block;
        width: 100%;
        border: 1px solid #444;
        padding: 15px;
        color: currentColor;
        border-radius: var(--size-radius);
        margin-bottom: 30px;
        background-color: transparent;
    }

    .list-group-item:hover{
        background-color: #3c8dbc;
        border-color: #367fa9;
        color: #fff;
        line-height: 1;
    }

</style>
