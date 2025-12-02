<?php
session_start();
require_once('inc/header.php');
?>

<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Your Cart</h1>
        </div>
    </div>
</header>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">

        <?php
        $cart = $_SESSION['cart'] ?? [];
        ?>

        <?php if (empty($cart)): ?>

            <h4 class="text-center text-danger">Your cart is empty.</h4>

        <?php else: ?>

            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Delete</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php
                        $i = 1;
                        $grandTotal = 0;

                        foreach($cart as $id => $item):
                            $rowTotal = $item['price'] * $item['qty'];
                            $grandTotal += $rowTotal;
                            ?>
                            <tr>
                                <th><?= $i++ ?></th>

                                <td><?= $item['name'] ?></td>

                                <td><?= $item['price'] ?> EGP</td>

                                <td>
                                    <input type="number" value="<?= $item['qty'] ?>" class="form-control" disabled>
                                </td>

                                <td><?= $rowTotal ?> EGP</td>

                                <td>
                                    <a href="handler/remove_from_cart.php?id=<?= $id ?>"
                                       class="btn btn-danger btn-sm">
                                        Delete
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach; ?>

                        <!-- Final row -->
                        <tr>
                            <td colspan="2">Total Price</td>

                            <td colspan="3">
                                <h3><?= $grandTotal ?> EGP</h3>
                            </td>

                            <td>
                                <a href="checkout.php" class="btn btn-primary">Checkout</a>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        <?php endif; ?>

    </div>
</section>

<?php require_once('inc/footer.php'); ?>
