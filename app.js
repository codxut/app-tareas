$(document).ready(function() {
	$('#task-result').hide();
	getTasksList();
	let edit = false;
	$('#search').keyup(function() {
		if ($('#search').val()) {
			let search = $('#search').val();
			/* metodo de jquery (ajax). */
			/* permite hacer una peticion al servidor */
			$.ajax({
				url: 'tareas-buscar.php',
				type: 'POST',
				data: {search},
				success: function(response) {
					/* convertir un objeto json en string a formato json */
					let tasks = JSON.parse(response);
					let template = '';
					tasks.forEach(task => {
						const {name, description, id} = task;
						template += `<li>
							${name}
						</li>`;
					});
					$('#container').html(template);
					$('#task-result').show();
				}
			});
		} else {
			$('#task-result').hide();
		}
	});

	$('#task-form').submit(function(e) {
		e.preventDefault();
		const data = {
			name: $('#name').val(),
			description: $('#description').val(),
			id: $('#taskId').val()
		};
		const url = edit === true ? 'tareas-edit.php' : 'tareas-añadir.php';
		console.log(url);
		$.post(url, data, function(response) {
			$('#task-form').trigger('reset');
			getTasksList();
		});
	});

	function getTasksList()
	{
		$.ajax({
			url: 'tareas-listar.php',
			type: 'GET',
			success: function(response) {
				let tasks = JSON.parse(response);
				let template = '';
				tasks.forEach(task => {
					const {id, name, description} = task;
					template += `
						<tr data-id="${id}">
							<td>
								<a href="#" class="task-edit">${id}</a>
							</td>
							<td>${name}</td>
							<td>${description}</td>
							<td>
								<button class="btn-delete btn btn-danger">
									Delete
								</button>
							</td>
						</tr>	
					`;
				});
				$('#task-list').html(template);
			}
		});
	}

	$(document).on('click', '.btn-delete', function() {
		if (confirm("¿Estas seguro de eliminar la tarea?")) {
			let element = $(this)[0].parentElement.parentElement;
			const id = $(element).attr('data-id');
			$.post('tareas-borrar.php', {id}, function(response) {
				getTasksList();
			});
		}
	});

	$(document).on('click', '.task-edit', function() {
		let element = $(this)[0];
		let id = element.textContent;
		$.post('tareas-fila.php', {id}, function(response) {
			const tarea = JSON.parse(response);
			$('#name').val(tarea.name);
			$('#description').val(tarea.description);
			$('#taskId').val(id);
			edit = true;
		});
	});
});