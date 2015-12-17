wallMod.controller('ContactController', function($scope) {
    $scope.itemCommon = false;
    $scope.itemPro = false;
    // ---- Gere l'affichage de la page ----
    $scope.display = function() {
        if($scope.profilChoice == 'pro') {
            $scope.labelNom = "";
            $scope.itemCommon = true;
            $scope.itemPro = true;
            $scope.labelNom = "Comment dois-je vous appeler ?";
        } else if ($scope.profilChoice == 'perso') {
            $scope.itemCommon = true;
            $scope.itemFriend = true;
            $scope.itemPro = false;
        }else {
            $scope.itemCommon = true;
            $scope.itemPro = false;
        }
    }
    // ---- Format le numero de telephone ----
    $scope.formatNum = function() {
        if ($scope.phone.replace(/ /g,"").length % 2 == 0 &&
            $scope.phone.length <= 14) {
            $scope.phone += ' ';
            $scope.deleteBtn = true;
        }

        if ($scope.phone.replace(/ /g,"").length == 0) {
            $scope.deleteBtn = false;
        }
    }
    // ---- Gere le bouton de suppression du numero de telephone ----
    $scope.deletePhone = function() {
        $scope.phone = "";
        $scope.deleteBtn = false;
    }
    // ---- Empeche la soumission du formulaire ----
    $scope.unsubmit = function($event) {
        $event.preventDefault();
    }
});
