<?php

header("Content-Type: application/json");
// die('hello testing 2');

// Function to determine the discounted and payable items
function calculateDiscountedItems($productPrices) {
    // Sort the product prices in descending order
    rsort($productPrices);

    $payableItems = [];
    $discountedItems = [];
    
    while (!empty($productPrices)) {
        // Take the highest price as payable
        $payableItem = array_shift($productPrices);
        $payableItems[] = $payableItem;

        // Find the highest price item that is equal to or less than the payable item
        foreach ($productPrices as $key => $price) {
            if ($price <= $payableItem) {
                $discountedItems[] = $price;
                unset($productPrices[$key]);
                // Re-index array after unset
                $productPrices = array_values($productPrices);
                break;
            }
        }
    }

    return [
        "DiscountedItems" => $discountedItems,
        "PayableItems" => $payableItems
    ];
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (isset($input['ProductPriceList']) && is_array($input['ProductPriceList'])) {
        $productPriceList = $input['ProductPriceList'];
        $result = calculateDiscountedItems($productPriceList);
        
        echo json_encode($result);
    } else {
        echo json_encode([
            "error" => "Invalid input"
        ]);
    }
} else {
    echo json_encode([
        "error" => "Invalid request method"
    ]);
}
?>
