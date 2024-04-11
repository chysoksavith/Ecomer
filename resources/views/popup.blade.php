<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close" id="close">&times;</span>
        <h2 class="h2-order">Cancel Order</h2>
        <form action="{{ url('user/orders/' . $orderDetails['id'] . '/cancel') }}" method="post">

            @csrf
            <p class="p-canecl">Choose Your Reason</p>
            <div class="from-select">
                <select id="cancelReason" name="reason" class="selcet-cencel">
                    <option value="">Select.....</option>
                    <option value="changedMind">Changed my mind</option>
                    <option value="betterDeal">Found a better deal elsewhere</option>
                    <option value="expectations">Product didn't meet expectations</option>
                    <option value="deliveryDelay">Delivery taking too long</option>
                    <option value="damaged">Item damaged upon arrival</option>
                    <option value="orderedMistake">Ordered by mistake</option>
                    <option value="notPurchase">Decided not to purchase</option>
                    <option value="priceChanged">Price changed after purchase</option>
                    <option value="lowerPrice">Found a similar item for a lower price</option>
                    <option value="notNeeded">Item no longer needed</option>
                </select>
            </div>
            <div class="group-btn">
                <button type="submit" id="cancelBtn" class="order-btn-cancel">Cancel Order</button>
            </div>
        </form>
    </div>
</div>
