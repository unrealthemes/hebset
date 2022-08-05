/**
 * Create the chart
 */

am4core.ready(function() {

    init_chart( 'chart_private_services', 'data_private' );
    init_chart( 'chart_statutory_services', 'data_statutory' );

    function init_chart( selector, data_type ) {

        // Themes begin
        am4core.useTheme(am4themes_spiritedaway);
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create( selector, am4charts.XYChart );

        // Create axes
        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        ///////////////////////////////////////////////////////////////
        var new_data = [];
        for ( let i = 0; i < chart_params[ data_type ].length; i++ ) {
            let service = chart_params[ data_type ][i].service;

            new_data[ i ] = {
                date : new Date( chart_params[ data_type ][i].year, chart_params[ data_type ][i].month, 1 ),
                [service] : chart_params[ data_type ][i].amount,
            };
        };
        ///////////////////////////////////////////////////////////////
        $.each(new_data, function (i) {	 
            $.each(new_data[i], function (key, val) {

                if ( key != 'date' ) {	
                    createSeries( key, key );
                }
            });
        });

        // Create series
        function createSeries(s, name) {

            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = s;
            series.dataFields.dateX = "date";
            series.name = name;

            var segment = series.segments.template;
            segment.interactionsEnabled = true;

            var hoverState = segment.states.create("hover");
            hoverState.properties.strokeWidth = 3;

            var dimmed = segment.states.create("dimmed");
            dimmed.properties.stroke = am4core.color("#dadada");

            segment.events.on("over", function(event) {
                processOver(event.target.parent.parent.parent);
            });

            segment.events.on("out", function(event) {
                processOut(event.target.parent.parent.parent);
            });

            series.data = new_data;

            return series;
        }

        chart.legend = new am4charts.Legend();
        chart.legend.position = "right";
        chart.legend.scrollable = true;
        chart.legend.maxWidth = 300;
        //chart.numberFormatter.numberFormat = "#.0a €";
        chart.numberFormatter.numberFormat = "#,###.## €";
        chart.language.locale["_decimalSeparator"] = ",";
        chart.language.locale["_thousandSeparator"] = ".";

        // console.log( chart );

        //////////////////////////////////////////////
        chart.legend.useDefaultMarker = true;
        var marker = chart.legend.markers.template.children.getIndex(0);
        marker.cornerRadius(12, 12, 12, 12);
        marker.strokeWidth = 2;
        marker.strokeOpacity = 1;
        marker.stroke = am4core.color("#ccc");
        //////////////////////////////////////////////

        // setTimeout(function() {
        //   chart.legend.markers.getIndex(0).opacity = 0.3;
        // }, 3000)
        // chart.legend.markers.template.states.create("dimmed").properties.opacity = 0.3;
        // chart.legend.labels.template.states.create("dimmed").properties.opacity = 0.3;

        chart.legend.itemContainers.template.events.on("over", function(event) {
            processOver(event.target.dataItem.dataContext);
        })

        chart.legend.itemContainers.template.events.on("out", function(event) {
            processOut(event.target.dataItem.dataContext);
        })

        function processOver(hoveredSeries) {

            hoveredSeries.toFront();

            hoveredSeries.segments.each(function(segment) {
                segment.setState("hover");
            })

            hoveredSeries.legendDataItem.marker.setState("default");
            hoveredSeries.legendDataItem.label.setState("default");

            chart.series.each(function(series) {
                if (series != hoveredSeries) {
                    series.segments.each(function(segment) {
                        segment.setState("dimmed");
                    })
                    series.bulletsContainer.setState("dimmed");
                    series.legendDataItem.marker.setState("dimmed");
                    series.legendDataItem.label.setState("dimmed");
                }
            });
        }

        function processOut() {

            chart.series.each(function(series) {
                series.segments.each(function(segment) {
                    segment.setState("default");
                })
                series.bulletsContainer.setState("default");
                series.legendDataItem.marker.setState("default");
                series.legendDataItem.label.setState("default");
            });
        }

        // document.getElementById("button").addEventListener("click", function(){
        //   processOver(chart.series.getIndex(3));
        // })
    }
});