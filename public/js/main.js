var app = angular.module("app", ["xeditable","ui.bootstrap"],function($interpolateProvider){
		$interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
});

app.run(function(editableOptions) {
  editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
});

