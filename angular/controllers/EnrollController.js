app.controller('enroll-controller', function($scope, $http){
	$scope.fillUp = function(){
		if($scope.firstName.indexOf("|") != -1){
			$arr = $scope.firstName.split('|');
			$scope.firstName = $arr[0]+'|'+$arr[2];
			$scope.lastName = $arr[1];
			$scope.dob = $arr[3];
			$scope.school = $arr[4];
			$scope.name= $arr[5];
			$scope.phone = $arr[6];
			$scope.email = $arr[7];
		}
	}
	$scope.parentFillUp = function(){
		if($scope.phone.indexOf("|") != -1){
			$arr = $scope.phone.split('|');
			$scope.name = $arr[0]+" | "+ $arr[1];
			$scope.phone = $arr[2];
			$scope.email = $arr[3];
		}
	}

})