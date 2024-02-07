$(document).ready(function() {
    $(document).on('click', '.category_checkbox', function () {

        var ids = [];

        var counter = 0;
        $('#catFilters').empty();
        $('.category_checkbox').each(function () {
            if ($(this).is(":checked")) {
                ids.push($(this).attr('id'));
                $('#catFilters').append(`<div class="alert fade show alert-color _add-secon" role="alert"> ${$(this).attr('attr-name')}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> </div>`);
                counter++;
            }
        });

        $('._t-item').text('(' + ids.length + ' items)');

        if (counter == 0) {
            $('.causes_div').empty();
            $('.causes_div').append('No Data Found');
        } else {
            fetchCauseAgainstCategory(ids);
        }
        
    });

});

function fetchProductDetails(id) {

    $('.causes_div').empty();
    let ids = 0;
    if(id != null){
        ids = id
    }else{
        ids = 0;
    }
    $.ajax({
        type: 'GET',
        url: 'get_product_details/' + ids,
        success: function (response) {
            var response = JSON.parse(response);
            const img_url = APP_URL+'/vendor/crudbooster/inventory_images/';
            const detail_url = APP_URL+'/flowershop/details/';
           
            if(response.length){
                $('.causes_div').append('No Data Found');
            }else{
                response.forEach(element => {
                    $('.causes_div').append(`<div href="#" class="col-lg-4 col-md-6 col-sm-6 col-xs-12 r_Causes IMGsize">
                        
                            <div class="img_thumb">
                            <div class="h-causeIMG">
                                <a href="${detail_url+element.inv_id}">
                                    <img src="${img_url}" alt="" />
                                </a>
                            </div>
                            
                            </div>
                            <h3><a class="alink" href="${img_url+element.inv_id}">${element.flower_name}</a></h3>
                            <div class="price">  
                                ₱${ ((element.percent_sale / 100) * element.price) - element.price}
                                <span>₱${element.price}</span> 
                            </div>
                    </div>`);
                });
            }
        }
    });
}

$('.right-cta-menu').on('click', '.search-toggle', function(e) {
    var selector = $(this).data('selector');

    $(selector).toggleClass('show').find('.search-input').focus();
    $(this).toggleClass('active');

    e.preventDefault();
});