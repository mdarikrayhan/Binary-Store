<?php require('app/views/partials/head.php') ?>
<?php require('app/views/partials/nav.php') ?>
<?php require('app/views/partials/banner.php') ?>

<div class="bg-white">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">

    <div class="flex flex-col md:flex-row gap-8">
      <!-- Category Image -->
      <div class="md:w-1/2">
        <img src="" alt="Category Image" class="w-full object-cover rounded-lg shadow-lg">
      </div>

      <!-- Category Details -->
      <div class="md:w-1/2 space-y-6">
        <!-- Category Name -->
        <h1 class="text-3xl font-bold text-gray-900">
          Category Name
        </h1>

        <!-- Description -->
        <div class="text-gray-600">
          <p>Category description goes here.</p>
        </div>

        <!-- Admin Actions -->
        <div class="pt-4 flex space-x-4">
          <a href="/admin/category?action=update&id=<?= $_GET['id'] ?>"
            class="flex-1 bg-indigo-600 text-white py-3 px-6 rounded-md hover:bg-indigo-700 transition-colors duration-200 text-center">
            Update Category
          </a>
          <a href="/admin/category?action=delete&id=<?= $_GET['id'] ?>" onclick="return confirm('Are you sure you want to delete this category?')"
            class="flex-1 bg-red-600 text-white py-3 px-6 rounded-md hover:bg-red-700 transition-colors duration-200 text-center">
            Delete Category
          </a>
        </div>
      </div>
    </div>

  </div>
</div>

<?php require('app/views/partials/footer.php') ?>

<script>
  <?php
  global $db;
  $id = $_GET['id'] ?? null;

  if (isset($_GET['id'])) {
    $query = "SELECT * FROM categories WHERE id = :id";
    $params = [':id' => $id];
    $category = $db->query($query, $params)->fetch(PDO::FETCH_ASSOC);
    if (!$category) {
      echo "console.error('Category not found');";
      return;
    }
  } else {
    echo "console.error('No category ID provided');";
    return;
  }
  // Output category data as a JavaScript object
  echo "const category = " . json_encode($category) . ";";
  echo "console.log(category);"; // For debugging purposes
  ?>

  document.addEventListener('DOMContentLoaded', function () {
    // Category exists in the scope from PHP-generated code above
    if (category) {
      // Update image
      const categoryImage = document.querySelector('.md\\:w-1\\/2 img');
      categoryImage.src = '../' + category.image_url || 'https://via.placeholder.com/400';
      categoryImage.alt = category.name;

      // Update category name
      document.querySelector('.text-3xl.font-bold').textContent = category.name;

      // Update description
      document.querySelector('.text-gray-600 p').textContent = category.description;
    }
  });
</script>