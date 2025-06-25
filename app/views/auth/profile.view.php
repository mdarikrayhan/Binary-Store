<?php require('app/views/partials/head.php') ?>
<?php require('app/views/partials/nav.php') ?>
<?php require('app/views/partials/banner.php') ?>

<main>
    <?php
    $user = (new User())->getUserDataByID($_SESSION['user_id']);
    //show user profile
    ?>
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="px-4 sm:px-0">
            <h3 class="text-base/7 font-semibold text-gray-900">Profile Information</h3>
        </div>
        <div class="mt-6 border-t border-gray-100">
            <dl class="divide-y divide-gray-100">

                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm/6 font-medium text-gray-900">Full name</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0">
                        <?php echo $user['first_name'] . ' ' . $user['last_name']; ?>
                    </dd>
                </div>

                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm/6 font-medium text-gray-900">Email address</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo $user['email']; ?></dd>
                </div>

                <!-- Phone -->
                <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                    <dt class="text-sm/6 font-medium text-gray-900">Phone</dt>
                    <dd class="mt-1 text-sm/6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo $user['phone']; ?></dd>
                </div>
                <!-- Address -->
            </dl>
        </div>
        <!-- Logout -->
        <div class="mt-6">
            <form method="POST" action="/user">
                <input type="hidden" name="action" value="logout">
                <button type="submit"
                    class="inline-flex items-center rounded-md border border-transparent bg-red-600 px-3 py-2 text-sm/6 font-semibold text-white shadow-sm hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                    Logout
                </button>
            </form>
        </div>


</main>

<?php require('app/views/partials/footer.php') ?>