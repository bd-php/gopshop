function init() {
    FBInstant.initializeAsync()
        .then(function () {
            // Start loading game assets here
            console.log("FBInstant.initializeAsync complete");
            // Finished loading. Start the game
            FBInstant.startGameAsync().then(function () {
                console.log("FBInstant.startGameAsync complete");
                info();
                start();
            });

        });
}

function start() {
    FBInstant.startGameAsync().then(function () {
        console.log("FBInstant.startGameAsync complete");
        console.log("FBInstant.startGameAsync context : " + FBInstant.context.getID());
        startGame();
    });
}

function invite() {
//        FBInstant.context.chooseAsync()
//                .then(function() {
//                    console.log("FBInstant.context.chooseAsync complete");
//                    info();
//                });
    FBInstant.context.chooseAsync({
        maxSize: 2
    }).catch(function (e) {
        console.log("FBInstant.context.chooseAsync error");
        console.log(e);
    }).then(function (e) {
        console.log("FBInstant.context.chooseAsync complete");
        console.log(e);
        info();
    });

//        FB.ui({method: 'apprequests',
//            message: 'Invite Play Demo'
//        }, function(response){
//            console.log(response);
//            info();
//        });
}

function info() {

    console.log("FBInstant.context.getType() : " + FBInstant.context.getType());
    console.log("FBInstant.context.getID() : " + FBInstant.context.getID()); //will be null if game is being played in a solo context
    USER_FB_ID = FBInstant.player.getID();
    console.log("FBInstant.player.getID() : " + USER_FB_ID);

    USER_FB_NAME = FBInstant.player.getName();
    console.log("FBInstant.player.getName() : " + USER_FB_NAME);

    USER_FB_PROPIC = FBInstant.player.getPhoto();
    console.log("FBInstant.player.getPhoto() : " + USER_FB_PROPIC);

}