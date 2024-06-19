    $(document).ready(function () {
        $("#livesearch").keyup(function () {
            var input = $(this).val();
            if (input != "") {
                $.ajax({
                    url: "search_result.php",
                    method: "POST",
                    data: {
                        input: input
                    },

                    success: function (data) {
                        $("#searchresult").html(data);
                    }
                });
            } else {
                $("#searchresult").css("display", "none");
            }

        });
    });