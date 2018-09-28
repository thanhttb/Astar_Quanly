app.controller("account-controller",function($scope, $http){
	//Get All Account
	$http.get('allAccount').then(function(response){
		 $scope.allAccount = response.data;
	})
	//Get All Groups
	$http.get('allGroup').then(function(response){
		$scope.allGroups = response.data;
	})
	//Row check
	$scope.checked = false;

	$scope.rowClicked = function(account){
		account.selected = !account.selected;	
		if(!$scope.checked){
			$scope.checked = !$scope.checked;
		}
	}
	//CHeck all
	$scope.checkAll = function(){
		 var b = false;
		for (var i = $scope.allAccount.length - 1; i >= 0; i--) {
			if($scope.allAccount[i].selected){
				b = true;
				$scope.allAccount[i].selected = ! $scope.allAccount[i].selected;
			}
		}
		if(b){
			$scope.checked = !$scope.checked;
			return 1;
		}
		for (var i = $scope.allAccount.length - 1; i >= 0; i--) {
			$scope.allAccount[i].selected = ! $scope.allAccount[i].selected;
		}
		$scope.checked = !$scope.checked;
	}
	function hasValue(obj, key, value) {
	    return obj.hasOwnProperty(key) && obj[key] === value;
	}
	$scope.showModal = function(state, id){
		switch(state){
			case "add":
				$scope.frmTitle = "Thêm tài khoản";
				$scope.state = "add";
				$scope.account = {};
				$scope.account.groups=[];
				
				break;
			case "edit":
				$scope.frmTitle = "Sửa tài khoản";
				$http.get('getEdit/' + id).then(function(response){
					$scope.account = response.data;
					var selectedGroups = [];
					for(var x in response.data.groups){
						for(var i = 0; i<$scope.allGroups.length; i++){
							// console.log($scope.allGroups[i]);
							// console.log(response.data.groups[x].id);
							if($scope.allGroups[i].hasOwnProperty('id') && $scope.allGroups[i].id === response.data.groups[x].id){

								// console.log($scope.allGroups[i]);
								// console.log(response.data.groups[x]);
								selectedGroups.push($scope.allGroups[i]);
							}
						}
					}
					$scope.account.groups = selectedGroups;
					$scope.id = id;
				});
				

			
				$scope.state = "edit";
				break;
			default:
				break;
		}
		$('#myModal').modal('show');

	}
	$scope.save = function(state, id){
		switch(state){
			case "add":
				var url = 'newAccount';
				var result = [];
				var data = $.param($scope.account);
				$http({
					method: "POST",
					url: url,
					data: data,
					headers: {'Content-type': 'application/x-www-form-urlencoded'},
					
				})
				.then(function(response){
					$http.get('allAccount').then(function(response){
						$scope.allAccount = response.data;
					})	
				})

				break;
			case "edit":
				var url = 'editAccount/'+ id;
				var data = $.param($scope.account);
				$http({
					method: "POST",
					url: url,
					data: data,
					headers: {'Content-type': 'application/x-www-form-urlencoded'},
				})
				.then(function(response){
					$http.get('allAccount').then(function(response){
						$scope.allAccount = response.data;
					})				
				})
				break;

			default: 
				break;


		}
		$('#myModal').modal('hide');	
	}
	$scope.filter_name = 0;
	$scope.group_filter = function(group_name){

		$scope.filter_name = group_name;
	}
});
app.filter('testing',function(){
	return function(item, filter_name){
		var filtered = [];
		if(filter_name === 0){
			return item;
		}
		for (var i = item.length - 1; i >= 0; i--) {
			for (var j = item[i].groups.length - 1; j >= 0; j--) {
				if(filter_name != 0 && filter_name == item[i].groups[j].name){
					filtered.push(item[i]);
					break;
				}
			}
		}
		return filtered;
		// if(filter_name != 0 && item.groups['name'] == filter_name){
		// 	return item;
		// }
	}
})