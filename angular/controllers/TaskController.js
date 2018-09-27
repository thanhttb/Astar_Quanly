app.controller("task-controller", function($scope, $http){
	$http.get(url).then(function(response){
		$scope.tasks = response.data;
		$scope.count = Object.keys(response.data).length;
	})
})