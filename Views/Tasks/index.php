<h1>Tasks</h1>
<div class="row">
    <div class="col centered">
        <a href="<?= WEBROOT ?>tasks/create/" class="btn btn-primary btn-xs pull-right" style="margin-bottom: 10px;"><b>+</b>
            Add new task</a>
        <table id="task-list" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th class="th-sm">Username</th>
                <th>Email</th>
                <th>Text</th>
                <th>Is Completed</th>
                <?php if (isset($_SESSION["admin_id"]) && $_SESSION["admin_id"]): ?>
                    <th class="text-center">Action</th>
                <?php endif; ?>
            </tr>
            </thead>
        </table>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		$('#task-list').DataTable({
			"lengthMenu": [[3, 5, 10, -1], [3, 5, 10, "All"]],
			"processing": true,
			"serverSide": true,
			"ajax": "<?=WEBROOT?>tasks/datatable/",
			"columns": [
				{"data": "id"},
				{"data": "username"},
				{"data": "email"},
				{"data": "text"},
				{
                    "data": "is_completed",
                    "render": function ( data, type, full, meta ) {
						return full.is_completed == 0 ? 'No' : 'Yes';
					}
                },
                <?php if (isset($_SESSION["admin_id"]) && $_SESSION["admin_id"]): ?>
                    {
                        sortable: false,
                        "render": function ( data, type, full, meta ) {
                            return '<a class="btn btn-info btn-xs" href="<?=WEBROOT?>tasks/edit/' + full.id + '"><span class="glyphicon glyphicon-edit"></span> Edit</a>' +
                                ' <a class="btn btn-danger btn-xs" href="<?=WEBROOT?>tasks/delete/' + full.id + '"><span class="glyphicon glyphicon-delete"></span> Delete</a>';
                        }
                    },
                <?php endif; ?>
			],
		});
	});
</script>