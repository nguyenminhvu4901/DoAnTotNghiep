<style>
    #click-btn {
        display: none;
    }

    .loading-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .loading {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #3498db;
        border-radius: 50%;
        animation: spin 2s linear infinite;
        text-align: center;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<form action="{{ route('frontend.orders.processCheckoutWhenPayingWithVnpay') }}" method="POST" id="checkout-form">
    @csrf
    @method('POST')
    <input type="hidden" name="totalAllProduct" value="{{ $totalAllProduct }}">
    <button type="submit" id="click-btn" name="click-btn"></button>
</form>

<h1 style="text-align: center">@lang('Đang chuyển hướng đến trang VNPAY')</h1>

<div class="loading-container">
    <div class="loading"></div>
</div>

<script>
    document.getElementById('checkout-form').addEventListener('submit', function() {
        document.getElementById('click-btn').style.display = 'none';
        document.querySelector('.loading-container').style.display = 'flex';
    });

    setTimeout(function() {
        document.getElementById('checkout-form').submit();
    }, 2000);
</script>
