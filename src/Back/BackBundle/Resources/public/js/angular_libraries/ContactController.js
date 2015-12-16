wallMod.controller('ContactController', function($scope) {
    $scope.itemCommon = false;
    $scope.itemPro = false;
    $scope.display = function() {
        if($scope.profilChoice == 'pro') {
            $scope.labelNom = "";
            $scope.itemCommon = true;
            $scope.itemPro = true;
            $scope.labelNom = "Comment dois-je vous appeler ?";
        } else if ($scope.profilChoice == 'perso') {
            $scope.itemCommon = true;
        }else {
            $scope.itemCommon = false;
            $scope.itemPro = false;
        }
    }
    $scope.unsubmit = function($event) {
        $event.preventDefault();
    }
});
