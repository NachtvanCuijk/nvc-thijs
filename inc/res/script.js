$(document).ready(function() {
    var pressed = true;
    $("#content").css({"min-height": $(window).height() - 100});
    // The navbar becomes fixed after scrolling some pixels
    $(window).scroll(function() {
        if ($(window).scrollTop() > 250) {
            $("#navigation").addClass("navbar-fixed-top");
        } else {
            $("#navigation").removeClass("navbar-fixed-top");
        }
    });
    // The combination to open the login box
    // Ctrl + B is the combo
    // a nice animation though
    if (window.location.href.indexOf("post") === -1) {
        $(document).on("keydown", function(e) {
            var loginDiv = $(".loginDiv");
            if ( (e.ctrlKey || e.metaKey) && ( String.fromCharCode(e.which) === 'b' || String.fromCharCode(e.which) === 'B')) {
                e.preventDefault();
                if (pressed) {
                    pressed = !pressed;
                    $(".loginDiv, .niceWhite").css("display", "block");
                    loginDiv.addClass("animated bounceIn");
                    loginDiv.draggable();
                    $(".daUser").focus();
                } else {
                    pressed = !pressed;
                    loginDiv.removeClass("bounceIn").addClass("bounceOut");
                    setTimeout(function() {
                        $(".loginDiv, .niceWhite").css("display","none");
                        $(".loginDiv").removeClass("bounceOut");
                    }, 700);
                }
            }
        });
    } else {
        $("#preview").click(function () {
            $(".niceWhite, #previewDiv").css("display", "block");
            $("#prevHeader").html("<h1>" + $("#pTitle").val() + "</h1>");
            $("#prevBody").html($("#pBody").val());
        });
        $("#closePrev").click(function() {
            $(".niceWhite, #previewDiv").removeAttr("style");
        });
    }
    // commented for personal purposes
    $("#banner").parallax({imageSrc: 'inc/res/banner.jpg'});
    // verify login, if isnt valid, give a nice message
    $(".daSub").click(function(e) {
        e.preventDefault();
        e.stopPropagation();
        $("#message").html("&nbsp;");
        $.ajax({
            url:'check.php',
            async: true,
            type: 'POST',
            data: {
                user: $(".daUser").val(),
                pass: $(".daPass").val()
            },
            success: function(data) {
                if (data == "true") {
                    $("#message").html("Welcome!").addClass("success");
                    location.reload();
                } else {
                    $("#message").html("Please try again").addClass("error");
                }
            }
        });
    });
    $(".post").hover(function() {
        $(".buttons", this).css("display", "block");
    },function() {
        $(".buttons", this).removeAttr("style");
    });
    $(".buttons #edit").click(function() {
        // alert($(this).closest(".post").children("#postid").val());
        // window.location.href = "http://stackoverflow.com";
        var currentLink = window.location.href,
            sanLink = currentLink.replace(/index.php/g, '');
        window.location.href = sanLink + "post.php?mode=edit&id=" + $(this).closest(".post").children("#postid").val();
    });
    $(".buttons #delete").click(function() {
        var answer = confirm("Are you sure?");
        if (answer) {
            $.ajax({
                url:'post.php',
                async: true,
                type: 'GET',
                data: {
                    mode: 'delete',
                    id: $(this).closest(".post").children("#postid").val()
                },
                success: function(data) {
                    location.reload();
                }
            })
        }
    });
    $(".link").hover(function() {
        $(this).animate({
            "background-color": "#4b4b4b",
            "border-bottom": "3px solid #fff"
        }, "fast");
    }, function() {
        $(this).animate({
            "background-color": "#2d2d2d",
            "border-bottom": "3px solid #2d2d2d"
        }, "fast");
    });
});
