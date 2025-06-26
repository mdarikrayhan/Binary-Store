<?php require('app/views/partials/head.php') ?>
<?php require('app/views/partials/nav.php') ?>
<?php require('app/views/partials/banner.php') ?>

<?php
// Get category data
global $db;
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: /admin/category");
    exit;
}

$query = "SELECT * FROM categories WHERE id = :id";
$params = [':id' => $id];
$category = $db->query($query, $params)->fetch(PDO::FETCH_ASSOC);

if (!$category) {
    header("Location: /admin/category");
    exit;
}
?>

<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Update Category</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="/admin/category?action=update&id=<?= $category['id'] ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $category['id'] ?>">
            <input type="hidden" name="current_image" value="<?= $category['image_url'] ?>">

            <div>
                <label for="name" class="block text-sm/6 font-medium text-gray-900">Category Name</label>
                <div class="mt-2">
                    <input type="text" name="name" id="name" value="<?= htmlspecialchars($category['name']) ?>" required
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
            </div>

            <div>
                <label for="description" class="block text-sm/6 font-medium text-gray-900">Category Description</label>
                <div class="mt-2">
                    <textarea name="description" id="description" rows="3" required
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"><?= htmlspecialchars($category['description']) ?></textarea>
                </div>
            </div>

            <div>
                <label for="image" class="block text-sm/6 font-medium text-gray-900">Image Upload (Leave empty to keep current image)</label>
                <div class="mt-2">
                    <input type="file" name="image" id="image"
                        class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" />
                </div>
                <?php if ($category['image_url']): ?>
                <div class="mt-2">
                    <p>Current image:</p>
                    <img src="../<?= $category['image_url'] ?>" alt="Current category image" class="h-32 object-cover">
                </div>
                <?php endif; ?>
            </div>

            <div>
                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update Category</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php require('app/views/partials/footer.php') ?>