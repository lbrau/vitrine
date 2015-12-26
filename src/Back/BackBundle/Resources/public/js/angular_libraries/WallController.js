wallMod.controller('WallController', function($scope, $http){
    $scope.sendCommentary = function($this) {
        //console.log('comment sent--');
        //console.log($scope.authorCommentary);
        //console.log('sonde article id--');
        //console.log($this);
        //console.log($this.closest('.article_id').val());
        $scope.article_id = 0;
        console.log('sonde');
        console.log($(this).closest('.article_id'));

        var data = {
            "article_id": 1,
            "author_commentary": $scope.authorCommentary,
            "commentary": $scope.commentaryAreaField
        };

        $http.post('http://myscope.local/app_dev.php/commentarySent', data)
            .then(
            function(e){console.log('ok');},
            function(e){console.log('failed')}
        );
    }

    $scope.unsubmit = function($event) {
        $event.preventDefault();
    }
});
