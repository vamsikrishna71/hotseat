$("#export").on("click", () => exportTasks(event.target));

function exportTasks(_this) {
    let _url = $(_this).data("href");
    window.location.href = _url;
}

$("#deleteItem").on("show.bs.modal", function(event) {
    $('#deleteItem input[name="employeeId"]').val(
        $(event.relatedTarget).data("id")
    );
});