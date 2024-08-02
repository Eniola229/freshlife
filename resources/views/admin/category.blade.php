<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/charts-chartjs.html" />

	<title>Product | FreshLifeWater</title>

	<link href="css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

    <style>
        .search-bar {
            margin-bottom: 20px;
        }
        .pagination-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
    </style>

<body>
	<div class="wrapper">
		@include('components.admin_sidenav')

		<div class="main">
			@include('components.header')
	</nav>

	<main class="content">		
        <div class="container">
            <h1>Add New Category</h1>

            <!-- Display validation errors -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Category form -->
            <form action="{{ route('category.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="categoryName" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="categoryName" name="name" value="{{ old('name') }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Category</button>
            </form>
        </div>

         <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th> Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="productTableBody">
            @foreach($categories as $category)
                <tr>
                    <td>1</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="#" class="btn btn-info btn-sm">Edit</a>
                        <form style="display: inline-block;" action="{{ route('category.delete', $category->id) }}" method="POST">
                        	@csrf
                        	@method('DELETE')
                        	<button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

	</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<!-- <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> - <a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>Bootstrap Admin Template</strong></a>								&copy; -->
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="js/app.js"></script>
 <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            var searchTerm = this.value.toLowerCase();
            var rows = document.querySelectorAll('#productTableBody tr');
            
            rows.forEach(function(row) {
                var cells = row.querySelectorAll('td');
                var found = Array.from(cells).some(function(cell) {
                    return cell.textContent.toLowerCase().includes(searchTerm);
                });
                row.style.display = found ? '' : 'none';
            });
        });
    </script> <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            var searchTerm = this.value.toLowerCase();
            var rows = document.querySelectorAll('#productTableBody tr');
            
            rows.forEach(function(row) {
                var cells = row.querySelectorAll('td');
                var found = Array.from(cells).some(function(cell) {
                    return cell.textContent.toLowerCase().includes(searchTerm);
                });
                row.style.display = found ? '' : 'none';
            });
        });
    </script>

</body>

</html>