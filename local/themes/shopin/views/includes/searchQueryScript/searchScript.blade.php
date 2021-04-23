<script>

    $('.filter_product').keyup(function(evt){
        evt.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });//for token purpose in laravel

        var searchRecord = $('#filter_product').val();
        var categories =  $('#categories').val();
        var inParentCategory = '';

        //var data = "searchRecord:"+searchRecord+ "categories:"+categories;

        jQuery.ajax({
            url: '{{ url("filter/products") }}',
            type: "Post",
            data: {searchRecord: searchRecord, categories: categories},
            success: function (data) {
                var maArrayData = jQuery.parseJSON(data);

                var maArray  = maArrayData.searchedProducts;
                var catInfo  = maArrayData.catInfo;
                if(data !=0 ) {
                    var html = '<ul>';
                    $.each(maArray, function (key, val) {

                        var search_result = '';
                        if(val.count != 'undefined'){
                            search_result = '<span id="search_results">'+val.count+'</span>';
                        }

                        var urlToGo = '{{url('category/')}}/'+catInfo[val.category_id].product_cat_slug+'?srch-term='+searchRecord+'&cat='+val.category_id;

                        another_cat = 0;
                        if($.inArray(val.category_id, catInfo)){
                            if(categories != catInfo[val.category_id].id){
                                inParentCategory = "in "+catInfo[val.category_id].name;
                                urlToGo = '{{url('category/')}}/'+catInfo[val.category_id].product_cat_slug+'?srch-term='+searchRecord+'&cat='+val.category_id;
                            }
                        }
                        substringTitle = val.title;
                        if(val.title.length > 45){
                            substringTitle = val.title.substring(0, 45)+'...';
                        }
                        html += '<li class="suggest '+another_cat+'">' +
                                '<a title="'+val.title+'"  href="'+urlToGo+'">'
                                + substringTitle +" <span style='color: #00aeef; font-size: 12px'>"+inParentCategory;
                        html +='</span><span style="float: right">Totals items  '+ search_result+'</span>';
                        html += '</a>' +
                                '</li>';
                        inParentCategory = '';
                    });
                }
                html += '</ul>';

                if(data !=0 ){
                    $("#suggesstion-box").show();
                    $("#hot-search").hide();
                    $("#suggesstion-box").html(html);
                    return false;
                }else{
                    $("#suggesstion-box").show();
                    $("#hot-search").hide();
                    $("#suggesstion-box").html('<ul><li class="no-suggestion">No Suggestion</li></ul>');
                }
            }});
    });
</script>
