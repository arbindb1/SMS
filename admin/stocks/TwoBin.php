<?php include_once("outofstock.php");?>
<script>
class Bin {
    constructor(capacity, currentStock) {
        this.capacity = capacity;       // Bin capacity
        this.currentStock = currentStock; // Current stock level
    }

    isLowStock(minStock) {
        return this.currentStock <= minStock; // Check if stock is below min threshold
    }
    getMinStock(){
        
    }

    // refill(amount) {
    //     // Refill the bin, ensuring we don't exceed capacity
    //     this.currentStock = Math.min(this.currentStock + amount, this.capacity);
    // }
}

</script>