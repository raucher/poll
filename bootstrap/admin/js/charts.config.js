jQuery(document).ready(function($){
    if($('#mypiechart').length)
    {
        $.plot($('#mypiechart'), jQuery.statCharNS.data,
        {
            series: {
                pie: {
                    show: true,
                    radius: 1,
                    label: {
                        show: true,
                        radius: 4/6,
                        formatter: function(label, series){
                            return '<div style="font-size:12px;text-align:center;padding:4px;font-weight:bold;color:black;">'+Math.round(series.percent)+'%</div>';}
                    }
                }
            },
            grid: {
                hoverable: true,
                clickable: true
            },
            legend: {
                //show: false,
            },
            colors: ['#FA5833', '#2FABE9', '#FABB3D', '#78CD51']
        });

        function pieHover(event, pos, obj)
        {
            if (!obj)
                return;
            percent = parseFloat(obj.series.percent).toFixed(2);
            $('#hover').html('<span style="font-weight: bold; color: '+obj.series.color+'">'+obj.series.label+' ('+percent+'%)</span>');
        }
        $('#mypiechart').bind('plothover', pieHover);
    }
})