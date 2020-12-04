<script>
    //price filter
$( function() {
    $( "#slider-range" ).slider({
        range: true,
        min: {{ $min }},
        max: {{ $max }},
        values: [ {{ $max*20/100 }}, {{ $max*80/100 }} ],
        // step: {{ $min }},
        slide: function( event, ui ) {
            $( "#amount" ).val( addCommas(ui.values[ 0 ]) + " VNĐ"+" - " + addCommas(ui.values[ 1 ]) +" VNĐ");
            $( "#start_price" ).val( ui.values[ 0 ]);
            $( "#end_price" ).val( ui.values[ 1 ]);
        }
    });
    $( "#amount" ).val(  $( "#slider-range" ).slider( "values", 0 ) + " VNĐ" +
    " - " + $( "#slider-range" ).slider( "values", 1 ) + " VNĐ");
    
    function addCommas(nStr){
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
});
</script>