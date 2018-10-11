app.controller('class-controller', function($scope, $http){
	$http.get('allClasses').then(function(response){
		console.log(response.data)
		$scope.classes = response.data; 
	});
})