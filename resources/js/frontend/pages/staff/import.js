const ImportStudent = (function () {
    let modules = {};

    modules.exportToTable = (fileInput) => {
        actions.showLoading();

        $('#excelTable').html('');
        const errorFile = $('.error-file');

        /* Check if the file is excel */
        const regex = /^([a-zA-Z0-9\s_!()\\.\-:])+(.xlsx|.xls)$/;
        let labelText = fileInput.next('label').find('span');

        if (regex.test(fileInput.val().toLowerCase())) {
            /* Change input file name */
            errorFile.addClass('d-none');

            const fileName = fileInput.val().split('\\').pop();
            if (fileName) {
                labelText.text(fileName);
            } else {
                labelText.text('');
            }

            /* Flag for checking whether Excel is .xls format or .xlsx format */
            let xlsxFlag = false;
            if (fileInput.val().trim().toLowerCase().indexOf(".xlsx") > 0) {
                xlsxFlag = true;
            }

            if (typeof (FileReader) != "undefined") {
                const reader = new FileReader();
                reader.onload = function (e) {
                    let workBook;
                    const data = e.target.result;

                    /* Converts the Excel data in to object */
                    if (xlsxFlag) {
                        workBook = XLSX.read(data, {type: 'binary', cellDates: true});
                    } else {
                        workBook = XLS.read(data, {type: 'binary', cellDates: true});
                    }
                    /* Gets all the sheetNames of Excel in to a variable */
                    const sheet_name_list = workBook.SheetNames;

                    let cnt = 0; /* This is used for restricting the script to consider only first sheet of Excel */
                    sheet_name_list.forEach(function (y) {
                        let excelJson;
                        /* Convert the cell value to Json */
                        if (xlsxFlag) {
                            excelJson = XLSX.utils.sheet_to_json(workBook.Sheets[y]);
                        } else {
                            excelJson = XLS.utils.sheet_to_row_object_array(workBook.Sheets[y]);
                        }
                        if (excelJson.length > 0 && cnt === 0) {
                            let checkEmails = [];
                            for (let i = 0; i < excelJson.length; i++) {
                                let emailData = excelJson[i]['Email']
                                if (emailData !== '' || emailData !== undefined) {
                                    checkEmails.push(emailData);
                                }
                            }
                            actions.ajaxCall({
                                url: fileInput.data('check-student-url'),
                                data: {
                                    checkEmails: checkEmails
                                },
                                type: constants.METHOD_POST
                            }).then(function (data) {
                                const existEmails = data.data
                                modules.bindTable(excelJson, existEmails, '#excelTable');
                                cnt++;
                            });
                        }
                    });

                    setTimeout(function () {
                        actions.hideLoading();
                        $('.import-data').removeClass('d-none')
                        $('#step-btn-2').addClass('done')
                        $('#collapseTwo').collapse('show')
                        $('#collapseOne').collapse('hide')
                        $('#excelTable').show();
                    }, 1000);
                }
                if (xlsxFlag) {
                    /* If Excel file is .xlsx extension than creates an Array Buffer from Excel */
                    reader.readAsArrayBuffer(fileInput[0].files[0]);
                } else {
                    reader.readAsBinaryString(fileInput[0].files[0]);
                }
            } else {
                actions.hideLoading();
                errorFile.removeClass('d-none').text(errorHTML5)
            }
        } else {
            actions.hideLoading();
            $('.import-data').addClass('d-none')
            $('#step-btn-2').removeClass('done')
            $('#collapseOne').collapse('show')
            $('#collapseTwo').collapse('hide')
            labelText.text('');
            errorFile.removeClass('d-none').text(errorTypeExcel)
        }
    }

    modules.bindTable = (jsonData, existEmails, tableId) => {
        const columns = modules.bindTableHeader(jsonData, tableId);
        for (let i = 0; i < jsonData.length; i++) {
            const tBody = $('<tbody/>');
            const row$ = $('<tr/>');
            const emailExisted = $.inArray(jsonData[i]['Email'], existEmails) !== -1
            for (let colIndex = 0; colIndex < columns.length; colIndex++) {
                let cellValue = jsonData[i][columns[colIndex]];
                if (cellValue == null)
                    cellValue = "";
                if (columns[colIndex] === 'Birthday') {
                    cellValue = window.moment(cellValue).add(1, 'days').format('YYYY-MM-DD')
                } else if (columns[colIndex] === 'Email' && emailExisted) {
                    cellValue += `<i class="fa-solid fa-triangle-exclamation ml-2"></i>`
                }
                row$.append($('<td/>').html(cellValue));
                tBody.append(row$);
            }
            $(tableId).append(tBody);
        }
    }

    modules.bindTableHeader = (jsonData, tableId) => {
        const columnSet = [];
        const tHead = $('<thead class="bg-header-table" />');
        const headerTr$ = $('<tr/>');
        for (let i = 0; i < jsonData.length; i++) {
            const rowHash = jsonData[i];
            for (const key in rowHash) {
                if (rowHash.hasOwnProperty(key)) {
                    if ($.inArray(key, columnSet) === -1) {
                        columnSet.push(key);
                        headerTr$.append($('<th/>').html(key));
                        tHead.append(headerTr$)
                    }
                }
            }
        }
        $(tableId).append(tHead);
        return columnSet;
    }

    return modules;
}(window.jQuery, window, document))

$(function () {
    $('#file-student').on('change', function () {
        ImportStudent.exportToTable($(this));
    })
})