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
    @if($errors->any())
       <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <div class="container mt-5">
        <h2 class="mb-4">Add Product</h2>
        <form action="{{ route('products.edit', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="productName" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="productName" name="product_name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="productCode" class="form-label">Product Code</label>
                    <input type="text" class="form-control" id="productCode" name="product_code" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select" id="category" name="category_id" required>
                        <option value="" disabled selected>Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="productPrice" class="form-label">Product Price</label>
                    <input type="number" class="form-control" id="productPrice" name="product_price" step="0.01" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="productDiscount" class="form-label">Product Discount</label>
                    <input type="number" class="form-control" id="productDiscount" name="product_discount" step="0.01">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="productWeight" class="form-label">Product Weight (kg)</label>
                    <input type="number" class="form-control" id="productWeight" name="product_weight" step="0.01" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mainImage" class="form-label">Main Image</label>
                    <input type="file" class="form-control" id="mainImage" name="main_image" accept="image/*" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="additionalImages" class="form-label">Additional Images</label>
                    <input type="file" class="form-control" id="additionalImages" name="additional_images[]" multiple accept="image/*">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="metaTitle" class="form-label">Meta Title</label>
                    <input type="text" class="form-control" id="metaTitle" name="meta_title">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="metaDescription" class="form-label">Meta Description</label>
                    <textarea class="form-control" id="metaDescription" name="meta_description" rows="2"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="metaKeywords" class="form-label">Meta Keywords</label>
                    <input type="text" class="form-control" id="metaKeywords" name="meta_keywords">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="isFeatured" class="form-check-label">Featured Product</label>
                    <input type="checkbox" class="form-check-input" value="1" id="isFeatured" name="is_featured">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="" disabled selected>Select Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
            </div>
        </form>
    </div>
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