<?php
// Start session
session_start();

// Initialize cart array if it does not exist already
if (!isset($_SESSION['cart'])) {
$_SESSION['cart'] = array();
}

// Add item to cart
function add_to_cart($item_id, $quantity) {
if (array_key_exists($item_id, $_SESSION['cart'])) {
$_SESSION['cart'][$item_id] += $quantity;
} else {
$_SESSION['cart'][$item_id] = $quantity;
}
}

// Remove item from cart
function remove_from_cart($item_id) {
unset($_SESSION['cart'][$item_id]);
}

// Update cart item quantity
function update_cart_quantity($item_id, $quantity) {
$_SESSION['cart'][$item_id] = $quantity;
}

// Get total items in cart
function get_total_items() {
$total_items = 0;
foreach ($_SESSION['cart'] as $item_id => $quantity) {
$total_items += $quantity;
}
return $total_items;
}

// Get total price of items in cart
function get_total_price() {
$total_price = 0;
foreach ($_SESSION['cart'] as $item_id => $quantity) {
// Calculate price of item by querying database or using stored prices
$price = get_item_price($item_id);
$total_price += $price * $quantity;
}
return $total_price;
}

// Display items in cart
function display_cart_items() {
foreach ($_SESSION['cart'] as $item_id => $quantity) {
// Query database or use stored item info to display item image, name, price, and quantity
$item_info = get_item_info($item_id);
echo '';
echo '' . $item_info['name'] . '';
echo 'Price: $' . $item_info['price'] . '';
echo 'Quantity:  Remove';
}
}

// HTML form to add item to cart
echo '';
echo '';
echo 'Quantity: ';
echo 'Add to Cart';
echo '';

// Check if form was submitted to add item to cart
if (isset($_POST['item_id']) && isset($_POST['quantity'])) {
add_to_cart($_POST['item_id'], $_POST['quantity']);
}

// HTML cart display
echo 'Total items: ' . get_total_items() . '';
echo 'Total price: $' . get_total_price() . '';
echo '';
display_cart_items();
echo '';

// JavaScript functions to update cart items
echo '';
echo 'function updateCart(item_id, quantity) {';
echo '  $.ajax({';
echo '    url: "update_cart.php",';
echo '    type: "POST",';
echo '    data: {';
echo '      item_id: item_id,';
echo '      quantity: quantity';
echo '    },';
echo '    success: function() {';
echo '      location.reload();';
echo '    }';
echo '  });';
echo '}';
echo 'function removeFromCart(item_id) {';
echo '  $.ajax({';
echo '    url: "remove_from_cart.php",';
echo '    type: "POST",';
echo '    data: {';
echo '      item_id: item_id';
echo '    },';
echo '    success: function() {';
echo '      location.reload();';
echo '    }';
echo '  });';
echo '}';
echo '';

// update_cart.php script
$item_id = $_POST['item_id'];
$quantity = $_POST['quantity'];
update_cart_quantity($item_id, $quantity);

// remove_from_cart.php script
$item_id = $_POST['item_id'];
remove_from_cart($item_id);
?>