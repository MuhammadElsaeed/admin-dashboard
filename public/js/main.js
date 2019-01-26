$(document).ready(function () {
    $('.datatable').DataTable({
        responsive: true
    });
});

function validateClient() {
    var form = document.clientForm;
    var errors = false;
    if (!form.phone.value.match(/\d{3}-\d{3}-\d{4}|\d{10}/)) {
        $('#phoneError').text("please enter a valid phone number");
        errors = true;
    } else {
        $('#phoneError').text("");

    }
    var startDate = new Date(form.contractStartDate.value);
    var endDate = new Date(form.contractEndDate.value);
    if (startDate.getTime() > endDate.getTime()) {
        $('#dateError').text("Contract end date can not be before contract start date");
        errors = true;
    } else {
        $('#dateError').text("");
    }

    if ($('div.checkbox-group.required :checkbox:checked').length <= 0) {
        $('#servicesError').text("Please select one service at least");
        errors = true;

    } else {
        $('#servicesError').text("");

    }
    return !errors;
}
function validateService(ev) {
    var form = ev.target;
    var errors = false;
    if (!form.link.value.match(/https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/)) {
        $('#linkError').text("please enter a valid link");
        errors = true;
    } else {
        $('#linkError').text("");
    }

    return !errors;
}