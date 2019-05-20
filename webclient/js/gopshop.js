function initActions() {

    function deactiveAllMenu() {
        $(".footer").find("a").removeClass("active");
    }

    $(document).on("click", "#go_index_page", function () {
        $("#go_index_page").addClass("active");
        $("#go_index_page").show();
    });
}

function startGame() {
    console.log("startGame enter");

    console.log("USER_FB_ID : " + USER_FB_ID);
    console.log("USER_FB_NAME : " + USER_FB_NAME);
    console.log("USER_FB_PROPIC : " + USER_FB_PROPIC);

    initActions();

    var settings = {
        "async": true,
        "crossDomain": true,
        //"url": "https://codeimpact.dotlines.com.sg/test/gopshoptest.php",
        "url": "http://127.0.0.1:8000/ui/demo",
        "method": "POST",
        "headers": {
            "Apiname": "story_cat_list"
        }
    };

    $.ajax(settings).done(function (response) {
        console.log(response);
        $("#page_body").html(response);
    });

    // $.ajax({
    //     async: true,
    //     crossDomain: true,
    //     url: 'https://gopshopadmin.dotlines.com.sg/images/cash.png',
    //     cache: false,
    //     xhrFields: {
    //         responseType: 'blob'
    //     },
    //     success: function (data) {
    //         var img = document.getElementById('page_img');
    //         var url = window.URL || window.webkitURL;
    //         img.src = url.createObjectURL(data);
    //     },
    //     error: function (e) {
    //         console.log(e);
    //     }
    // });

}