$(document).ready(function () {
    // First, get the client token
    var clientToken = $.cookie("client_token");
    
    console.log(clientToken);
    
    // Initiate the braintree setup
    braintree.setup(clientToken, "custom", {
        id: "addprinter",
        hostedFields: {
            number: {
                selector: "#card-number",
                placeholder: "4111 1111 1111 1111"
            },
            cvv: {
                selector: "#cvv",
                placeholder: "555"
            },
            expirationDate: {
                selector: "#expiration-date",
                placeholder: "MM/YYYY"
            },
            
            styles: {
                "input": {
                    "font-size": "16px",
                    "color": "#3A3A3A",
                    "font-family": "sans-serif",
                    "font-weight": "bold"
                }
            },
            
            onFieldEvent: function (event) {
                if (event.isValid) {
                }
            }
        }
    });
    
    // Deal with click events
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
