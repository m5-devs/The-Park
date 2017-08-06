var directoryApp = angular.module('directoryApp', ['ngMaterial','ngRoute'])
	.config(function($routeProvider) {
		$routeProvider
			.when('/', {
                templateUrl : 'partials/main.html'
                //controller  : ''
			})
			.otherwise ({
				templateUrl: ''
			});
	})
	.controller('navController', function($scope, $mdSidenav) {
		$scope.openLeftNav = function() {
			$mdSidenav('left').toggle();
		}
	})
	.controller('main', function($scope) {
		$scope.people = [
			{
				name: 'Alex',
				email: 'alexwohlbruck@gmail.com',
				age: 15
			},
			{
				name: 'Kasimir',
				email: 'kasimirkhschulz@gmail.com',
				age: 15
			},
			{
				name: 'Jane',
				email: 'jnblottman@gmail.com',
				age: 16
			},
		]
	})
;