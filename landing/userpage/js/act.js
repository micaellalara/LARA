
$(document).ready(function () {
let activityCount = 0;
let activities = [];

function addActivityToTable(activity) {
activityCount++;
const newRow = `
    <tr>
        <th scope="row">${activityCount}</th>
        <td>${activity.name}</td>
        <td>${activity.location}</td>
        <td>${activity.time}</td>
        <td>${activity.date}</td>
        <td>${activity.ootd}</td>
        <td class="activity-status">${activity.status}</td>
        <td class="action-buttons">
            <button class="btn btn-primary btn-edit-activity">Edit</button>
            <select class="form-control action-select">
                <option value="Finish">Finish</option>
                <option value="Cancel">Cancel</option>
                <option value="Delete">Delete</option>
            </select>
        </td>
    </tr>
`;
$('#activity-list').append(newRow);
}

function updateActivityNumbers() {
$('#activity-list tr').each(function (index) {
    $(this).find('th:first').text(index + 1);
});
}

function updateLocalStorage() {
localStorage.setItem('activities', JSON.stringify(activities));
}
function sortActivitiesByDate() {
    activities.sort((a, b) => new Date(a.date) - new Date(b.date));
    updateLocalStorage();
}

function loadActivities() {
const storedActivities = localStorage.getItem('activities');
if (storedActivities) {
    activities = JSON.parse(storedActivities);
    activities.forEach(function (activity) {
        addActivityToTable(activity);
    });
    activityCount = activities.length;
    updateActivityNumbers();
}
}

loadActivities();

$('#add-activity-button').click(function () {
const activityName = $('#activity-name').val();
const activityLocation = $('#activity-location').val();
const activityTime = $('#activity-time').val();
const activityDate = $('#activity-date').val();
const activityOOTD = $('#activity-ootd').val();
const activityStatus = $('#activity-status').val();
const activity = {
    name: activityName,
    location: activityLocation,
    time: activityTime,
    date: activityDate,
    ootd: activityOOTD,
    status: activityStatus
};
activities.push(activity);
localStorage.setItem('activities', JSON.stringify(activities));
addActivityToTable(activity);
$('#activity-form')[0].reset();
$('#addActivityModal').modal('hide');
});

$('#activity-list').on('change', '.action-select', function () {
const selectedAction = $(this).val();
const row = $(this).closest('tr');
const statusCell = row.find('.activity-status');
const rowIndex = row.index();

if (selectedAction === 'Finish') {
    activities[rowIndex].status = 'Finished';
    statusCell.text('Finished');
} else if (selectedAction === 'Cancel') {
    activities[rowIndex].status = 'Canceled';
    statusCell.text('Canceled');
} else if (selectedAction === 'Delete') {
    activities.splice(rowIndex, 1);
    row.remove();
    activityCount--;
    updateActivityNumbers();
}
updateLocalStorage();
});

// Handle edit button click
$('#activity-list').on('click', '.btn-edit-activity', function () {
const row = $(this).closest('tr');
const rowIndex = row.index();
const activity = activities[rowIndex];
$('#edit-activity-index').val(rowIndex);
$('#edit-activity-name').val(activity.name);
$('#edit-activity-location').val(activity.location);
$('#edit-activity-time').val(activity.time);
$('#edit-activity-date').val(activity.date);
$('#edit-activity-ootd').val(activity.ootd);
$('#edit-activity-status').val(activity.status);
$('#editActivityModal').modal('show');
});

// Handle saving edited activity
$('#edit-activity-button').click(function () {
const index = $('#edit-activity-index').val();
const editedActivity = {
    name: $('#edit-activity-name').val(),
    location: $('#edit-activity-location').val(),
    time: $('#edit-activity-time').val(),
    date: $('#edit-activity-date').val(),
    ootd: $('#edit-activity-ootd').val(),
    status: $('#edit-activity-status').val()
};

activities[index] = editedActivity;
updateLocalStorage();

// Update the activity row in the table
const row = $('#activity-list tr').eq(parseInt(index) + 1);
row.find('td:eq(1)').text(editedActivity.name);
row.find('td:eq(2)').text(editedActivity.location);
row.find('td:eq(3)').text(editedActivity.time);
row.find('td:eq(4)').text(editedActivity.date);
row.find('td:eq(5)').text(editedActivity.ootd);
row.find('td:eq(6)').text(editedActivity.status);
$('#editActivityModal').modal('hide');
});
});
