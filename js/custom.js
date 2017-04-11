$(document).ready(function() {

    var isAdvancedUpload = function() {
        var div = document.createElement('div');
        return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
    }();

    var $form = $('.box'),
        $input = $form.find('input[type="file"]'),
        $label = $form.find('label'),
        $errorMsg = $form.find('.box__error span'),
        $restart = $form.find('.box__restart'),
        droppedFiles = false,
        showFiles = function(files) {
            $label.text(files.length > 1 ? ($input.attr('data-multiple-caption') || '').replace('{count}', files.length) : files[0].name);
        };

    // letting the server side to know we are going to make an Ajax request
    $form.append('<input type="hidden" name="ajax" value="1" />');

    if (isAdvancedUpload) {

        $form
            .addClass('has-advanced-upload')
            .on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
                // preventing the unwanted behaviours
                e.preventDefault();
                e.stopPropagation();
            })
            .on('dragover dragenter', function() {
                $form.addClass('is-dragover');
            })
            .on('dragleave dragend drop', function() {
                $form.removeClass('is-dragover');
            })
            .on('drop', function(e) {
                droppedFiles = e.originalEvent.dataTransfer.files;
                showFiles(droppedFiles);
            });

    }

    $form.on("submit", function(e) {

        if ($form.hasClass('is-uploading')) return false;

        $form.addClass('is-uploading').removeClass('is-error');

        if (isAdvancedUpload) {
            // ajax for modern browsers
            e.preventDefault();

            var ajaxData = new FormData($form.get(0));

            if (droppedFiles) {
                $.each(droppedFiles, function(i, file) {
                    ajaxData.append($input.attr('name'), file);
                });
            }

            $.ajax({
                url: "process.php",
                type: $form.attr('method'),
                data: ajaxData,
                contentType: false,
                cache: false,
                processData: false,
                complete: function() {
                    $form.removeClass('is-uploading');
                },
                success: function(data) {

                    $form.addClass(data.success == true ? 'is-success' : 'is-error');
                    if (!data.success) $errorMsg.text(data.error);

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

                    $(".box__download--link").attr({
                        "href": csvData,
                        "download": "CSV-Export-" + theTime + "-" + csvFileName.slice(0, -1)
                    });


                },
                error: function() {
                    alert('Error. Please, contact the webmaster!');
                }
            })


        } else {
            var iframeName = 'uploadiframe' + new Date().getTime(),
                $iframe = $('<iframe name="' + iframeName + '" style="display: none;"></iframe>');

            $('body').append($iframe);
            $form.attr('target', iframeName);

            $iframe.one('load', function() {
                var data = $.parseJSON($iframe.contents().find('body').text());
                $form.removeClass('is-uploading').addClass(data.success == true ? 'is-success' : 'is-error').removeAttr('target');
                if (!data.success) $errorMsg.text(data.error);
                $iframe.remove();
            });
        }
    });
});