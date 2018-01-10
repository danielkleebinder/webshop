<h2>Shopping Cart</h2>
<div id="shopping-cart" class="min-height separator">
    <?php if ($_SESSION['cartcount'] > 0) { ?>
        <table id="shopping-cart-table" class="table table-striped table-hover table-responsive">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Count</th>
                    <th>Price</th>
                    <th>Shopping Cart</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $products = $user_system->get_database()->all_products();

                foreach ($products as $value) {
                    if (!isset($_SESSION['cart'][$value->get_id()])) {
                        continue;
                    }
                    echo '<tr id="prod-' . $value->get_id() . '">';
                    echo '<td>' . $value->get_name() . '</td>';
                    echo '<td>' . $value->get_description() . '</td>';
                    echo '<td id="count-' . $value->get_id() . '">' . $_SESSION['cart'] [$value->get_id()] . '</td>';
                    echo '<td>€ ' . number_format($value->get_price(), 2) . '</td>';
                    echo '<td>';
                    echo '<a id="' . $value->get_id() . '" href="#" onclick="return false;" class="lnk-remove-from-cart text-danger">Remove</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
                <tr>
                    <td class="text-center text-info lead">Total</td>
                    <td></td>
                    <td></td>
                    <td id="total-price" class="text-info lead">
                        <?php
                        echo '€ ' . number_format(Utils::cart_total_price(), 2);
                        ?>
                    </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    <?php } ?>

    <div id="go-shopping-dialog" class="text-center <?php echo $_SESSION['cartcount'] <= 0 ? 'show' : 'hidden'; ?> ">
        <h3 class="text-warning text-center">Your Shopping Cart Is Currently Empty</h3>
        <a class="btn btn-info" href="./index.php?section=products">Start Shopping Tour</a>
    </div>

    <script  type="text/javascript" src="./js/remove-from-cart.js"></script>
</div>