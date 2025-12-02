<?php
session_start();
require_once 'inc/header.php';

$productsPath = __DIR__ . "/data/products.json";

$products = [];

if(file_exists($productsPath)){
    $products = json_decode(file_get_contents($productsPath), true);
}

?>
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">Choose your monitor</p>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

            <?php foreach ($products as $product): ?>
                <div class="col mb-5">
                    <div class="card h-100">

                        <img class="card-img-top"
                             src="<?= $product['image'] ?>"
                             alt="<?= $product['name'] ?>">

                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder"><?= $product['name'] ?></h5>
                                <?= $product['price'] ?> EGP
                            </div>
                        </div>

                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <?php if (!isset($_SESSION['user'])): ?>
                                    <a class="btn btn-outline-dark mt-auto" href="login.php">Login to buy</a>
                                <?php else: ?>
                                    <a class="btn btn-outline-dark mt-auto"
                                       href="handler/add_to_cart.php?id=<?= $product['id'] ?>">
                                        Add to cart
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>

<?php require_once 'inc/footer.php'; ?>
