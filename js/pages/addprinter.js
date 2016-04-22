$(document).ready(function () {

    $("#add-material-button").click(function () {
        // First, get the next value incremental value of the materials index
        var matID = $("#form-section-materials .section .input-wrapper:nth-last-child(2)").find("select").attr("id");
        var index = matID.substring(matID.indexOf("[")+1, matID.indexOf("]"));
        index++; // This will add one to the index, and convert it to an int
        $.post("ajax/addmaterialinput", {
            index: index
        }, function(data) {
            // Add the new material to the screen
            var materialHTML = $.parseHTML(data);

            $(materialHTML).insertBefore($("#add-material-button").parent());
        });
    });
});
