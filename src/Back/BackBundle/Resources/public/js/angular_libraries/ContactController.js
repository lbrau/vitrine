wallMod.controller('ContactController', function($scope, $http) {
    $scope.itemCommon = false;
    $scope.itemPro = false;

    // ==== Gere l'affichage de la page ====
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

    // ==== Format le numero de telephone ====
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

    // ==== Gere le bouton de suppression du numero de telephone ====
    $scope.deletePhone = function() {
        $scope.phone = "";
        $scope.deleteBtn = false;
    }

    // ==== Vérifie le format du fichier upload avant la soumission du form ====
    $scope.checkValidationFile = function() {
        var data = [];
        $http.post('http://myscope.local/app_dev.php/uploadedFileChecker', data)
            .then(
            function($event,$scope) {
                console.log('ok');
                $event.preventDefault();
            },
            function($event){console.log('failed')}
        );
        //unsubmit($event);
    }

    $scope.test = function(element){
        console.log(element.files);
        console.log(element.files[0].type);
        console.log(element.files[0].size);
        console.log(element.files.length);
        console.log(element.files[0].name);
        var data = [element.files[0].type, element.files[0].size,element.files[0].name];
        $http.post('http://myscope.local/app_dev.php/uploadedFileChecker', data)
            .success(function(){console.log('ajax file ok')})
            .error(function(){console.log('error ajax file')});
    };

    // ==== Empeche la soumission du formulaire ====
    $scope.unsubmit = function($event) {
        $event.preventDefault();
    }

});
