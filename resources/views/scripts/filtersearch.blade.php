<script type="text/javascript">
    //Toggle input types
    function ToggleTypes(value) {
        var text = '';
        if(value == 'events') {
            text = '{!! Lang::get('products.product-events') !!}';
        }
        else if(value == 'foodstands'){
            text = '{!! Lang::get('products.product-foodstands') !!}';

        }else if(value == 'entertainers'){
            text = '{!! Lang::get('products.product-entertainers') !!}';
        }

        //Toggle the hide class
        $('.'+text.toLowerCase()).toggleClass('hide');
    }

    //Hightlight Matched words
    function highlightSearch($object,term){
        term = term.replace(/(\s+)/,"(<[^>]+>)*$1(<[^>]+>)*");
        var src_str = $($object).html();
        var pattern = new RegExp("("+term+")", "gi");

        src_str = src_str.replace(pattern, "<mark>$1</mark>");
        src_str = src_str.replace(/(<mark>[^<>]*)((<[^>]+>)+)([^<>]*<\/mark>)/,"$1</mark>$2<mark>$4");

        $($object).html(src_str);
    }

    jQuery(document).ready(function($){
        //Using jQuery to handle the checkbox filter
        $('#js-search-filter .checkboxfilter').change(function() {
            //Show/Hide the Types on input change
            ToggleTypes($(this).val());
        });

        var term = '{{$search}}';

        //Search the TITLES and highlight
        $('.typesoverview-text-wrapper .typesoverview-title').each(function() {
            highlightSearch($(this), term);
        });

        //Search the KEYWORDS and highlight
        $('.keyword-item').each(function() {
            highlightSearch($(this), term);
        });

    });
</script>