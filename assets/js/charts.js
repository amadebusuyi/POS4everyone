(function($) {
    'use strict'

var SalesChart = (function() {

	// Variables

	var $chart = $('#chart-sales-main');


	// Methods

	function init($this) {
		var salesChart = new Chart($this, {
			type: 'line',
			options: {
				scales: {
					yAxes: [{
						gridLines: {
							color: Charts.colors.gray[700],
							zeroLineColor: Charts.colors.gray[700]
						},
						ticks: {

						}
					}]
				}
			},
			data: {
				labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
				datasets: [{
					label: 'Sales Amount',
					prefix: '$',
					suffix: 'k',
					data: [0, 0, 0, 0, 20, 10, 30, 15, 200, 20, 60, 60]
				}]
			}
		});

		// Save to jQuery object

		$this.data('chart', salesChart);

	};

	// Events

	if ($chart.length) {
		init($chart);
	}

})();


}(jQuery))