<?php require('app/views/partials/head.php') ?>
<?php require('app/views/partials/nav.php') ?>
<?php require('app/views/partials/banner.php') ?>


<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Create a new product</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="/admin/product" method="POST" enctype="multipart/form-data">

            <div>
                <label for="name" class="block text-sm/6 font-medium text-gray-900">Product Name</label>
                <div class="mt-2">
                    <input type="text" name="name" id="name" required
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm/6 font-medium text-gray-900">Product
                    Description</label>
                <div class="mt-2">
                    <textarea name="description" id="description" rows="3" required
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"></textarea>
                </div>
            </div>

            <div>
                <label for="image" class="block text-sm/6 font-medium text-gray-900">Image Upload</label>
                <div class="mt-2">
                    <input type="file" name="image" id="image" required
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
            </div>

            <div>
                <label for="price" class="block text-sm/6 font-medium text-gray-900">Product Price</label>
                <div class="mt-2">
                    <input type="number" name="price" id="price" required
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
            </div>

            <!-- Quantity -->
            <div>
                <label for="quantity" class="block text-sm/6 font-medium text-gray-900">Product Quantity</label>
                <div class="mt-2">
                    <input type="number" name="quantity" id="quantity" required
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
            </div>

            <!-- Category Option-->
            <div>
                <label for="category" class="block text-sm/6 font-medium text-gray-900">Product Category</label>
                <div class="mt-2">
                    <select name="category" id="category"
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <?php
                        global $db;
                        $query = "SELECT * FROM categories";
                        $categories = $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($categories as $category) {
                            echo "<option value='{$category['id']}'>{$category['name']}</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <!-- Hidden input field for user ID -->
            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">

            <div>
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create
                        Product</button>
                </div>
            </div>
        </form>
    </div>
</div>



<?php require('app/views/partials/footer.php') ?>