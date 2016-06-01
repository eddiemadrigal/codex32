var myApp = angular.module("myApp", []);

var ctrlFunction = function($scope, $http) {  // $http is a service used as a dependency
  $http({
    method : "GET",
    url : "Bible.json"
  })
  .success(function (data) {
    console.log("Success!");
    $scope.Bible = data;
  })
  .error(function (data) {
    console.log(data);
  });
};

myApp.controller("myController", ctrlFunction);
