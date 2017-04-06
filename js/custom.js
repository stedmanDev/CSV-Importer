$(document).ready(function() {
    $('#upload_csv').on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: "process.php",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data == 'Error1') {
                    alert("Invalid File");
                } else if (data == "Error2") {
                    alert("Please Select File");
                } else {

                    var csvFileName = data.substr(data.indexOf("Dateiname:") + 10);
                    var removeCSVFileName = data.substr(data.indexOf("Dateiname:"));

                    var newData = data.replace(removeCSVFileName, '');
                    var theDate = new Date(Date.now());
                    var theTime = theDate.getHours() + "" + theDate.getMinutes() + "" + theDate.getSeconds();

                    csvData = 'data:application/csv;charset=UTF-8,%EF%BB%BF' + encodeURIComponent(newData);

                    //$('.csvimporter__output').html(data);

                    /*
                    //var trHTML = '';
                    console.log(data);
                    var array = $.makeArray(data);
                    console.log(array);
                    for (i = 0; i < array.length; i++) {
                        trHTML += '<tr><td>' + array[i] + '</td><td>';
                    }
                    $('.csvimporter__output').append(trHTML);
                    */

                    $(".button__download--link").attr({
                        "href": csvData,
                        "download": "CSV-Export-" + theTime + "-" + csvFileName.slice(0, -1)
                    });

                }
            }
        })
    });
});