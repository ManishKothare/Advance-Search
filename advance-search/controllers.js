'use strict';

/* Controllers */

var mywppApp = angular.module('WPPApp', []);

mywppApp.controller('WPPListCtrl', ['$scope', '$http', function($scope, $http) {
  $http.get('json-file.php').success(function(data) {
    $scope.products = data;
    
    
	//Horsepower filter
	$scope.horsepowerFilter = function(product) {
	  var ret = true;
		if($scope.minHorsepower && $scope.maxHorsepower){
		  
			    if($scope.minHorsepower && $scope.minHorsepower > product.hp) {
			      ret = false;
			    }

			    if($scope.maxHorsepower && $scope.maxHorsepower < product.hp) {
			      ret = false;
			    }
			    
		}else{
		  
			    if($scope.minHorsepower && $scope.minHorsepower > product.hp-1) {
			      ret = false;
			    }
			    
			    if($scope.maxHorsepower && $scope.maxHorsepower < product.hp+1) {
			      ret = false;
			    }	    
			    
			   
		}

	  return ret;
	};
	
	
	//KVA filter
	$scope.kvaFilter = function(product) {
	  var ret = true;
	  
	  
	  if($scope.minkva && $scope.maxkva){	  

		      if($scope.minkva && $scope.minkva > product.ratinginkva) {
			ret = false;
		      }

		      if($scope.maxkva && $scope.maxkva < product.ratinginkva) {
			ret = false;
		      }
	  }else{
	    
		      if($scope.minkva && $scope.minkva > product.ratinginkva-1) {
			ret = false;
		      }
		      
		      if($scope.maxkva && $scope.maxkva < product.ratinginkva+1) {
			      ret = false;
		      }
	    
	    
	  } 
	  
	  

	  return ret;
	};
	
	//KW filter
	$scope.kwFilter = function(product) {
	  var ret = true;
	  
	  
	  if($scope.minkw && $scope.maxkw){	  

			if($scope.minkw && $scope.minkw > product.ratinginkw) {
			  ret = false;
			}

			if($scope.maxkw && $scope.maxkw < product.ratinginkw) {
			  ret = false;
			}
			
	  }else{
			if($scope.minkw && $scope.minkw > product.ratinginkw-1) {
			  ret = false;
			}
			
			if($scope.maxkw && $scope.maxkw < product.ratinginkw+1) {
			      ret = false;
		      }
	  }

	  return ret;
	};
	
	//RPM filter
	$scope.rpmFilter = function(product) {
	var ret = true;	  
	  
	  if($scope.minrpm && $scope.maxrpm){	  

			if($scope.minrpm && $scope.minrpm > product.rpm) {
			  ret = false;
			}

			if($scope.maxrpm && $scope.maxrpm < product.rpm) {
			  ret = false;
			}
			
	  }else{
			if($scope.minrpm && $scope.minrpm > product.rpm-1) {
			  ret = false;
			}
			
			if($scope.maxrpm && $scope.maxrpm < product.rpm+1) {
			      ret = false;
		      }
	  }
	  return ret;
	};
    
    
    
    
  });  
}]);