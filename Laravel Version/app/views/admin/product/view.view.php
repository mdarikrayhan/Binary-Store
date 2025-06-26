<?php require('app/views/partials/head.php') ?>
<?php require('app/views/partials/nav.php') ?>
<?php require('app/views/partials/banner.php') ?>

<div class="bg-white">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <!-- add product -->
        <div class="flex justify-center mb-6">
            <a href="/admin/product?action=create"
                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Add New Product
            </a>
        </div>
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Available Products</h2>

        <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">

            <!-- <div class="group relative">
                <img src="https://tailwindcss.com/plus-assets/img/ecommerce-images/product-page-01-related-product-01.jpg"
                    alt="Plain black cotton crew neck t-shirt lying flat against white background, showing clean minimalist design and casual everyday style"
                    class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
                <div class="mt-4 flex justify-center">
                    <a href="#" class="text-sm font-semibold text-gray-900">T-Shirts</a>
                    <span class="sr-only">,</span>
                    <p class="ml-2 text-sm text-gray-500">10 items</p>
                </div>
            </div> -->
            <!-- More products... -->
        </div>
    </div>
</div>



<script>
    <?php
    global $db;
    $query = "SELECT * FROM products";
    $result = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
    ?>
    const products = <?php echo json_encode($result); ?>;
    console.log(products);
    const productContainer = document.querySelector('.grid');
    products.forEach(product => {
        const productDiv = document.createElement('div');
        productDiv.className = 'group relative';
        productDiv.innerHTML = `
            <img src="../${product.image_url}" alt="${product.name}"
                class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
            <div class="mt-4 flex justify-center">
                <a href="/admin/product?action=view&id=${product.id}" class="text-sm font-semibold text-gray-900">${product.name}</a>
                <span class="sr-only">,</span>
                <p class="ml-2 text-sm text-gray-500">${product.description}</p>
            </div>
            <div class="mt-2 flex justify-center space-x-2">
                <a href="/admin/product?action=update&id=${product.id}" class="text-xs bg-indigo-600 text-white px-2 py-1 rounded hover:bg-indigo-700">Update</a>
                <a href="/admin/product?action=delete&id=${product.id}" onclick="return confirm('Are you sure you want to delete this product?')" class="text-xs bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700">Delete</a>
            </div>
        `;
        productContainer.appendChild(productDiv);
    });

</script>

<?php require('app/views/partials/footer.php') ?>
