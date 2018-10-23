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
                        <span class="float-right">
                            <a href="/tasks/${task.slug}">View Task</a>
                            <a href="#" onclick="destroy(this)" data-url="/tasks/${task.id}" class="text-danger ml-1">Delete</a>
                        </span>
                    </div>
                </td>
            </tr>
        `);
        title.removeClass('is-invalid');
        $('.empty').hide();
    })
    .fail(function() {
        title.addClass('is-invalid');
    })
    .always(function() {
        title.val('');
    });
};
// Create task Enter
var cTask = document.getElementById('create');
if (cTask) {
    cTask.addEventListener('keyup', function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            create();
        }
    });
}
// Create subtask
function createSubTask() {
    var title = $('#title');
    $.ajax({
        url: '/subTasks',
        type: 'POST',
        data: {title: title.val(), task_id: title.data('task')},
    })
    .done(function(subtask) {
        $('#subtasks_list').append(`
            <tr>
                <td>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck${subtask.id}">
                        <label class="custom-control-label" for="customCheck${subtask.id}" onclick="change(this)" data-url="/subTasks/${subtask.id}">${subtask.title}</label>
                        <span class="float-right">
                            <a href="#" onclick="destroy(this)" data-url="/subTasks/${subtask.id}" class="text-danger ml-1">Delete</a>
                        </span>
                    </div>
                </td>
            </tr>
        `);
        title.removeClass('is-invalid');
        $('.empty').hide();
    })
    .fail(function() {
        title.addClass('is-invalid');
    })
    .always(function() {
        title.val('');
    });
};
// Create subtask Enter
var cSubTask = document.getElementById('createSubTask');
if (cSubTask) {
    cSubTask.addEventListener('keyup', function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            createSubTask();
        }
    });
}
// Make task done/undone
function change(element) {
    $.ajax({
        url: $(element).data('url'),
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