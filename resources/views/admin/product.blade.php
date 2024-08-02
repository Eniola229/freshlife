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
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif		
	<div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-4">Products</h1>
            <div class="row">
               <div class="col">
                    <a href="{{ url('categories') }}" class="btn btn-primary mb-4">Add Category</a>
                </div>
                <div class="col">
                    <a href="{{ url('addProduct') }}" class="btn btn-primary mb-4">Add Product</a>
                </div>
            </div>
        </div>
        
        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" id="searchInput" class="form-control" placeholder="Search products...">
        </div>

        <!-- Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Image</th>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="productTableBody">
          @foreach($products as $product)
            <tr>
                <td>1</td>
                <td><img src="{{ $product->main_image }}" width="50" height="50" class="img-thumbnail" alt="..."></td>
                <td>{{ $product->product_name }}</td>
                <td>N{{ $product->product_price }}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $product->id }}">Edit</button>
                    <form style="display: inline-block;" action="{{ route('product.delete', $product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            <!-- Modal -->
            <div class="modal fade" id="editModal{{ $product->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editModalLabel{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="editModalLabel{{ $product->id }}">Edit Product</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="productName{{ $product->id }}" class="form-label">Product Name</label>
                                        <input type="text" value="{{ $product->product_name }}" class="form-control" id="productName{{ $product->id }}" name="product_name" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="productCode{{ $product->id }}" class="form-label">Product Code</label>
                                        <input type="text" value="{{ $product->product_code }}" class="form-control" id="productCode{{ $product->id }}" name="product_code" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="category{{ $product->id }}" class="form-label">Category</label>
                                        <select class="form-select" id="category{{ $product->id }}" name="category_id" required>
                                            <option value="" disabled selected>Select Category</option>
                                            @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="productPrice{{ $product->id }}" class="form-label">Product Price</label>
                                        <input type="number" value="{{ $product->product_price }}" class="form-control" id="productPrice{{ $product->id }}" name="product_price" step="0.01" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="productDiscount{{ $product->id }}" class="form-label">Product Discount</label>
                                        <input type="number" class="form-control" value="{{ $product->product_discount }}" id="productDiscount{{ $product->id }}" name="product_discount" step="0.01">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="productWeight{{ $product->id }}" class="form-label">Product Weight (kg)</label>
                                        <input type="number" class="form-control" value="{{ $product->product_weight }}" id="productWeight{{ $product->id }}" name="product_weight" step="0.01" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="mainImage{{ $product->id }}" class="form-label">Main Image</label>
                                        <input type="file" class="form-control" id="mainImage{{ $product->id }}" name="main_image" accept="image/*">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="additionalImages{{ $product->id }}" class="form-label">Additional Images</label>
                                        <input type="file" class="form-control" id="additionalImages{{ $product->id }}" name="additional_images[]" multiple accept="image/*">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="description{{ $product->id }}" class="form-label">Description</label>
                                        <textarea class="form-control" id="description{{ $product->id }}" name="description" rows="3" required>{{ $product->description }}</textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="metaTitle{{ $product->id }}" class="form-label">Meta Title</label>
                                        <input type="text" class="form-control" value="{{ $product->meta_title }}" id="metaTitle{{ $product->id }}" name="meta_title">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="metaDescription{{ $product->id }}" class="form-label">Meta Description</label>
                                        <textarea class="form-control" id="metaDescription{{ $product->id }}" name="meta_description" rows="2">{{ $product->meta_description }}</textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="metaKeywords{{ $product->id }}" class="form-label">Meta Keywords</label>
                                        <input type="text" class="form-control" value="{{ $product->meta_keywords }}" id="metaKeywords{{ $product->id }}" name="meta_keywords">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="isFeatured{{ $product->id }}" class="form-check-label">Featured Product</label>
                                        <input type="checkbox" class="form-check-input" value="1" id="isFeatured{{ $product->id }}" name="is_featured" {{ $product->is_featured ? 'checked' : '' }}>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="status{{ $product->id }}" class="form-label">Status</label>
                                        <select class="form-select" id="status{{ $product->id }}" name="status" required>
                                            <option value="" disabled selected>Select Status</option>
                                            <option value="1" {{ $product->status ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ !$product->status ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-12 mb-3">
                                        <button type="submit" class="btn btn-primary">Edit Product</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </table>
        <!-- Pagination -->
        <div class="pagination-container">
                            <div class="d-flex justify-content-center mt-4">
                                {{ $products->links() }}
                            </div>
        </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
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
    </script> 

</body>

</html>