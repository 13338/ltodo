// Create task
function create() {
    var title = $('#title');
    $.ajax({
        url: '/tasks',
        type: 'POST',
        data: {title: title.val()},
    })
    .done(function(task) {
        $('#tasks_list').prepend(`
            <tr>
                <td>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck${task.id}">
                        <label class="custom-control-label" for="customCheck${task.id}" onclick="change(this)" data-id="${task.id}">${task.title}</label>
                        <a href="/tasks/${task.id}" class="float-right">View Task</a>
                        <span class="float-right">
                            <a href="/tasks/${task.id}">View Task</a>
                            <a href="#" onclick="delete(this)" data-id="${task.id}" class="text-danger ml-1">Delete</a>
                        </span>
                    </div>
                </td>
            </tr>
        `);
        title.removeClass('is-invalid');
    })
    .fail(function() {
        title.addClass('is-invalid');
    })
    .always(function() {
        title.val('');
    });
};
// Make task done/undone
function change(element) {
    var id = $(element).data('id');
    $.ajax({
        url: '/tasks/' + id,
        type: 'POST',
        data: {_method: 'PUT', done: 'change'},
    })
    .fail(function() {
        alert("error");
    });
    
};
// Delete task
function destroy(element) {
    $.ajax({
        url: $(element).data('url'),
        type: 'POST',
        data: {_method: 'delete'},
    })
    .done(function() {
        $(element).parents('tr').addClass('table-danger').fadeOut();
    })
    .fail(function() {
        alert("error");
    });
}