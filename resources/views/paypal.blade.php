<form class="w3-container w3-display-middle w3-card-4 " method="POST" id="payment-form"  action="{{ route('paypal.payment') }}">
    {{ csrf_field() }}
    <h2 class="w3-text-blue">CrazyMan Shop 資金求助</h2>
    <p>這將會成爲 CrazyMan Shop 的啓動資金，感謝您</p>
    <p>
        <label class="w3-text-blue"><b>請輸入付款的金額</b></label>
        <input class="w3-input w3-border" name="amount" type="text"></p>
    </p>
    <button>PayPal 付款</button>
</form>