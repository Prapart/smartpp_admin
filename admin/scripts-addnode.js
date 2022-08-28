$('#node').change(function() {

var nodeID = $(this).val();

if (nodeID) {

    $.ajax({
        type: "POST",
        url: "functions.php",
        data: {
            node_id: nodeID,
            type: "get_models"
        },
        success: function(res) {
            var data = JSON.parse(res);
            if (res) {

                $("#model").empty();
                $("#model").append('<option>Select Model</option>');
                $.each(data.data, function(key, value) {
                    $("#model").append('<option value="' + value.id + '">' + value.name +
                        '</option>');
                });

            } else {

                $("#model").empty();
            }
        }
    });
} else {

    $("#model").empty();
    // $("#city").empty();
}
});
