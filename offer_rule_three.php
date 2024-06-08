<?php
header("Content-Type: application/json");

// Function to determine the discounted and payable items
function calculateDiscountedItems($productPrices) {
    // Sort the product prices in descending order
    rsort($productPrices);

    $payableItems = [];
    $discountedItems = [];

    while (count($productPrices) >= 2) {
        // Take the two highest prices as payable items
        $payableItem1 = array_shift($productPrices);
        $payableItem2 = array_shift($productPrices);
        $payableItems[] = $payableItem1;
        $payableItems[] = $payableItem2;

        // Find the highest price items that are less than the payable items
        $discountedItem1 = null;
        $discountedItem2 = null;

        foreach ($productPrices as $key => $price) {
            if ($discountedItem1 === null && $price < $payableItem1) {
                $discountedItem1 = $price;
                unset($productPrices[$key]);
                $productPrices = array_values($productPrices);
            } elseif ($discountedItem2 === null && $price < $payableItem1) {
                $discountedItem2 = $price;
                unset($productPrices[$key]);
                $productPrices = array_values($productPrices);
                break;
            }
        }

        // Add found discounted items to the list
        if ($discountedItem1 !== null) {
            $discountedItems[] = $discountedItem1;
        }
        if ($discountedItem2 !== null) {
            $discountedItems[] = $discountedItem2;
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
