app.controller("reminder-controller", function($scope, $http){
	$http.get('getHistory/'+ id).then(function(response){
		$scope.histories = response.data;
	})
	$scope.save = function(){
		$http({
			method: 'POST',
			url: 'postFormReminder/'+id,
			data: $scope.reminder,
			header: {'Content-type' : 'application/x-www-form-urlencoded'},
		})
		.then(function(response){
			$http.get('getHistory/'+ id).then(function(response){
				$scope.histories = response.data;
			})
		})
	}
	$scope.done = function(reminder_id){
		$http({
			method: 'POST',
			url: 'doneReminder/'+ reminder_id,
			header: {'Content-type' : 'application/x-www-form-urlencoded'},
		})
		.then(function (response){
			$http.get('getHistory/'+ id).then(function(response){
				$scope.histories = response.data;
			})
		})
	}
})