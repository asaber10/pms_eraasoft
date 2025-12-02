<?php
session_start();
require_once('inc/header.php');

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'] * $item['qty'];
}
?>

<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Checkout</h1>
            <p class="lead fw-normal text-white-50 mb-0">Complete your order</p>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">

        <div class="row">
            <div class="col-4">
                <div class="border p-2">
                    <div class="products">
                        <ul class="list-unstyled">

                            <?php foreach ($_SESSION['cart'] as $item): ?>
                                <li class="border p-2 my-1">
                                    <?= $item['name'] ?>
                                    <span class="text-success mx-2 mr-auto bold">
                                        <?= $item['qty'] ?> × <?= $item['price'] ?> EGP
                                    </span>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    </div>

                    <h3>Total : <?= $total ?> EGP</h3>
                </div>
            </div>

            <div class="col-8">
                <form action="handler/create_order.php" method="POST" class="form border my-2 p-3">

                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="number" name="phone" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Notes</label>
                        <input type="text" name="notes" class="form-control">
                    </div>

                    <div class="mb-3">
                        <input type="submit" value="Send" class="btn btn-success">
                    </div>

                </form>
            </div>
        </div>

    </div>
</section>

<?php require_once('inc/footer.php'); ?>
